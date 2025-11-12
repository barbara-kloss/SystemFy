<?php


use SceneReads\Mvc\Controller\{
    MainController,
    AboutController
};

use SceneReads\Mvc\ControllerBook\{
    BookListController,
    BookFormController,
    NewBookController,
    EditBookController,
    DeleteBookController
};

use SceneReads\Mvc\ControllerFilm\{
    FilmListController,
    FilmFormController,
    EditFilmController,
    DeleteFilmController,
    NewFilmController
};

use \SceneReads\Mvc\ControllerTable\{
    TableListController,
    TableFormController,
    NewTableController,
    EditTableController,
    DeleteTableController
};

use \SceneReads\Mvc\ControllerLogin\{
    LoginFormController,
    LoginController,
    LogoutController,
    RegisterController,
    NewUserController
};

return [
    'GET|/' => MainController::class,
    'GET|/about' => AboutController::class,
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