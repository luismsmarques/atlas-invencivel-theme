# Página de Contactos - Atlas Invencível Theme

## Visão Geral

A página de contactos foi completamente redesenhada do zero para ser 100% compatível com o design e UX/UI da homepage, mantendo a consistência visual e funcional em todo o site.

## Características Principais

### 🎨 Design Consistente
- **Cores**: Utiliza a mesma paleta de cores da homepage (#134686, #FEB21A, #FDF4E3)
- **Tipografia**: Mantém a mesma hierarquia tipográfica e pesos de fonte
- **Layout**: Estrutura responsiva com container e grid layouts
- **Animações**: Efeitos hover e transições suaves consistentes

### 📱 Responsividade Completa
- **Desktop**: Layout em 3 colunas com sidebar
- **Tablet**: Layout adaptado com 2 colunas
- **Mobile**: Layout em coluna única otimizado para touch

### 🔧 Funcionalidades

#### 1. Hero Section
- Gradiente de fundo idêntico à homepage
- Breadcrumbs de navegação
- Título e subtítulo com animações
- Meta informações (tempo de resposta, disponibilidade, etc.)

#### 2. Métodos de Contacto
- **Email**: Link direto com validação
- **Telefone**: Link para chamada direta
- **WhatsApp**: Integração com WhatsApp Web/App
- Cards interativos com hover effects

#### 3. Formulário de Contacto
- Validação em tempo real
- Campos obrigatórios e opcionais
- Selector de assunto categorizado
- Checkbox de privacidade obrigatório
- Estados de loading e feedback visual

#### 4. Sidebar Informativa
- Informações de contacto rápidas
- Links para redes sociais
- Horários de funcionamento
- Nota sobre projetos de emergência

#### 5. FAQ Section
- Accordion interativo
- Perguntas e respostas expandíveis
- Animações suaves de abertura/fechamento

## Arquivos Criados/Modificados

### Novos Arquivos
- `page-contact.php` - Template da página de contactos
- `assets/css/contact.css` - Estilos específicos da página
- `assets/js/contact.js` - JavaScript para interatividade
- `inc/contact-form.php` - Handler PHP para processamento do formulário

### Arquivos Modificados
- `inc/enqueue.php` - Adicionado carregamento condicional dos assets
- `functions.php` - Incluído o handler de contact form
- `assets/css/main.css` - Comentário sobre importação

## Funcionalidades Técnicas

### Processamento de Formulário
- **AJAX**: Submissão sem reload da página
- **Validação**: Server-side e client-side
- **Email**: Envio automático para admin
- **Auto-reply**: Resposta automática para o usuário
- **Database**: Armazenamento das submissões
- **Security**: Nonce verification e sanitização

### Integração com WordPress
- **Customizer**: Opções de contacto no customizer
- **Shortcode**: `[contact_form]` para usar em qualquer página
- **Options**: Configurações via painel de opções do tema
- **Database**: Tabela personalizada para armazenar submissões

## Configuração

### Opções Disponíveis
1. **Email de Contacto**: Configurável via customizer
2. **Telefone**: Configurável via customizer  
3. **Localização**: Configurável via customizer
4. **Redes Sociais**: Herda das configurações do tema

### Uso do Shortcode
```php
[contact_form show_title="true" title="Get In Touch"]
```

## Responsividade

### Breakpoints
- **Desktop**: > 768px - Layout completo
- **Tablet**: 768px - Layout adaptado
- **Mobile**: < 480px - Layout otimizado

### Adaptações Mobile
- Formulário em coluna única
- Cards de contacto empilhados
- FAQ com touch-friendly
- Mensagens de feedback otimizadas

## Acessibilidade

- **ARIA Labels**: Navegação e formulários
- **Keyboard Navigation**: Suporte completo
- **Screen Readers**: Textos alternativos
- **Color Contrast**: Conformidade WCAG
- **Focus States**: Indicadores visuais claros

## Performance

- **CSS**: Carregamento condicional apenas na página de contactos
- **JS**: Carregamento assíncrono
- **Images**: Otimização automática
- **Animations**: GPU-accelerated
- **Forms**: Validação eficiente

## Compatibilidade

- **WordPress**: 5.0+
- **PHP**: 7.4+
- **Browsers**: Chrome, Firefox, Safari, Edge (últimas 2 versões)
- **Mobile**: iOS Safari, Chrome Mobile, Samsung Internet

## Manutenção

### Logs e Debugging
- Console logs para erros JavaScript
- Database logs para submissões
- Email delivery tracking
- Form validation feedback

### Updates
- Compatível com atualizações do WordPress
- Mantém compatibilidade com plugins
- Backup automático das configurações

---

**Desenvolvido para o Atlas Invencível Theme**  
*Mantendo a excelência em design e funcionalidade*
