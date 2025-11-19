# Solução: Calendário não está mostrando eventos no iframe

## 🔍 Problemas Comuns

### 1. **Calendário não está público/compartilhado**

O Google Calendar precisa estar **compartilhado publicamente** ou ter permissões de visualização para aparecer no iframe.

#### Como corrigir:

1. Acesse o Google Calendar: https://calendar.google.com/
2. Clique nas **3 linhas** (menu) ao lado do calendário que você quer exibir
3. Clique em **"Configurações e compartilhamento"**
4. Role até **"Compartilhar com pessoas específicas"** ou **"Tornar disponível publicamente"**
5. Para visualização pública:
   - Ative **"Tornar disponível publicamente"**
   - Selecione **"Ver todos os detalhes do evento"**
6. Copie o **"ID do calendário"** (formato: `email@gmail.com` ou um ID longo)

---

### 2. **URL do iframe incorreto**

O email no URL está codificado em Base64. Vamos verificar e corrigir.

#### Email atual no código:
- Codificado: `dGhhdWFuYWZleXRoMzRAZ21haWwuY29t`
- Decodificado: `thauanafeyth34@gmail.com`

#### Como gerar o URL correto:

1. Acesse: https://calendar.google.com/calendar/
2. Clique nas **3 linhas** ao lado do calendário
3. Clique em **"Configurações e compartilhamento"**
4. Role até **"Integrar calendário"**
5. Copie o **"Código de incorporação"** (iframe)
6. Ou use o gerador: https://calendar.google.com/calendar/embedhelper

---

### 3. **Formato correto do URL**

O URL deve ter este formato:

```
https://calendar.google.com/calendar/embed?
  height=600
  &wkst=1
  &ctz=America/Sao_Paulo
  &mode=WEEK
  &src=SEU_EMAIL_AQUI@gmail.com
  &color=%23039be5
```

**Importante:** O email deve estar **codificado em Base64** ou usar o formato direto.

---

## 🔧 Solução Rápida

### Opção 1: Usar o gerador do Google

1. Acesse: https://calendar.google.com/calendar/
2. Vá em **Configurações** > **Integrar calendário**
3. Copie o código iframe gerado
4. Substitua no seu código

### Opção 2: Corrigir manualmente

Se o calendário for público, você pode usar o email diretamente:

```html
<iframe src="https://calendar.google.com/calendar/embed?height=600&wkst=1&ctz=America%2FSao_Paulo&mode=WEEK&src=thauanafeyth34%40gmail.com&color=%23039be5" 
    style="border-width:0" 
    width="100%" 
    height="100%" 
    frameborder="0" 
    scrolling="no">
</iframe>
```

**Nota:** Substitua `thauanafeyth34@gmail.com` pelo email do calendário que você quer exibir.

---

## 🔧 Opção 3: Usar o ID do Calendário (Recomendado)

Se você tem um calendário específico, use o ID do calendário:

1. Vá em **Configurações** do calendário
2. Role até **"Integrar calendário"**
3. Copie o **"ID do calendário"** (pode ser um ID longo)
4. Use no URL:

```html
<iframe src="https://calendar.google.com/calendar/embed?height=600&wkst=1&ctz=America%2FSao_Paulo&mode=WEEK&src=ID_DO_CALENDARIO_AQUI&color=%23039be5" 
    style="border-width:0" 
    width="100%" 
    height="100%" 
    frameborder="0" 
    scrolling="no">
</iframe>
```

---

## ✅ Checklist de Verificação

- [ ] Calendário está compartilhado publicamente OU tem permissão de visualização
- [ ] URL do iframe está correto
- [ ] Email/ID do calendário está correto
- [ ] Calendário tem eventos cadastrados
- [ ] Não há bloqueadores de iframe no navegador
- [ ] Teste em modo anônimo do navegador para verificar se é problema de cache

---

## 🧪 Teste Rápido

1. Abra o Google Calendar diretamente: https://calendar.google.com/
2. Verifique se os eventos aparecem lá
3. Se aparecerem no Google Calendar mas não no iframe, o problema é de compartilhamento
4. Se não aparecerem nem no Google Calendar, você precisa criar eventos primeiro

---

## 📝 Exemplo de URL Corrigido

Aqui está um exemplo de URL corrigido que você pode usar como base:

```html
<iframe 
    src="https://calendar.google.com/calendar/embed?height=600&wkst=1&ctz=America%2FSao_Paulo&showPrint=0&mode=WEEK&src=thauanafeyth34%40gmail.com&color=%23039be5" 
    style="border-width:0" 
    width="100%" 
    height="100%" 
    frameborder="0" 
    scrolling="no">
</iframe>
```

**Lembre-se:** Substitua `thauanafeyth34@gmail.com` pelo email do calendário correto.

---

## 🚨 Problemas Comuns e Soluções

### Problema: "Não foi possível carregar o calendário"
**Solução:** O calendário não está público. Torne-o público nas configurações.

### Problema: "Calendário vazio"
**Solução:** 
- Verifique se há eventos no calendário
- Verifique se está usando o calendário correto
- Tente usar `mode=MONTH` ao invés de `mode=WEEK`

### Problema: "Acesso negado"
**Solução:** 
- Verifique as permissões de compartilhamento
- Certifique-se de que o calendário está compartilhado publicamente

---

## 💡 Dica Extra

Para testar se o URL está funcionando, cole o URL do `src` diretamente no navegador. Se abrir o calendário corretamente, o problema pode ser com o iframe ou CSS.

