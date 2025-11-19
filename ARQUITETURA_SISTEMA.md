# 📚 Arquitetura do Sistema SystemFy

## 🏗️ Visão Geral da Arquitetura

O SystemFy utiliza uma **arquitetura em camadas (Layered Architecture)** com padrão **MVC (Model-View-Controller)** adaptado, seguindo os princípios de **Separação de Responsabilidades** e **Injeção de Dependências**.

---

## 📂 Estrutura de Diretórios

```
SystemFy/
├── public/              # Ponto de entrada público (index.php)
├── src/                # Código-fonte principal
│   ├── Controller/     # Controllers principais
│   ├── ControllerLogin/ # Controllers de autenticação
│   ├── Admin/          # Controllers específicos do admin
│   ├── Client/         # Controllers específicos do cliente
│   ├── Model/          # Entidades de domínio
│   ├── Repository/     # Camada de acesso a dados
│   └── Database.php     # Gerenciador de conexão
├── View/               # Templates/Páginas HTML
├── config/             # Configurações (rotas)
└── vendor/             # Dependências (Composer)
```

---

## 🔄 Fluxo de Requisição HTTP

### 1. **Ponto de Entrada** (`public/index.php`)

Toda requisição HTTP passa por este arquivo:

```php
// 1. Carrega autoloader do Composer
require_once __DIR__ . '/../vendor/autoload.php';

// 2. Estabelece conexão com banco
$pdo = Database::getConnection();

// 3. Cria instâncias dos Repositories
$userRepository = new UserRepository($planoRepository);
$exerciseRepository = new ExerciseRepository();
// ... outros repositories

// 4. Carrega rotas
$routes = require __DIR__ . '/../config/routes.php';

// 5. Identifica método HTTP e caminho
$pathInfo = $_SERVER['REQUEST_URI'];
$httpMethod = $_SERVER['REQUEST_METHOD'];

// 6. Verifica autenticação
session_start();
if (!$_SESSION['logado'] && !$isLoginRoute) {
    header('Location: /login');
}

// 7. Busca controller correspondente
$key = "$httpMethod|$pathInfo";
$controllerClass = $routes[$key];

// 8. Instancia controller com dependências
$controller = new $controllerClass($repository1, $repository2, ...);

// 9. Executa o controller
$controller->processaRequisicao();
```

---

## 🎯 Camadas da Arquitetura

### **1. Camada de Roteamento** (`config/routes.php`)

Define o mapeamento entre URLs e Controllers:

```php
return [
    'GET|/login' => LoginFormController::class,
    'POST|/login' => LoginController::class,
    'GET|/admin/exercise/list' => ExerciseListController::class,
    'POST|/admin/exercise/save' => NewExerciseController::class,
    // ...
];
```

**Formato da chave**: `"MÉTODO|/caminho"` → `ClasseController`

---

### **2. Camada de Controllers**

#### **Interface `Controller`**

Toda classe controller implementa esta interface:

```php
interface Controller {
    public function processaRequisicao(): void;
}
```

#### **Tipos de Controllers**

1. **Form Controllers** (GET): Exibem formulários
   ```php
   class ExerciseFormController implements Controller {
       public function processaRequisicao(): void {
           // Busca dados necessários
           $exercise = $this->exerciseRepository->find($id);
           // Renderiza view
           require_once __DIR__ . '/../../../View/Admin/telaPersonal.php';
       }
   }
   ```

2. **Action Controllers** (POST): Processam submissões
   ```php
   class NewExerciseController implements Controller {
       public function processaRequisicao(): void {
           // Valida dados do POST
           $dados = filter_input(INPUT_POST, 'campo');
           // Cria objeto Model
           $exercise = new Exercise(...);
           // Salva via Repository
           $this->exerciseRepository->add($exercise);
           // Redireciona
           header('Location: /admin/exercise/list');
       }
   }
   ```

3. **List Controllers** (GET): Listam registros
   ```php
   class ExerciseListController implements Controller {
       public function processaRequisicao(): void {
           $exerciseList = $this->exerciseRepository->findAll();
           require_once __DIR__ . '/../../../View/Admin/telaPersonal.php';
       }
   }
   ```

