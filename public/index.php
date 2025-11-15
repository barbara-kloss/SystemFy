<?php

use Systemfy\App\Controller\{Controller, Error404Controller};
use Systemfy\App\Repository\{
    AgendaRepository,
    ExerciseRepository,
    MenuRepository,
    PlanoRepository,
    ReportRepository,
    UserRepository
};

require_once __DIR__ . '/../vendor/autoload.php';

// Conexão
$caminho = __DIR__ . '/../../../databaselocal';
$pdo = new \PDO("mysql:$caminho");

// Repositories
$userRepository = new UserRepository($pdo);
$reportRepository = new ReportRepository($pdo);
$planoRepository = new PlanoRepository($pdo);
$menuRepository = new MenuRepository($pdo);
$exerciseRepository = new ExerciseRepository($pdo);
$agendaRepository = new AgendaRepository($pdo);

// Rotas
$routes = require __DIR__ . '/../config/routes.php';

$pathInfo = $_SERVER['REQUEST_URI'] ?? '/';
$pathInfo = strtok($pathInfo, '?');
$httpMethod = $_SERVER['REQUEST_METHOD'];

session_start();

// Proteção de rotas
$isLoginRoute = $pathInfo === '/login';
if (!array_key_exists('logado', $_SESSION) && !$isLoginRoute && $pathInfo !== '/cadastro') {
    header('Location: /login');
    return;
}

$key = "$httpMethod|$pathInfo";

// --------------------------------------------
//  VERIFICA SE ROTA EXISTE
// --------------------------------------------

if (array_key_exists($key, $routes)) {

    $controllerClass = $routes[$key];

    // --------------------------------------------
    //  BLOCO ADMIN
    // --------------------------------------------

    if ($controllerClass === \Systemfy\App\Admin\AgendaController\NewAgendaController::class) {
        $controller = new $controllerClass($agendaRepository);

    } elseif (

         $controllerClass === \Systemfy\App\Admin\ReportController\ReportListController::class
    ) {
        $controller = new $controllerClass($reportRepository);

    } elseif (
        $controllerClass === \Systemfy\App\Admin\PlanoController\PlanoFormController::class
        || $controllerClass === \Systemfy\App\Admin\PlanoController\EditPlanoController::class
        || $controllerClass === \Systemfy\App\Admin\PlanoController\NewPlanoController::class
    ) {
        $controller = new $controllerClass($planoRepository);

    } elseif (
        $controllerClass === \Systemfy\App\Admin\MenuController\MenuListController::class
        || $controllerClass === \Systemfy\App\Admin\MenuController\MenuFormController::class
        || $controllerClass === \Systemfy\App\Admin\MenuController\DeleteMenuController::class
        || $controllerClass === \Systemfy\App\Admin\MenuController\EditMenuController::class
        || $controllerClass === \Systemfy\App\Admin\MenuController\NewMenuController::class
    ) {
        $controller = new $controllerClass($menuRepository);

    } elseif (
        $controllerClass === \Systemfy\App\Admin\ExerciseController\ExerciseFormController::class
        || $controllerClass === \Systemfy\App\Admin\ExerciseController\ExerciseListController::class
        || $controllerClass === \Systemfy\App\Admin\ExerciseController\DeleteExerciseController::class
        || $controllerClass === \Systemfy\App\Admin\ExerciseController\NewExerciseController::class
        || $controllerClass === \Systemfy\App\Admin\ExerciseController\EditExerciseController::class
    ) {
        $controller = new $controllerClass($exerciseRepository);

    } elseif ($controllerClass === \Systemfy\App\ControllerLogin\NewUserController::class) {
        $controller = new $controllerClass($userRepository);

        // --------------------------------------------
        //  BLOCO CLIENTE – AGENDA
        // --------------------------------------------

    } elseif (
        $controllerClass === \Systemfy\App\Client\ClientAgendaController\ClientAgendaListController::class
        || $controllerClass === \Systemfy\App\Client\ClientAgendaController\ClientAgendaFormController::class
        || $controllerClass === \Systemfy\App\Client\ClientAgendaController\ClientNewAgendaController::class
        || $controllerClass === \Systemfy\App\Client\ClientAgendaController\ClientEditAgendaController::class
        || $controllerClass === \Systemfy\App\Client\ClientAgendaController\ClientDeleteAgendaController::class
    ) {
        $controller = new $controllerClass($agendaRepository);

        // --------------------------------------------
        //  CLIENTE – EXERCISE
        // --------------------------------------------

    } elseif ($controllerClass === \Systemfy\App\Client\ClientExerciseController\ClientExerciseListController::class) {
        $controller = new $controllerClass($exerciseRepository);

        // --------------------------------------------
        //  CLIENTE – MENU
        // --------------------------------------------

    } elseif ($controllerClass === \Systemfy\App\Client\ClientMenuController\ClientMenuListController::class) {
        $controller = new $controllerClass($menuRepository);

        // --------------------------------------------
        //  OUTROS CONTROLLERS
        // --------------------------------------------

    } else {
        $controller = new $controllerClass($agendaRepository);
    }

} else {
    $controller = new Error404Controller();
}

// Executa controller
/** @var Controller $controller */
$controller->processaRequisicao();
