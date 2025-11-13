<?php


use Systemfy\App\Controller\{
    MainController
};

use Systemfy\App\AgendaController\{
    AgendaListController,
    AgendaFormController,
    NewAgendaController,
    EditAgendaController,
    DeleteAgendaController
};

use Systemfy\App\ExerciseController\{
    ExerciseListController,
    ExerciseFormController,
    EditExerciseController,
    DeleteExerciseController,
    NewExerciseController
};

use Systemfy\App\MenuController\{
    MenuListController,
    MenuFormController,
    NewMenuController,
    EditMenuController,
    DeleteMenuController
};

use Systemfy\App\PlanoController\{
    PlanoListController,
    PlanoFormController,
    NewPlanoController,
    EditPlanoController,
    DeletePlanoController
};

use Systemfy\App\ReportController\{
    ReportListController,
    ReportFormController,
    NewReportController,
    EditReportController,
    DeleteReportController
};

use Systemfy\App\ControllerLogin\{
    LoginFormController,
    LoginController,
    LogoutController,
    RegisterController,
    NewUserController
};

return [
    'GET|/' => MainController::class,
    'GET|/booklist' => BookListController::class,
    'GET|/savebook' => BookFormController::class,
    'POST|/savebook' => NewBookController::class,
    'GET|/editbook' => BookFormController::class,
    'POST|/editbook' => EditBookController::class,
    'GET|/deletebook' => DeleteBookController::class,
    'GET|/filmlist' => FilmListController::class,
    'GET|/savefilm' => FilmFormController::class,
    'POST|/savefilm' => NewFilmController::class,
    'GET|/editfilm' => FilmFormController::class,
    'POST|/editfilm' => EditFilmController::class,
    'GET|/deletefilm' => DeleteFilmController::class,
    'GET|/others' => TableListController::class,
    'GET|/savetable' => TableFormController::class,
    'POST|/savetable' => NewTableController::class,
    'GET|/edittable' => TableFormController::class,
    'POST|/edittable' => EditTableController::class,
    'GET|/deletetable' => DeleteTableController::class,
    'GET|/login' => LoginFormController::class,
    'POST|/login' => LoginController::class,
    'GET|/logout' => LogoutController::class,
    'GET|/cadastro' => RegisterController::class,
    'POST|/cadastro' => NewUserController::class,
];