#### **Injeção de Dependências**

Os controllers recebem repositories via construtor:

```php
class ExerciseListController {
    function __construct(
        private ExerciseRepository $exerciseRepository
    ) {}
}
```

No `index.php`, as dependências são injetadas manualmente:

```php
if ($controllerClass === ExerciseListController::class) {
    $controller = new $controllerClass($exerciseRepository);
}
```

---

### **3. Camada de Repository (Acesso a Dados)**

#### **Responsabilidades**

- **Isolamento do banco de dados**: Controllers não conhecem SQL
- **Conversão de dados**: Transforma arrays do banco em objetos Model
- **Operações CRUD**: Create, Read, Update, Delete

#### **Exemplo: `UserRepository`**

```php
class UserRepository {
    private PDO $pdo;
    
    function __construct(?PlanoRepository $planoRepository = null) {
        $this->pdo = Database::getConnection();
    }
    
    // CREATE
    public function add(User $user): bool {
        $sql = "INSERT INTO user (nome_completo, email, ...) VALUES (?, ?, ...)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $user->getNome());
        // ...
        return $stmt->execute();
    }
    
    // READ
    public function find(int $id): ?User {
        $sql = "SELECT * FROM user WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $id);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if (!$data) return null;
        
        // Converte array em objeto User
        return $this->hydrateUser($data);
    }
    
    // UPDATE
    public function update(User $user): bool {
        $sql = "UPDATE user SET nome_completo = ?, ... WHERE id = ?";
        // ...
    }
    
    // DELETE
    public function remove(int $id): bool {
        $sql = "DELETE FROM user WHERE id = ?";
        // ...
    }
    
    // Método auxiliar: converte array em objeto
    private function hydrateUser(array $data): User {
        $plano = null;
        if ($data['plano_id'] && $this->planoRepository) {
            $plano = $this->planoRepository->find($data['plano_id']);
        }
        
        return new User(
            $data['id'],
            $data['nome_completo'],
            new Date($data['data_nascimento']),
            // ... outros campos
        );
    }
}
```

#### **Padrão Repository**

- **Um Repository por entidade**: `UserRepository`, `ExerciseRepository`, `MenuRepository`, etc.
- **Métodos comuns**: `find()`, `findAll()`, `add()`, `update()`, `remove()`
- **Métodos específicos**: `findByEmail()`, `findActiveUsers()`, etc.

---

### **4. Camada de Model (Entidades de Domínio)**

#### **Responsabilidades**

- **Representar entidades do negócio**: User, Exercise, Menu, Plano, etc.
- **Encapsular dados**: Propriedades privadas com getters/setters
- **Validação básica**: Garantir integridade dos dados

#### **Exemplo: `User`**

```php
class User {
    private int $id;
    private string $nome;
    private string $email;
    private Date $data_nasc;
    private string $genero;
    private ?Plano $plano_id; // Relacionamento opcional
    
    // Construtor
    function __construct(
        int $id,
        string $nome,
        Date $data_nasc,
        // ... outros parâmetros
    ) {
        $this->id = $id;
        $this->nome = $nome;
        // ...
    }
    
    // Getters
    public function getId(): int {
        return $this->id;
    }
    
    public function getNome(): string {
        return $this->nome;
    }
    
    // Setters
    public function setNome(string $nome): void {
        $this->nome = $nome;
    }
}
```

#### **Relacionamentos entre Models**

- **User → Plano**: Um usuário pode ter um plano (opcional)
- **Exercise → User**: Um exercício pertence a um usuário
- **Menu → User**: Um menu pertence a um usuário

---

### **5. Camada de View (Apresentação)**

#### **Estrutura**

- **Templates PHP**: Arquivos `.php` que misturam HTML e PHP
- **Localização**: `View/Admin/` e `View/Cliente/`
- **CSS**: `public/css/` (um arquivo por tela)
- **JavaScript**: `public/js/` (notificações, validações, etc.)

