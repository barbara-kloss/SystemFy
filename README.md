# SystemFy

Sistema de gerenciamento completo para academias e profissionais de educação física e nutrição, desenvolvido em PHP.

## 📋 Sobre o Projeto

O **SystemFy** é uma plataforma web que permite o gerenciamento completo de clientes, treinos, planos nutricionais, agendas e relatórios. O sistema possui duas interfaces principais: uma para administradores (personal trainers e nutricionistas) e outra para clientes.

## ✨ Funcionalidades

### 👨‍💼 Área do Administrador

- **Gerenciamento de Clientes**
  - Cadastro, edição e visualização de clientes
  - Controle de status (ativo/inativo)
  - Associação de planos aos clientes
  - Visualização de perfil completo do cliente

- **Gerenciamento de Treinos**
  - Criação e edição de exercícios
  - Organização por categoria e dia da semana
  - Associação de vídeos do YouTube aos exercícios
  - Controle de check-ins dos clientes

- **Gerenciamento Nutricional**
  - Criação de cardápios personalizados
  - Organização por refeições (Geral e Livre)
  - Controle de horários e observações

- **Agenda**
  - Integração com Google Calendar
  - Agendamento de consultas e treinos
  - Visualização de eventos

- **Planos**
  - Criação e gerenciamento de planos de treino/nutrição
  - Controle de preços e descrições
  - Status ativo/inativo

- **Relatórios**
  - Geração de relatórios de desempenho
  - Exportação de dados

- **Perfil**
  - Visualização e edição de dados pessoais
  - Upload de foto de perfil
  - Dashboard com atividades recentes

### 👤 Área do Cliente

- **Dashboard**
  - Visualização de progresso (peso, IMC, percentuais)
  - Gráficos de evolução
  - Calendário integrado

- **Treinos**
  - Visualização de exercícios por dia da semana
  - Check-in de exercícios realizados
  - Visualização de vídeos dos exercícios

- **Nutricional**
  - Visualização de cardápios
  - Filtro por período (Manhã, Tarde, Noite)
  - Detalhes das refeições

- **Agenda**
  - Visualização de compromissos
  - Criação e edição de eventos

- **Perfil**
  - Visualização de dados pessoais
  - Métricas físicas (peso, altura, IMC, gordura, massa magra)
  - Histórico de observações

## 🛠️ Tecnologias Utilizadas

- **Backend**
  - PHP 8.0+
  - PDO (MySQL)
  - Arquitetura MVC
  - PSR-4 Autoloading

- **Frontend**
  - HTML5
  - CSS3
  - JavaScript (Vanilla)
  - Font Awesome (ícones)
  - Google Fonts (Alata, Akshar)

- **Banco de Dados**
  - MySQL/MariaDB

- **Ferramentas**
  - Composer (gerenciamento de dependências)
  - Google Calendar API (integração)

## 📦 Requisitos

- PHP 8.0 ou superior
- MySQL 5.7+ ou MariaDB 10.3+
- Servidor web (Apache/Nginx)
- Composer
- Extensões PHP:
  - PDO
  - PDO_MySQL
  - JSON
  - Session
  - mbstring

## 🚀 Instalação

### 1. Clone o repositório

```bash
git clone https://github.com/seu-usuario/SystemFy.git
cd SystemFy
```

### 2. Instale as dependências

```bash
composer install
```

### 3. Configure o banco de dados

1. Crie um banco de dados MySQL:

```sql
CREATE DATABASE systemfy ;
```

2. Execute os scripts SQL necessários (crie as tabelas conforme a estrutura do sistema)

3. Configure a conexão em `src/Database.php`:

```php
$host = 'localhost:3306';
$db = 'systemfy';
$user = 'seu_usuario';
$pass = 'sua_senha';
```

### 4. Permissões (Linux/Mac)

```bash
chmod -R 755 public/
chmod -R 755 src/
```

## 📁 Estrutura do Projeto

```
SystemFy/
├── config/
│   └── routes.php
├── public/
│   ├── css/
│   ├── imgFy/
│   └── index.php
├── src/
│   ├── Admin/
│   │   ├── AgendaController/
│   │   ├── ExerciseController/
│   │   ├── MenuController/
│   │   ├── PlanoController/
│   │   └── ReportController/
│   ├── Client/
│   │   ├── ClientAgendaController/
│   │   ├── ClientExerciseController/
│   │   └── ClientMenuController/
│   ├── Controller/
│   ├── ControllerLogin/
│   ├── Database.php
│   ├── Model/
│   └── Repository/
├── View/
│   ├── Admin/
│   ├── Cliente/
│   └── LoginGeralHTML.php
├── vendor/
├── composer.json
└── README.md
```

### Descrição dos Diretórios

