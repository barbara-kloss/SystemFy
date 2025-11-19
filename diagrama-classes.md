# Diagrama de Classes - SystemFy

```mermaid
classDiagram
    class User {
        -int id
        -string nome
        -string email
        -Date data_nasc
        -string genero
        -string telefone
        -string senha
        -string permissao
        -float altura
        -int peso
        -bool status
        -string observacao
        -float massa
        -float gordura
        -Plano plano_id
        -string objetivo
        -string foto
        -float peso_meta
        +__construct(...)
        +getId() int
        +getNome() string
        +getEmail() string
        +getDataNasc() Date
        +getGenero() string
        +getTelefone() string
        +getSenha() string
        +getPermissao() string
        +getAltura() float
        +getPeso() int
        +getStatus() bool
        +getObservacao() string
        +getMassa() float
        +getGordura() float
        +getPlanoId() Plano
        +getObjetivo() string
        +getFoto() string
        +getPesoMeta() float
        +setId(int) void
        +setNome(string) void
        +setEmail(string) void
        +setDate(Date) void
        +setGenero(string) void
        +setTelefone(string) void
        +setSenha(string) void
        +setPermissao(string) void
        +setAltura(float) void
        +setPeso(int) void
        +setStatus(bool) void
        +setObs(string) void
        +setMassa(float) void
        +setGordura(float) void
        +setPlano(Plano) void
        +setObjetivo(string) void
        +setFoto(string) void
        +setPesoMeta(float) void
    }

    class Plano {
        -int id
        -string categoria
        -float preco
        -string descricao
        -bool ativo
        +__construct(int, string, float, string, bool)
        +getId() int
        +getCategoria() string
        +getPreco() float
        +getDescricao() string
        +getAtivo() bool
        +setId(int) void
        +setCategoria(string) void
        +setPreco(float) void
        +setDescricao(string) void
        +setAtivo(bool) void
    }

    class Date {
        -string date
        +__construct(string)
        +getDate() string
        +__toString() string
    }

    class UserRepository {
        -PDO pdo
        -PlanoRepository planoRepository
        -string lastError
        +__construct(PlanoRepository)
        +getLastError() string
        +add(User) bool
        +update(User) bool
        +all() array
        +find(int) User
        +hydrateUser(array) User
        +countActiveClients() int
    }

    class PlanoRepository {
        -PDO pdo
        +__construct()
        +add(Plano) bool
        +update(Plano) bool
        +all() array
        +find(int) Plano
        +hydratePlano(array) Plano
    }

    class Database {
        <<utility>>
        +getConnection() PDO
    }

    User "1" --> "0..1" Plano : plano_id
    User --> Date : data_nasc
    UserRepository --> User : manages
    UserRepository --> PlanoRepository : uses
    UserRepository --> Database : uses
    PlanoRepository --> Plano : manages
    PlanoRepository --> Database : uses
```

## Relacionamentos

- **User** possui uma relação opcional (0..1) com **Plano** através do atributo `plano_id`
- **User** utiliza **Date** para representar a data de nascimento
- **UserRepository** gerencia objetos **User** e utiliza **PlanoRepository** para buscar planos
- **PlanoRepository** gerencia objetos **Plano**
- Ambos os repositórios utilizam **Database** para obter a conexão PDO