#### **Exemplo de View**

```php
<?php
// Controller já preparou os dados
$exerciseList = []; // Preenchido pelo controller
$exercise = null;
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="/css/telaPersonal.css">
</head>
<body>
    <h1>Exercícios</h1>
    
    <?php foreach ($exerciseList as $ex): ?>
        <div>
            <p><?= htmlspecialchars($ex->getTipoExercicio()) ?></p>
        </div>
    <?php endforeach; ?>
    
    <script src="/js/notifications.js"></script>
</body>
</html>
```

---

### **6. Camada de Database (Conexão)**

#### **Classe `Database`**

```php
class Database {
    public static function getConnection(): PDO {
        $host = 'localhost:3306';
        $db = 'systemfy';
        $user = 'root';
        $pass = 'root';
        
        $dsn = "mysql:host=$host;dbname=$db;charset=utf8";
        
        $pdo = new PDO($dsn, $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        return $pdo;
    }
}
```

**Padrão Singleton**: Uma única conexão compartilhada por toda a aplicação.

---

## 🔐 Sistema de Autenticação

### **Fluxo de Login**

1. **GET `/login`** → `LoginFormController`
   - Exibe formulário de login

2. **POST `/login`** → `LoginController`
   ```php
   // Valida email e senha
   $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
   $senha = filter_input(INPUT_POST, 'senha');
   
   // Busca usuário no banco
   $sql = "SELECT * FROM user WHERE email = ?";
   $userData = $stmt->fetch(PDO::FETCH_ASSOC);
   
   // Verifica senha (hash Argon2ID)
   if (password_verify($senha, $userData['senha'])) {
       // Cria sessão
       $_SESSION['logado'] = true;
       $_SESSION['user_id'] = $userData['id'];
       $_SESSION['permissao'] = $userData['permissao'];
       
       // Redireciona conforme permissão
       if ($userData['permissao'] === 'admin') {
           header('Location: /admin');
       } else {
           header('Location: /client');
       }
   }
   ```

3. **Proteção de Rotas** (no `index.php`)
   ```php
   if (!$_SESSION['logado'] && !$isLoginRoute && !$isCadastroRoute) {
       header('Location: /login');
   }
   ```

---

## 🎨 Padrões de Design Utilizados

### **1. Repository Pattern**
- Separa lógica de acesso a dados da lógica de negócio
- Facilita testes e manutenção

### **2. Dependency Injection**
- Controllers recebem dependências via construtor
- Reduz acoplamento entre classes

### **3. MVC (Model-View-Controller)**
- **Model**: Entidades de domínio (`User`, `Exercise`, etc.)
- **View**: Templates PHP (`View/Admin/`, `View/Cliente/`)
- **Controller**: Processa requisições e coordena Model/View

### **4. Front Controller**
- `index.php` é o único ponto de entrada
- Centraliza roteamento e autenticação

### **5. Active Record (parcial)**
- Models contêm dados e lógica básica
- Repositories fazem persistência

---

## 📊 Exemplo Completo: Criar um Exercício

### **1. Usuário acessa formulário**
```
GET /admin/exercise/save
```

### **2. Roteamento**
```php
// config/routes.php
'GET|/admin/exercise/save' => ExerciseFormController::class
```

### **3. Controller processa**
```php
class ExerciseFormController {
    public function processaRequisicao(): void {
        // Busca dados necessários (ex: lista de clientes)
        $clientes = $this->userRepository->findAll();
        // Renderiza view
        require_once __DIR__ . '/../../../View/Admin/telaPersonal.php';
    }
}
```

### **4. View exibe formulário**
```html
<form action="/admin/exercise/save" method="POST">
    <input name="tipo_exercicio" required>
    <input name="peso" type="number">
    <button type="submit">Salvar</button>
</form>
```

### **5. Usuário submete formulário**
```
POST /admin/exercise/save
```