- **config/** - Configurações do sistema
  - `routes.php` - Definição de rotas da aplicação

- **public/** - Ponto de entrada público do sistema
  - `css/` - Arquivos de estilos CSS
  - `imgFy/` - Imagens e assets do sistema
  - `index.php` - Front Controller (ponto de entrada principal)

- **src/** - Código fonte da aplicação
  - **Admin/** - Controllers do administrador
    - `AgendaController/` - Gerenciamento de agenda
    - `ExerciseController/` - Gerenciamento de exercícios
    - `MenuController/` - Gerenciamento de cardápios
    - `PlanoController/` - Gerenciamento de planos
    - `ReportController/` - Geração de relatórios
  - **Client/** - Controllers do cliente
    - `ClientAgendaController/` - Visualização de agenda do cliente
    - `ClientExerciseController/` - Visualização de treinos do cliente
    - `ClientMenuController/` - Visualização de cardápios do cliente
  - **Controller/** - Controllers principais
  - **ControllerLogin/** - Controllers de autenticação
  - `Database.php` - Classe de conexão com banco de dados
  - **Model/** - Modelos de dados (entidades)
  - **Repository/** - Repositórios (camada de acesso a dados)

- **View/** - Views/Templates da aplicação
  - **Admin/** - Views do administrador
  - **Cliente/** - Views do cliente
  - `LoginGeralHTML.php` - Template de login

- **vendor/** - Dependências do Composer (geradas automaticamente)

- `composer.json` - Configuração do Composer e dependências do projeto

- `README.md` - Documentação do projeto

## 🔐 Autenticação

O sistema utiliza sessões PHP para autenticação. Após o login, os seguintes dados são armazenados na sessão:

- `$_SESSION['logado']` - Status de autenticação
- `$_SESSION['user_id']` - ID do usuário
- `$_SESSION['permissao']` - Tipo de usuário (admin/cliente)
- `$_SESSION['user_email']` - Email do usuário

### Níveis de Acesso

- **Admin**: Acesso completo ao sistema
- **Cliente**: Acesso restrito à própria área

## 🗄️ Estrutura do Banco de Dados

### Tabelas Principais

- `user` - Usuários (clientes e administradores)
- `plano` - Planos de treino/nutrição
- `exercise` - Exercícios
- `menu` - Cardápios e refeições
- `agenda` - Eventos e compromissos
- `checkin` - Check-ins de exercícios
- `report` - Relatórios

## 📝 Rotas Principais

### Autenticação
- `GET /login` - Formulário de login
- `POST /login` - Processa login
- `GET /logout` - Logout
- `GET /cadastro` - Formulário de cadastro
- `POST /cadastro` - Processa cadastro

### Administrador
- `GET /admin` - Dashboard
- `GET /admin/exercise/list` - Lista de exercícios
- `GET /admin/menu/list` - Lista de cardápios
- `GET /admin/agenda/list` - Lista de eventos
- `GET /admin/plano/list` - Lista de planos
- `GET /admin/report/list` - Relatórios
- `GET /admin/perfil` - Perfil do administrador

### Cliente
- `GET /client` - Dashboard
- `GET /client/exercise/list` - Treinos
- `GET /client/menu/list` - Cardápios
- `GET /client/agenda/list` - Agenda
- `GET /client/perfil` - Perfil do cliente

## 🔧 Configuração

### Banco de Dados

Edite `src/Database.php` com suas credenciais:

```php
$host = 'localhost:3306';
$db = 'systemfy';
$user = 'root';
$pass = 'sua_senha';
```

### Google Calendar (Opcional)

Para integração completa com Google Calendar, consulte o arquivo `GUIA_INTEGRACAO_GOOGLE_CALENDAR.md`.

## 🎨 Personalização

### Cores e Estilos

Os arquivos CSS estão em `public/css/`. As cores principais do sistema são:

- Fundo escuro: `#2A2A2A`
- Dourado: `#DDB35E`
- Bege claro: `#FFFAE6`
- Cinza: `#D4D2C8`

### Fontes

O sistema utiliza as fontes:
- **Alata** - Títulos e textos principais
- **Akshar** - Textos secundários e botões

## 📊 Diagrama de Classes

Consulte o arquivo `diagrama-classes.md` para visualizar a estrutura de classes do sistema em formato Mermaid.

## 🐛 Troubleshooting

### Erro de conexão com banco de dados

Verifique:
- Credenciais em `src/Database.php`
- Se o MySQL está rodando
- Se o banco de dados `systemfy` existe

### Página em branco

- Verifique os logs de erro do PHP
- Certifique-se de que o `vendor/autoload.php` existe (execute `composer install`)
- Verifique as permissões dos arquivos

### Sessão não funciona

- Verifique se `session_start()` está sendo chamado
- Certifique-se de que as permissões de escrita estão habilitadas para sessões

## 👥 Autores

- **Barbara Kloss Furquim** - barbarakf383@gmail.com
- **Thauana Vitória Carneiro Feyth** - thauana@gmail.com

## 📄 Licença

Este projeto está licenciado sob a Licença MIT - veja o arquivo `LICENSE` para detalhes.

## 🤝 Contribuindo

Contribuições são bem-vindas! Sinta-se à vontade para:

1. Fazer um fork do projeto
2. Criar uma branch para sua feature (`git checkout -b feature/AmazingFeature`)
3. Commit suas mudanças (`git commit -m 'Add some AmazingFeature'`)
4. Push para a branch (`git push origin feature/AmazingFeature`)
5. Abrir um Pull Request

## 📞 Suporte

Para suporte, envie um e-mail para barbarakf383@gmail.com ou abra uma issue no repositório.

## 🔮 Próximas Funcionalidades

- [ ] Upload de imagens de perfil
- [ ] Notificações push
- [ ] App mobile
- [ ] Integração com pagamentos
- [ ] Chat em tempo real
- [ ] Relatórios avançados com gráficos

---

**Desenvolvido com ❤️ para profissionais de educação física e nutrição**


