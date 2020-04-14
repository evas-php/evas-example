<?php
/**
 * Пример роутинга.
 * @author Egor Vasyakin <e.vasyakin@itevas.ru>
 * @since 13 Apr 2020
 */
use base\App;
use Evas\Router\Router;
use Evas\Web\Controller;
use controllers\AuthController;
use controllers\UserController;

$result = (new Router)
    ->controllerClass(Controller::class)
    ->default('404.php')
    ->aliases([
        ':id' => '(:int)',
    ])
    ->get('/user/:id', [UserController::class => 'show'])
    ->get('/cabinet(:any)', 'cabinet.php')
    ->get('/js/build.js', function () {
        $this->response->withHeader('Content-Type', 'text/javascript')->applyHeaders();
        $this->render('cabinet-vue/dist/build.js');
    })
    ->map('/api')
        ->middleware(function () {
            if ('POST' !== $this->request->getMethod() 
            || 'application/json' !== $this->request->getHeader('Content-Type')
            || !App::hasApiUser()) {
                $this->render('404.php');
                return false;
            }
        })
        ->next()
    ->autoByFile('/')
        ->filePostfix('.php')
        ->next()
    ->routingByRequest(App::request())
    ->handle();