### **6. Controller processa submissão**
```php
class NewExerciseController {
    public function processaRequisicao(): void {
        // Valida dados
        $tipo = filter_input(INPUT_POST, 'tipo_exercicio');
        $peso = filter_input(INPUT_POST, 'peso', FILTER_VALIDATE_FLOAT);
        
        // Cria objeto Model
        $exercise = new Exercise(
            id: 0,
            tipoExercicio: $tipo,
            peso: $peso,
            // ...
        );
        
        // Salva via Repository
        if ($this->exerciseRepository->add($exercise)) {
            header('Location: /admin/exercise/list?sucesso=1');
        } else {
            header('Location: /admin/exercise/save?erro=1');
        }
    }
}
```

### **7. Repository persiste no banco**
```php
class ExerciseRepository {
    public function add(Exercise $exercise): bool {
        $sql = "INSERT INTO exercise (tipo_exercicio, peso, ...) VALUES (?, ?, ...)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $exercise->getTipoExercicio());
        $stmt->bindValue(2, $exercise->getPeso());
        return $stmt->execute();
    }
}
```

---

## 🔗 Relacionamentos entre Classes

### **Dependências**

```
Controller → Repository → Database
Controller → Model
Controller → View
Repository → Model
Model → Model (relacionamentos)
```

### **Exemplo Visual**

```
┌─────────────┐
│   Browser   │
└──────┬──────┘
       │ HTTP Request
       ▼
┌─────────────────┐
│  public/index.php│  ← Front Controller
└──────┬──────────┘
       │
       ▼
┌─────────────────┐
│  routes.php     │  ← Roteamento
└──────┬──────────┘
       │
       ▼
┌─────────────────┐
│   Controller    │  ← Lógica de negócio
└──────┬──────────┘
       │
       ├──────────────┐
       ▼              ▼
┌─────────────┐  ┌─────────────┐
│  Repository │  │    Model    │
└──────┬──────┘  └──────────────┘
       │
       ▼
┌─────────────┐
│  Database   │  ← MySQL via PDO
└─────────────┘
```

---

## 🛠️ Tecnologias e Ferramentas

- **PHP 8+**: Linguagem principal
- **MySQL**: Banco de dados
- **PDO**: Abstração de banco de dados
- **Composer**: Gerenciador de dependências
- **Sessions**: Autenticação e estado
- **HTML/CSS/JavaScript**: Frontend
- **jsPDF**: Geração de PDFs no cliente
- **Google Calendar API**: Integração com calendário

---

## 📝 Boas Práticas Implementadas

1. **Separação de Responsabilidades**: Cada classe tem uma única responsabilidade
2. **Injeção de Dependências**: Reduz acoplamento
3. **Prepared Statements**: Previne SQL Injection
4. **Password Hashing**: Senhas com Argon2ID
5. **Input Validation**: `filter_input()` para sanitização
6. **Output Escaping**: `htmlspecialchars()` nas views
7. **Error Handling**: Try-catch em operações críticas
8. **Session Management**: Controle de autenticação

---

## 🚀 Como Adicionar uma Nova Funcionalidade

### **Exemplo: Adicionar "Produtos"**

1. **Criar Model**: `src/Model/Product.php`
2. **Criar Repository**: `src/Repository/ProductRepository.php`
3. **Criar Controllers**: 
   - `src/Admin/ProductController/ProductListController.php`
   - `src/Admin/ProductController/ProductFormController.php`
   - `src/Admin/ProductController/NewProductController.php`
4. **Adicionar Rotas**: `config/routes.php`
5. **Criar View**: `View/Admin/telaProdutos.php`
6. **Injetar Dependências**: `public/index.php`
7. **Criar CSS**: `public/css/telaProdutos.css`

---

## 📚 Conclusão

O SystemFy utiliza uma arquitetura **limpa e organizada**, facilitando:
- **Manutenção**: Código organizado em camadas
- **Testabilidade**: Dependências injetadas
- **Escalabilidade**: Fácil adicionar novas funcionalidades
- **Segurança**: Validações e prepared statements

Esta arquitetura segue princípios SOLID e boas práticas de desenvolvimento PHP moderno.


