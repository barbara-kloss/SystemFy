<?php


use Systemfy\App\Controller\{
    MainAdminController
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
    EditPlanoController
};

use Systemfy\App\ReportController\{
    ReportListController,
    ReportFormController,
    NewReportController,
    EditReportController,
};

use Systemfy\App\ControllerLogin\{
    LoginFormController,
    LoginController,
    LogoutController,
    RegisterController,
    NewUserController
};

return [
    'GET|/admin' => MainAdminController::class,
    'GET|/cliente' => MainClienteController::class,
    'GET|/exercise/list' => ExerciseListController::class,
    'GET|/exercise/save' => ExerciseFormController::class,
    'POST|/exercise/save' => NewExerciseController::class,
    'GET|/exercise/edit' => ExerciseFormController::class,
    'POST|/exercise/edit' => EditExerciseController::class,
    'GET|/exercise/delete' => DeleteExerciseController::class,
    // exercise
    'GET|/menu/list' => MenuListController::class,
    'GET|/menu/save' => MenuFormController::class,
    'POST|/menu/save' => NewMenuController::class,
    'GET|/menu/edit' => MenuFormController::class,
    'POST|/menu/edit' => EditMenuController::class,
    'GET|/menu/delete' => DeleteMenuController::class,
    // menu
//    'GET|/others' => TableListController::class,
    //
    'GET|/plano/save' => PlanoFormController::class,
    'POST|/plano/save' => NewPlanoController::class,
    'GET|/plano/edit' => PlanoFormController::class,
    'POST|/plano/edit' => EditPlanoController::class,
    // plano
    'GET|/report/save' => ReportFormController::class,
    'POST|/report/save' => NewReportController::class,
    'GET|/report/edit' => ReportFormController::class,
    'POST|/report/edit' => EditPlanoController::class,
    'GET|/report/list' => ReportListController::class,
    // report
    'GET|/login' => LoginFormController::class,
    'POST|/login' => LoginController::class,
    'GET|/logout' => LogoutController::class,
    'GET|/cadastro' => RegisterController::class,
    'POST|/cadastro' => NewUserController::class,
];
