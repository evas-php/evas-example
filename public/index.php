<?php
/**
 * @package evas-php/evas-example
 * @author Egor Vasyakin <e.vasyakin@itevas.ru>
 * @since 13 Apr 2020
 */
use base\App;
use Evas\Loader\Loader;

// вывод ошибок
ini_set('display_errors', 1);
error_reporting(E_ALL);

// константы
define('APP_DIR', dirname(__DIR__) . '/');
define('DEBUG', true);

// автозагрузка
require APP_DIR . 'vendor/evas-php/evas-loader/src/Loader.php';
$loader = (new Loader(APP_DIR))->useEvas()->dir('app/')->run();
App::dir(APP_DIR);

// роутинг
require APP_DIR . '/config/routing.php';
