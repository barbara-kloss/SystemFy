<?php

use Systemfy\App\Controller\{
    Error404Controller,
    Controller
};

use Systemfy\App\Repository\{
    AgendaRepository,
    ExerciseRepository,
    ReportRepository,
    UserRepository,
    PlanoRepository,
    MenuRepository
};
use Systemfy\App\ReportController;
use Systemfy\App\PlanoController;
use Systemfy\App\MenuController;
use Systemfy\App\ExerciseController;
use Systemfy\App\AgendaController;

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

    if ($controllerClass === AgendaController\NewAgendaController::class) {
        $controller = new $controllerClass($agendaRepository);
    
    }elseif ($controllerClass === ReportController\NewReportController::class) {
        $controller = new $controllerClass($reportRepository);
    
    }elseif ($controllerClass === ReportController\ReportFormController::class) {
        $controller = new $controllerClass($reportRepository);
    
    }elseif ($controllerClass === ReportController\ReportListController::class) {
        $controller = new $controllerClass($reportRepository);
    
    }elseif ($controllerClass === ReportController\DeleteReportController::class) {
        $controller = new $controllerClass($reportRepository);
    
    }elseif ($controllerClass === ReportController\EditReportController::class) {
        $controller = new $controllerClass($reportRepository);
    
    } elseif ($controllerClass === PlanoController\PlanoListController::class) {
        $controller = new $controllerClass($planoRepository);
    
    } elseif ($controllerClass === PlanoController\PlanoFormController::class) {
        $controller = new $controllerClass($planoRepository);
    
    } elseif ($controllerClass === PlanoController\DeletePlanoController::class) {
        $controller = new $controllerClass($planoRepository);
    
    } elseif ($controllerClass === PlanoController\EditPlanoController::class) {
        $controller = new $controllerClass($planoRepository);
    
    } elseif ($controllerClass === PlanoController\NewPlanoController::class) {
        $controller = new $controllerClass($planoRepository);
    
    } elseif ($controllerClass === MenuController\MenuListController::class) {
        $controller = new $controllerClass($menuRepository);
    
    } elseif ($controllerClass === MenuController\MenuFormController::class) {
        $controller = new $controllerClass($menuRepository);
    
    } elseif ($controllerClass === MenuController\DeleteMenuController::class) {
        $controller = new $controllerClass($menuRepository);
    
    } elseif ($controllerClass === MenuController\EditMenuController::class) {
        $controller = new $controllerClass($menuRepository);
    
    } elseif ($controllerClass === MenuController\NewMenuController::class) {
        $controller = new $controllerClass($menuRepository);
    
    } elseif ($controllerClass === ExerciseController\ExerciseFormController::class) {
        $controller = new $controllerClass($exerciseRepository);
    
    } elseif ($controllerClass === ExerciseController\ExerciseListController::class) {
        $controller = new $controllerClass($exerciseRepository);
    
    } elseif ($controllerClass === ExerciseController\DeleteExerciseController::class) {
        $controller = new $controllerClass($exerciseRepository);
    
    } elseif ($controllerClass === ExerciseController\NewExerciseController::class) {
        $controller = new $controllerClass($exerciseRepository);
    
    } elseif ($controllerClass === ExerciseController\EditExerciseController::class) {
        $controller = new $controllerClass($exerciseRepository);
    
    } elseif ($controllerClass === Systemfy\App\Controller\ControllerLogin\NewUserController::class) {
        $controller = new $controllerClass($userRepository);
    
    } else {
        $controller = new $controllerClass($agendaRepository);
    }
} else {
    $controller = new Error404Controller();
}

/** @var Controller $controller*/
$controller->processaRequisicao();
