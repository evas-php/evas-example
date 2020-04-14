<?php
namespace base;

use Evas\Web\App as WebApp;
use Evas\Orm\Integrate\AppDbTrait;
// use Evas\Orm\Integrate\AppDbsTrait; // для поддержки нескольких соединений с базой
use Evas\Web\Storage\AppWebStorageTrait;

/**
 * Класс приложения.
 * @author Egor Vasyakin <e.vasyakin@itevas.ru>
 * @since 13 Apr 2020
 */
class App extends WebApp
{
    /**
     * Подключаем расширение соединения с одной базой данных.
     * Подключаем расширение cookie и session.
     */
    use AppDbTrait; 
    use AppWebStorageTrait;

    /**
     * Получение авторизованного пользователя.
     * @return User
     */
    public static function authUser(): ?object
    {
        static $user = false;
        if (false === $user) {
            $token = static::cookie()->get('token');
            $user = User::findByToken($token);
        }
        return $user;
    }
}
