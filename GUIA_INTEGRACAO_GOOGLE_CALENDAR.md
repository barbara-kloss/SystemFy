# Guia de Integração com Google Calendar API

## 📋 Situação Atual

Atualmente, o sistema usa um **iframe** do Google Calendar que apenas **exibe** os eventos, mas **não permite** adicionar, editar ou excluir eventos diretamente na interface.

## ✅ O que é necessário

Para ter controle completo sobre os eventos (CRUD), você precisa:

1. **Credenciais da Google Calendar API** (OAuth 2.0)
2. **Biblioteca PHP do Google** (já existe no projeto: `calendar-actions.php`)
3. **Autenticação OAuth2**
4. **Endpoints para CRUD de eventos**

---

## 🔧 Passo 1: Obter Credenciais da Google Calendar API

### 1.1. Criar Projeto no Google Cloud Console

1. Acesse: https://console.cloud.google.com/
2. Crie um novo projeto ou selecione um existente
3. Ative a **Google Calendar API**:
   - Vá em "APIs & Services" > "Library"
   - Busque por "Google Calendar API"
   - Clique em "Enable"

### 1.2. Criar Credenciais OAuth 2.0

1. Vá em "APIs & Services" > "Credentials"
2. Clique em "Create Credentials" > "OAuth client ID"
3. Configure:
   - **Application type**: Web application
   - **Name**: SystemFy Calendar
   - **Authorized redirect URIs**: 
     - `http://localhost/google-calendar/callback.php` (desenvolvimento)
     - `https://seudominio.com/google-calendar/callback.php` (produção)
4. Baixe o arquivo JSON de credenciais
5. Renomeie para `credentials.json` e coloque na raiz do projeto

---

## 🔧 Passo 2: Instalar Dependências

O projeto já parece ter a biblioteca do Google. Verifique se está instalado:

```bash
composer require google/apiclient
```

Se não estiver, instale:

```bash
composer install
```

---

## 🔧 Passo 3: Estrutura de Arquivos Necessária

Você já tem alguns arquivos de exemplo (`calendar-actions.php`, `connect.php`, `callback.php`), mas precisam ser adaptados para o seu sistema.

### Estrutura sugerida:

```
/
├── config/
│   └── google-calendar-config.php  (configurações)
├── src/
│   └── GoogleCalendar/
│       ├── GoogleCalendarService.php  (serviço principal)
│       ├── AuthController.php         (autenticação)
│       └── EventController.php        (CRUD de eventos)
├── credentials.json                  (credenciais OAuth - NÃO commitar!)
└── vendor/                          (biblioteca Google)
```

---

## 🔧 Passo 4: Implementação Básica

### 4.1. Arquivo de Configuração

Crie: `config/google-calendar-config.php`

```php
<?php
return [
    'credentials_path' => __DIR__ . '/../credentials.json',
    'redirect_uri' => 'http://localhost/google-calendar/callback.php', // Ajuste para seu domínio
    'scopes' => [
        Google_Service_Calendar::CALENDAR,
        Google_Service_Calendar::CALENDAR_EVENTS
    ],
    'calendar_id' => 'primary', // ou o ID do calendário específico
    'timezone' => 'America/Sao_Paulo'
];
```

### 4.2. Serviço Principal

Crie: `src/GoogleCalendar/GoogleCalendarService.php`

