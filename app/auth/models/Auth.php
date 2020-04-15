<?php
namespace auth\models;

use base\App;
use base\Model;

/**
 * Модель авторизации.
 */
class Auth extends Model
{
    /**
     * @static string имя токена авторизации в cookie
     */
    const AUTH_TOKEN_COOKIE_NAME = 'token';

    /**
     * @static int время жизни токена авторизации в секундах.
     */
    const AUTH_TOKEN_ALIVE = 2592000;

    /**
     * @var string имя таблицы
     */
    public static $tableName = 'auths';

    /**
     * Поля записи.
     * @var int(10) UNSIGNED INDEX id пользователя
     * @var char(60) токен
     * @var varchar(15) ip пользователя
     * @var varchar(250) браузер пользователя
     * @var datetime время окончания авторизации
     */
    public $user_id;
    public $token;
    public $user_ip;
    public $user_agent;
    public $end_time;

    /**
     * Получение авторизованного пользователя по токену.
     * @param string token
     * @return User|null
     */
    public static function findUserByToken(string $token): ?object
    {
        $usersTbl = User::tableName();
        $authsTbl = static::tableName();
        return static::find("`$usersTbl`.*")
            ->join("`$usersTbl`")
            ->on("`$usersTbl`.id = `$authsTbl`.user_id")
            ->where("`authsTbl`.token = ?", [$token])
            ->one()
            ->classObject(User::class);
    }

    /**
     * Запуск авторизации: создание записи авторизации и запись токена в cookie.
     * @param int id пользователя
     * @return static
     */
    public static function make(int $user_id): object
    {
        $user_ip = App::request()->getUserIp();
        $user_agent = App::request()->getHeader('User-Agent');
        $end_time = date('Y-m-d h:i:s', time() + static::AUTH_TOKEN_ALIVE);

        $auth = static::find()
            ->where('user_id = ? AND user_ip = ? AND user_agent = ?', [$user_id, $user_ip, $user_agent])
            ->one()->classObject(static::class);

        if ($auth) {
            $auth->end_time = $end_time;
            return $auth->save();
        }
        $token = strtotime(date('Y-m-d H:i:s') + rand(0, 9));
        App::cookie()
            ->withHost(App::host())
            ->set(static::AUTH_TOKEN_COOKIE_NAME, $auth->token, static::AUTH_TOKEN_ALIVE);
        return static::insert(compact('user_id', 'token', 'user_ip', 'user_agent', 'end_time'));
    }
}
