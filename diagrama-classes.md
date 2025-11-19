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
    }

    class Plano {
        -int id
        -string categoria
        -float preco
        -string descricao
        -bool ativo
    }

    class Exercise {
        -int id
        -int id_user
        -float peso
        -string repeticao
        -string tipo_exercicio
        -int dia
        -string observacao
        -string categoria
        -int id_personal
        -string video
    }

    class Menu {
        -int id
        -string horario
        -int categoria
        -string observacao
        -int id_user
        -int id_nutri
        -string titulo
    }

    class Report {
        -int id
        -Date data
        -User personal_id
        -User nutri_id
        -User objetivo
        -User user
        -Plano plano
    }

    class Checkin {
        -int id
        -int id_user
        -int id_exercise
        -string categoria
        -datetime data_checkin
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

    class ExerciseRepository {
        -PDO pdo
        +add(Exercise) bool
        +update(Exercise) bool
        +all() array
        +find(int) Exercise
        +findByUser(int) array
    }

    class MenuRepository {
        -PDO pdo
        +add(Menu) bool
        +update(Menu) bool
        +all() array
        +find(int) Menu
        +findByUser(int) array
    }

    class ReportRepository {
        -PDO pdo
        +add(Report) bool
        +all() array
        +find(int) Report
        +hydrateReport(array) Report
    }

    class CheckinRepository {
        -PDO pdo
        +add(Checkin) bool
        +findByUserAndExercise(int, int) Checkin
        +findByUser(int) array
    }

    class AgendaRepository {
        -PDO pdo
        +add(Agenda) bool
        +update(Agenda) bool
        +all() array
        +find(int) Agenda
    }

    class Database {
        <<utility>>
        +getConnection() PDO
    }

    User "1" --> "0..1" Plano : plano_id
    User --> Date : data_nasc
    User "1" --> "*" Exercise : id_user
    User "1" --> "*" Menu : id_user
    User "1" --> "*" Checkin : id_user
    Exercise "1" --> "*" Checkin : id_exercise
    UserRepository --> User : manages
    UserRepository --> PlanoRepository : uses
    UserRepository --> Database : uses
    PlanoRepository --> Plano : manages
    PlanoRepository --> Database : uses
    ExerciseRepository --> Exercise : manages
    ExerciseRepository --> Database : uses
    MenuRepository --> Menu : manages
    MenuRepository --> Database : uses
    ReportRepository --> Report : manages
    ReportRepository --> Database : uses
    CheckinRepository --> Checkin : manages
    CheckinRepository --> Database : uses
    AgendaRepository --> Database : uses
```

## Relacionamentos

- **User** possui uma relação opcional (0..1) com **Plano** através do atributo `plano_id`
- **User** utiliza **Date** para representar a data de nascimento
- **User** possui múltiplos **Exercise** (1 para muitos)
- **User** possui múltiplos **Menu** (1 para muitos)
- **User** possui múltiplos **Checkin** (1 para muitos)
- **Exercise** possui múltiplos **Checkin** (1 para muitos)
- **UserRepository** gerencia objetos **User** e utiliza **PlanoRepository** para buscar planos
- **PlanoRepository** gerencia objetos **Plano**
- **ExerciseRepository** gerencia objetos **Exercise**
- **MenuRepository** gerencia objetos **Menu**
- **ReportRepository** gerencia objetos **Report**
- **CheckinRepository** gerencia objetos **Checkin**
- **AgendaRepository** gerencia objetos **Agenda**
- Todos os repositórios utilizam **Database** para obter a conexão PDO