```php
<?php

namespace Systemfy\App\GoogleCalendar;

use Google_Client;
use Google_Service_Calendar;

class GoogleCalendarService
{
    private Google_Client $client;
    private Google_Service_Calendar $service;
    private string $calendarId;

    public function __construct()
    {
        $config = require __DIR__ . '/../../config/google-calendar-config.php';
        
        $this->client = new Google_Client();
        $this->client->setAuthConfig($config['credentials_path']);
        $this->client->setScopes($config['scopes']);
        $this->client->setRedirectUri($config['redirect_uri']);
        $this->client->setAccessType('offline');
        $this->client->setPrompt('select_account consent');
        
        $this->calendarId = $config['calendar_id'];
        
        // Verificar se já tem token salvo
        if (isset($_SESSION['google_access_token'])) {
            $this->client->setAccessToken($_SESSION['google_access_token']);
        }
        
        $this->service = new Google_Service_Calendar($this->client);
    }

    public function getAuthUrl(): string
    {
        return $this->client->createAuthUrl();
    }

    public function authenticate(string $code): void
    {
        $token = $this->client->fetchAccessTokenWithAuthCode($code);
        $_SESSION['google_access_token'] = $token;
        $this->client->setAccessToken($token);
    }

    public function isAuthenticated(): bool
    {
        if (!isset($_SESSION['google_access_token'])) {
            return false;
        }
        
        $this->client->setAccessToken($_SESSION['google_access_token']);
        
        if ($this->client->isAccessTokenExpired()) {
            $this->client->refreshToken($this->client->getRefreshToken());
            $_SESSION['google_access_token'] = $this->client->getAccessToken();
        }
        
        return true;
    }

    // ========== LISTAR EVENTOS ==========
    public function listEvents(?\DateTime $timeMin = null, ?\DateTime $timeMax = null): array
    {
        $optParams = [];
        
        if ($timeMin) {
            $optParams['timeMin'] = $timeMin->format('c');
        }
        if ($timeMax) {
            $optParams['timeMax'] = $timeMax->format('c');
        }
        
        $results = $this->service->events->listEvents($this->calendarId, $optParams);
        return $results->getItems();
    }

    // ========== CRIAR EVENTO ==========
    public function createEvent(
        string $summary,
        \DateTime $start,
        \DateTime $end,
        ?string $description = null,
        ?string $location = null
    ): \Google_Service_Calendar_Event {
        $event = new \Google_Service_Calendar_Event([
            'summary' => $summary,
            'description' => $description,
            'location' => $location,
            'start' => [
                'dateTime' => $start->format('c'),
                'timeZone' => 'America/Sao_Paulo',
            ],
            'end' => [
                'dateTime' => $end->format('c'),
                'timeZone' => 'America/Sao_Paulo',
            ],
        ]);

        return $this->service->events->insert($this->calendarId, $event);
    }

    // ========== EDITAR EVENTO ==========
    public function updateEvent(
        string $eventId,
        string $summary,
        \DateTime $start,
        \DateTime $end,
        ?string $description = null,
        ?string $location = null
    ): \Google_Service_Calendar_Event {
        $event = $this->service->events->get($this->calendarId, $eventId);
        
        $event->setSummary($summary);
        $event->setDescription($description);
        $event->setLocation($location);
        $event->setStart(new \Google_Service_Calendar_EventDateTime([
            'dateTime' => $start->format('c'),
            'timeZone' => 'America/Sao_Paulo',
        ]));
        $event->setEnd(new \Google_Service_Calendar_EventDateTime([
            'dateTime' => $end->format('c'),
            'timeZone' => 'America/Sao_Paulo',
        ]));

        return $this->service->events->update($this->calendarId, $eventId, $event);
    }

    // ========== EXCLUIR EVENTO ==========
    public function deleteEvent(string $eventId): void
    {
        $this->service->events->delete($this->calendarId, $eventId);
    }

    // ========== OBTER EVENTO ==========
    public function getEvent(string $eventId): \Google_Service_Calendar_Event
    {
        return $this->service->events->get($this->calendarId, $eventId);
    }
}
```

---

## 🔧 Passo 5: Criar Controllers

### 5.1. Controller de Autenticação

Crie: `src/GoogleCalendar/AuthController.php`

```php
<?php

namespace Systemfy\App\GoogleCalendar;

use Systemfy\App\Controller\Controller;

class AuthController implements Controller
{
    public function processaRequisicao(): void
    {
        session_start();
        
        $service = new GoogleCalendarService();
        
        if (!$service->isAuthenticated()) {
            $authUrl = $service->getAuthUrl();
            header('Location: ' . $authUrl);
            exit;
        }
        
        // Redirecionar para a tela inicial
        header('Location: /client');
        exit;
    }
}
```

### 5.2. Controller de Callback

Crie: `src/GoogleCalendar/CallbackController.php`

```php
<?php

namespace Systemfy\App\GoogleCalendar;

use Systemfy\App\Controller\Controller;

class CallbackController implements Controller
{
    public function processaRequisicao(): void
    {
        session_start();
        
        if (!isset($_GET['code'])) {
            header('Location: /google-calendar/auth');
            exit;
        }
        
        $service = new GoogleCalendarService();
        $service->authenticate($_GET['code']);
        
        header('Location: /client');
        exit;
    }
}
```

