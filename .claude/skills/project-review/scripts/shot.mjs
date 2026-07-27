// Screenshot com emulação de dispositivo REAL via Chrome DevTools Protocol.
//
// Porquê: o Chrome headless força largura mínima (~500px) com --window-size,
// por isso screenshots "a 390px" ficam apenas cortados e enganam. Este script
// usa Emulation.setDeviceMetricsOverride para uma viewport mobile verdadeira,
// e reporta document.scrollWidth para detetar overflow horizontal.
//
// Uso:
//   node shot.mjs <fileUrl|http url> <out.png> [width=390] [height=2400]
// Ex.:
//   node shot.mjs "file:///caminho/preview.html" home-390.png 390 2600
//
// Requisitos: um Chromium/Chrome headless local. Ajusta CHROME se necessário.
// Em ambientes com proxy, correr com NO_PROXY="*" para não passar 127.0.0.1 pelo proxy:
//   NO_PROXY="*" no_proxy="*" node shot.mjs ...

import { spawn } from 'node:child_process';
import { writeFileSync } from 'node:fs';
import http from 'node:http';

const [, , url, out, wArg, hArg] = process.argv;
if (!url || !out) {
  console.error('Uso: node shot.mjs <url> <out.png> [width] [height]');
  process.exit(1);
}
const width = parseInt(wArg || '390', 10);
const height = parseInt(hArg || '2400', 10);

// Candidatos comuns para o binário do Chrome (Playwright pré-instalado, etc.).
const CHROME =
  process.env.CHROME_PATH ||
  '/opt/pw-browsers/chromium-1194/chrome-linux/chrome';
const PORT = 9344 + Math.floor((width + height) % 500);

const proc = spawn(CHROME, [
  '--headless=new', '--no-sandbox', '--disable-gpu', '--hide-scrollbars',
  `--remote-debugging-port=${PORT}`, '--remote-allow-origins=*', 'about:blank',
], { stdio: 'ignore' });

const sleep = (ms) => new Promise((r) => setTimeout(r, ms));
const getJSON = (path) => new Promise((resolve, reject) => {
  const req = http.get({ host: '127.0.0.1', port: PORT, path, agent: false }, (res) => {
    let d = ''; res.on('data', (c) => (d += c));
    res.on('end', () => { try { resolve(JSON.parse(d)); } catch (e) { reject(e); } });
  });
  req.on('error', reject);
});

let msgId = 0;
const send = (ws, method, params = {}, sessionId) => new Promise((resolve) => {
  const id = ++msgId;
  const h = (ev) => { const m = JSON.parse(ev.data); if (m.id === id) { ws.removeEventListener('message', h); resolve(m.result); } };
  ws.addEventListener('message', h);
  ws.send(JSON.stringify({ id, method, params, sessionId }));
});

try {
  let ver;
  for (let i = 0; i < 80; i++) { try { ver = await getJSON('/json/version'); if (ver && ver.webSocketDebuggerUrl) break; } catch {} await sleep(100); }
  if (!ver || !ver.webSocketDebuggerUrl) throw new Error('DevTools não respondeu — verifica o caminho do Chrome (CHROME_PATH).');

  const ws = new WebSocket(ver.webSocketDebuggerUrl);
  await new Promise((r) => ws.addEventListener('open', r, { once: true }));

  const { targetId } = await send(ws, 'Target.createTarget', { url: 'about:blank' });
  const { sessionId } = await send(ws, 'Target.attachToTarget', { targetId, flatten: true });
  await send(ws, 'Page.enable', {}, sessionId);
  await send(ws, 'Runtime.enable', {}, sessionId);
  await send(ws, 'Emulation.setDeviceMetricsOverride', { width, height, deviceScaleFactor: 2, mobile: true }, sessionId);
  await send(ws, 'Page.navigate', { url }, sessionId);
  await sleep(2500);

  const diag = await send(ws, 'Runtime.evaluate', {
    expression: `(function(){var w=[];document.querySelectorAll('*').forEach(function(e){var r=e.getBoundingClientRect();if(r.width>window.innerWidth+1)w.push((e.className||e.tagName)+':'+Math.round(r.width));});return 'vp='+window.innerWidth+' doc='+document.documentElement.scrollWidth+' OVERFLOW='+(document.documentElement.scrollWidth>window.innerWidth?'SIM':'nao')+' WIDE='+w.slice(0,12).join(', ');})()`,
    returnByValue: true,
  }, sessionId);
  console.log(diag.result.value);

  const res = await send(ws, 'Page.captureScreenshot', { format: 'png', captureBeyondViewport: true }, sessionId);
  writeFileSync(out, Buffer.from(res.data, 'base64'));
  console.log('saved', out, width + 'x' + height);
  ws.close();
} catch (e) {
  console.error('ERRO:', e && e.message);
  process.exitCode = 1;
} finally {
  proc.kill('SIGKILL');
}
