# Contact Form 7 Setup Guide

## Configuração do Formulário de Contacto

Este guia explica como configurar o Contact Form 7 para funcionar com o tema Atlas Theme.

### 1. Instalação do Plugin

1. Vá para **Plugins > Adicionar Novo** no WordPress Admin
2. Procure por "Contact Form 7"
3. Instale e ative o plugin

### 2. Criação do Formulário

1. Vá para **Contact > Contact Forms** no WordPress Admin
2. Clique em **Adicionar Novo**
3. Configure o formulário com o seguinte código:

#### Código do Formulário:

```html
<div class="wpcf7-form-fields">
    <div class="wpcf7-form-control-wrap">
        <label for="contact-name">Nome <span class="required">*</span></label>
        [text* contact-name id:contact-name placeholder "Seu nome completo"]
    </div>
    
    <div class="wpcf7-form-control-wrap">
        <label for="contact-email">Email <span class="required">*</span></label>
        [email* contact-email id:contact-email placeholder "seu@email.com"]
    </div>
    
    <div class="wpcf7-form-control-wrap">
        <label for="contact-subject">Assunto <span class="required">*</span></label>
        [text* contact-subject id:contact-subject placeholder "Assunto da mensagem"]
    </div>
    
    <div class="wpcf7-form-control-wrap">
        <label for="contact-message">Mensagem <span class="required">*</span></label>
        [textarea* contact-message id:contact-message placeholder "Sua mensagem aqui..."]
    </div>
    
    [submit class:btn class:btn-primary "Enviar Mensagem"]
</div>
```

### 3. Configuração do Email

1. Na aba **Mail** do formulário, configure:

**Para:** `lm@atlasinvencivel.pt`

**De:** `[contact-name] <[contact-email]>`

**Assunto:** `Contact Form: [contact-subject]`

**Corpo da Mensagem:**
```
Nome: [contact-name]
Email: [contact-email]
Assunto: [contact-subject]

Mensagem:
[contact-message]

---
Esta mensagem foi enviada através do formulário de contacto do site Atlas Invencível.
```

### 4. Configuração de Resposta Automática

1. Na aba **Mail (2)**, configure:

**Para:** `[contact-email]`

**De:** `Atlas Invencível <lm@atlasinvencivel.pt>`

**Assunto:** `Obrigado pelo seu contacto - Atlas Invencível`

**Corpo da Mensagem:**
```
Olá [contact-name],

Obrigado pelo seu contacto através do nosso website.

Recebemos a sua mensagem sobre "[contact-subject]" e responderemos o mais breve possível.

Aqui está uma cópia da sua mensagem:
[contact-message]

Com os melhores cumprimentos,
Luis Marques
Atlas Invencível
```

### 5. Configuração de Mensagens

1. Na aba **Messages**, configure as mensagens em português:

- **Mail sent successfully:** `Obrigado! A sua mensagem foi enviada com sucesso.`
- **Mail sending failed:** `Desculpe, ocorreu um erro ao enviar a sua mensagem. Tente novamente.`
- **Validation error:** `Por favor, corrija os erros indicados abaixo.`
- **Spam:** `A sua mensagem foi bloqueada por ser considerada spam.`
- **Acceptance missing:** `Deve aceitar os termos para continuar.`
- **Invalid email:** `Por favor, introduza um endereço de email válido.`
- **Required field:** `Este campo é obrigatório.`
- **Invalid number:** `O número introduzido não é válido.`
- **Number too small:** `O número é demasiado pequeno.`
- **Number too large:** `O número é demasiado grande.`
- **Quiz answer incorrect:** `A resposta ao quiz está incorreta.`
- **Invalid date:** `A data introduzida não é válida.`
- **Date too early:** `A data é demasiado antiga.`
- **Date too late:** `A data é demasiado recente.`
- **Upload failed:** `O upload do ficheiro falhou.`
- **Upload file type invalid:** `Este tipo de ficheiro não é permitido.`
- **Upload file too large:** `O ficheiro é demasiado grande.`
- **Upload folder not writable:** `A pasta de upload não tem permissões de escrita.`
- **Submit button clicked:** `O botão de envio foi clicado.`
- **Abuse of comment spam:** `Abuso de comentários spam detetado.`
- **Abuse of comment spam:** `Abuso de comentários spam detetado.`
- **Abuse of comment spam:** `Abuso de comentários spam detetado.`

### 6. Obter o ID do Formulário

1. Após criar o formulário, copie o shortcode gerado
2. O shortcode deve ser algo como: `[contact-form-7 id="123" title="Atlas Contact Form"]`
3. Substitua o ID no ficheiro `page-contact.php` na linha 269

### 7. Teste do Formulário

1. Vá para a página de contacto no frontend
2. Preencha e envie o formulário
3. Verifique se recebe o email em `lm@atlasinvencivel.pt`
4. Verifique se o remetente recebe a resposta automática

### 8. Personalização Adicional

O tema já inclui estilos CSS personalizados para o Contact Form 7 que mantêm o design consistente com o resto do site. Os estilos estão localizados em `assets/css/contact.css` na secção "Contact Form 7 Integration Styles".

### Notas Importantes

- Certifique-se de que o plugin Contact Form 7 está ativo
- O formulário usa o email `lm@atlasinvencivel.pt` como destinatário
- Os estilos CSS estão integrados para manter a consistência visual
- O JavaScript de validação funciona tanto com formulários customizados quanto com Contact Form 7