### 5.3. Controller para Criar Evento

Crie: `src/GoogleCalendar/CreateEventController.php`

```php
<?php

namespace Systemfy\App\GoogleCalendar;

use Systemfy\App\Controller\Controller;

class CreateEventController implements Controller
{
    public function processaRequisicao(): void
    {
        session_start();
        
        $service = new GoogleCalendarService();
        
        if (!$service->isAuthenticated()) {
            http_response_code(401);
            echo json_encode(['error' => 'Não autenticado']);
            exit;
        }
        
        $data = json_decode(file_get_contents('php://input'), true);
        
        try {
            $start = new \DateTime($data['start']);
            $end = new \DateTime($data['end']);
            
            $event = $service->createEvent(
                $data['summary'],
                $start,
                $end,
                $data['description'] ?? null,
                $data['location'] ?? null
            );
            
            echo json_encode([
                'success' => true,
                'event' => [
                    'id' => $event->getId(),
                    'htmlLink' => $event->getHtmlLink(),
                ]
            ]);
        } catch (\Exception $e) {
            http_response_code(500);
            echo json_encode(['error' => $e->getMessage()]);
        }
    }
}
```

---

## 🔧 Passo 6: Adicionar Rotas

Adicione em `config/routes.php`:

```php
use Systemfy\App\GoogleCalendar\{
    AuthController,
    CallbackController,
    CreateEventController,
    // ... outros controllers
};

// ... outras rotas

'GET|/google-calendar/auth' => AuthController::class,
'GET|/google-calendar/callback' => CallbackController::class,
'POST|/google-calendar/events' => CreateEventController::class,
```

---

## 🔧 Passo 7: Interface Frontend

Substitua o iframe por uma interface customizada ou adicione botões de ação.

### Exemplo: Adicionar botão "Novo Evento"

No arquivo `View/Cliente/telaInicial.php`, adicione:

```html
<div class="calendar-api-container">
    <div class="calendar-header">
        <button id="btn-novo-evento" class="btn-novo-evento">
            <i class="fas fa-plus"></i> Novo Evento
        </button>
    </div>
    
    <!-- Mantenha o iframe ou substitua por uma visualização customizada -->
    <iframe class="frame_agenda" src="..." ...></iframe>
</div>

<!-- Modal para criar evento -->
<div id="modal-evento" class="modal">
    <div class="modal-content">
        <form id="form-evento">
            <input type="text" name="summary" placeholder="Título" required>
            <input type="datetime-local" name="start" required>
            <input type="datetime-local" name="end" required>
            <textarea name="description" placeholder="Descrição"></textarea>
            <button type="submit">Criar Evento</button>
        </form>
    </div>
</div>

<script>
document.getElementById('btn-novo-evento').addEventListener('click', () => {
    document.getElementById('modal-evento').style.display = 'block';
});

document.getElementById('form-evento').addEventListener('submit', async (e) => {
    e.preventDefault();
    const formData = new FormData(e.target);
    
    const response = await fetch('/google-calendar/events', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(Object.fromEntries(formData))
    });
    
    const result = await response.json();
    if (result.success) {
        alert('Evento criado!');
        location.reload();
    }
});
</script>
```

---

## ⚠️ Importante

1. **NÃO commite o arquivo `credentials.json`** no Git (adicione ao `.gitignore`)
2. **Configure o redirect URI** corretamente no Google Cloud Console
3. **Use HTTPS em produção** para segurança
4. **Gerencie os tokens** adequadamente (refresh quando expirar)

---

## 📚 Recursos

- [Google Calendar API Documentation](https://developers.google.com/calendar/api)
- [OAuth 2.0 Guide](https://developers.google.com/identity/protocols/oauth2)
- [PHP Client Library](https://github.com/googleapis/google-api-php-client)

---

## 🚀 Próximos Passos

1. Obter credenciais OAuth2
2. Implementar os serviços e controllers
3. Criar interface frontend para CRUD
4. Testar autenticação e operações
5. Integrar com o banco de dados local (se necessário)

