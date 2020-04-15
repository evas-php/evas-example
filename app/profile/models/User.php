<?php
namespace profile\models;

use base\Model;

/**
 * Модель пользователя.
 */
class User extends Model
{
    /**
     * @var string имя таблицы
     */
    public static $tableName = 'users';

    /**
     * Поля записи.
     * @var varchar(60) имя
     * @var varchar(60) фамилия
     * @var char(60) UNIQUE email
     * @var varchar(60) хэш пароля
     */
    public $first_name;
    public $last_name;
    public $email;
    public $hash;

    /**
     * Поиск пользователя по email.
     * @param string email
     * @return static|null
     */
    public static function findByEmail(string $email): ?object
    {
        return static::find()->where('email = ?', [$email])->one()->classObject(static::class);
    }
}
