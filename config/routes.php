<?php


use Systemfy\App\Admin\ExerciseController\{
    ExerciseListController,
    DeleteExerciseController,
    EditExerciseController,
    ExerciseFormController,
    NewExerciseController
};

use Systemfy\App\Admin\MenuController\{
    NewMenuController,
    DeleteMenuController,
    EditMenuController,
    MenuFormController,
    MenuListController
};

use Systemfy\App\Admin\PlanoController\{
    EditPlanoController,
    NewPlanoController,
    PlanoFormController
};

use Systemfy\App\Admin\ReportController\{
    ReportListController,
    NewReportController,
    ReportFormController
};

use Systemfy\App\Controller\{
    MainAdminController,
    MainClienteController
};
use Systemfy\App\ControllerLogin\{
    NewUserController,
    RegisterController,
    LoginController,
    LoginFormController,
    LogoutController
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
