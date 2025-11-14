<?php

use Systemfy\App\AgendaController;
use Systemfy\App\Controller\{Controller, Error404Controller};
use Systemfy\App\ExerciseController;
use Systemfy\App\MenuController;
use Systemfy\App\PlanoController;
use Systemfy\App\ReportController;
use Systemfy\App\Repository\{AgendaRepository,
    ExerciseRepository,
    MenuRepository,
    PlanoRepository,
    ReportRepository,
    UserRepository};

require_once __DIR__ . '/../vendor/autoload.php';

$caminho = __DIR__ . '/../../../databaselocal';
$pdo = new \PDO("mysql:$caminho");


$userRepository = new UserRepository($pdo);
$reportRepository = new ReportRepository($pdo);
$planoRepository = new PlanoRepository($pdo);
$menuRepository = new MenuRepository($pdo);
$exerciseRepository = new ExerciseRepository($pdo);
$agendaRepository = new AgendaRepository($pdo);

$routes = require __DIR__ . '/../config/routes.php';

$pathInfo = $_SERVER['PATH_INFO'] ?? '/';
$httpMethod = $_SERVER['REQUEST_METHOD'];

session_start();

$isLoginRoute = $pathInfo === '/login';
if (!array_key_exists('logado', $_SESSION) && !$isLoginRoute && $pathInfo !== '/cadastro') {
    header('Location: /login');
    return;
}

$key = "$httpMethod|$pathInfo";

if (array_key_exists($key, $routes)) {
    $controllerClass = $routes[$key];

    //Elseif para não haver colisão de rotas e tatefas

    if ($controllerClass === \Systemfy\App\Admin\AgendaController\NewAgendaController::class) {
        $controller = new $controllerClass($agendaRepository);
    
    }elseif ($controllerClass === \Systemfy\App\Admin\ReportController\NewReportController::class) {
        $controller = new $controllerClass($reportRepository);
    
    }elseif ($controllerClass === \Systemfy\App\Admin\ReportController\ReportFormController::class) {
        $controller = new $controllerClass($reportRepository);
    
    }elseif ($controllerClass === \Systemfy\App\Admin\ReportController\ReportListController::class) {
        $controller = new $controllerClass($reportRepository);
    
    }elseif ($controllerClass === ReportController\DeleteReportController::class) {
        $controller = new $controllerClass($reportRepository);
    
    }elseif ($controllerClass === \Systemfy\App\Admin\ReportController\EditReportController::class) {
        $controller = new $controllerClass($reportRepository);
    
    } elseif ($controllerClass === PlanoController\PlanoListController::class) {
        $controller = new $controllerClass($planoRepository);
    
    } elseif ($controllerClass === \Systemfy\App\Admin\PlanoController\PlanoFormController::class) {
        $controller = new $controllerClass($planoRepository);
    
    } elseif ($controllerClass === PlanoController\DeletePlanoController::class) {
        $controller = new $controllerClass($planoRepository);
    
    } elseif ($controllerClass === \Systemfy\App\Admin\PlanoController\EditPlanoController::class) {
        $controller = new $controllerClass($planoRepository);
    
    } elseif ($controllerClass === \Systemfy\App\Admin\PlanoController\NewPlanoController::class) {
        $controller = new $controllerClass($planoRepository);
    
    } elseif ($controllerClass === \Systemfy\App\Admin\MenuController\MenuListController::class) {
        $controller = new $controllerClass($menuRepository);
    
    } elseif ($controllerClass === \Systemfy\App\Admin\MenuController\MenuFormController::class) {
        $controller = new $controllerClass($menuRepository);
    
    } elseif ($controllerClass === \Systemfy\App\Admin\MenuController\DeleteMenuController::class) {
        $controller = new $controllerClass($menuRepository);
    
    } elseif ($controllerClass === \Systemfy\App\Admin\MenuController\EditMenuController::class) {
        $controller = new $controllerClass($menuRepository);
    
    } elseif ($controllerClass === \Systemfy\App\Admin\MenuController\NewMenuController::class) {
        $controller = new $controllerClass($menuRepository);
    
    } elseif ($controllerClass === \Systemfy\App\Admin\ExerciseController\ExerciseFormController::class) {
        $controller = new $controllerClass($exerciseRepository);
    
    } elseif ($controllerClass === \Systemfy\App\Admin\ExerciseController\ExerciseListController::class) {
        $controller = new $controllerClass($exerciseRepository);
    
    } elseif ($controllerClass === \Systemfy\App\Admin\ExerciseController\DeleteExerciseController::class) {
        $controller = new $controllerClass($exerciseRepository);
    
    } elseif ($controllerClass === \Systemfy\App\Admin\ExerciseController\NewExerciseController::class) {
        $controller = new $controllerClass($exerciseRepository);
    
    } elseif ($controllerClass === \Systemfy\App\Admin\ExerciseController\EditExerciseController::class) {
        $controller = new $controllerClass($exerciseRepository);
    
    } elseif ($controllerClass === \Systemfy\App\ControllerLogin\NewUserController::class) {
        $controller = new $controllerClass($userRepository);
    
    } else {
        $controller = new $controllerClass($agendaRepository);
    }
} else {
    $controller = new Error404Controller();
}

/** @var Controller $controller*/
$controller->processaRequisicao();
