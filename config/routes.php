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
    ReportFormController,
    EditReportController
};

use Systemfy\App\Admin\AgendaController\{
    AgendaFormController,
    AgendaListController,
    DeleteAgendaController,
    EditAgendaController,
    NewAgendaController
};

use Systemfy\App\Client\ClientAgendaController\{
    ClientAgendaFormController,
    ClientAgendaListController,
    ClientDeleteAgendaController,
    ClientEditAgendaController,
    ClientNewAgendaController
};

use Systemfy\App\Client\ClientExerciseController\ClientExerciseListController;
use Systemfy\App\Client\ClientMenuController\ClientMenuListController;

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
    'GET|/client' => MainClienteController::class,
    'GET|/admin/exercise/list' => ExerciseListController::class,
    'GET|/admin/exercise/save' => ExerciseFormController::class,
    'POST|/admin/exercise/save' => NewExerciseController::class,
    'GET|/admin/exercise/edit' => ExerciseFormController::class,
    'POST|/admin/exercise/edit' => EditExerciseController::class,
    'GET|/admin/exercise/delete' => DeleteExerciseController::class,
    // exercise
    'GET|/admin/menu/list' => MenuListController::class,
    'GET|/admin/menu/save' => MenuFormController::class,
    'POST|/admin/menu/save' => NewMenuController::class,
    'GET|/admin/menu/edit' => MenuFormController::class,
    'POST|/admin/menu/edit' => EditMenuController::class,
    'GET|/admin/menu/delete' => DeleteMenuController::class,
    // menu
    'GET|/admin/agenda/list' => AgendaListController::class,
    'GET|/admin/agenda/save' => AgendaFormController::class,
    'POST|/admin/agenda/save' => NewAgendaController::class,
    'GET|/admin/agenda/edit' => AgendaFormController::class,
    'POST|/admin/agenda/edit' => EditAgendaController::class,
    'GET|/admin/agenda/delete' => DeleteAgendaController::class,
    // agenda
    'GET|/admin/plano/save' => PlanoFormController::class,
    'POST|/admin/plano/save' => NewPlanoController::class,
    'GET|/admin/plano/edit' => PlanoFormController::class,
    'POST|/admin/plano/edit' => EditPlanoController::class,
    // plano
    'GET|/admin/report/save' => ReportFormController::class,
    'POST|/admin/report/save' => NewReportController::class,
    'GET|/admin/report/edit' => ReportFormController::class,
    'POST|/admin/report/edit' => EditReportController::class,
    'GET|/admin/report/list' => ReportListController::class,
    // report
    // -- parte do cliente:
    'GET|/client/agenda/list' => ClientAgendaListController::class,
    'GET|/client/agenda/save' => ClientAgendaFormController::class,
    'POST|/client/agenda/save' => ClientNewAgendaController::class,
    'GET|/client/agenda/edit' => ClientAgendaFormController::class,
    'POST|/client/agenda/edit' => ClientEditAgendaController::class,
    'GET|/client/agenda/delete' => ClientDeleteAgendaController::class,
    // agenda cliente
    'GET|/client/exercise/list' => ClientExerciseListController::class,
    // exercise cliente
    'GET|/client/menu/list' => ClientMenuListController::class,
    // menu cliente
    'GET|/login' => LoginFormController::class,
    'POST|/login' => LoginController::class,
    'GET|/logout' => LogoutController::class,
    'GET|/cadastro' => RegisterController::class,
    'POST|/cadastro' => NewUserController::class,
];
