<?php
namespace base;

use base\App;

/**
 * Базовый абстрактный класс модели.
 */
abstract class Model
{
    /**
     * Базовые поля записи.
     * @var int(10) UNSIGNED PRIMARY id записи
     * @var datetime время создания
     */
    public $id;
    public $create_time;

    /**
     * Получение соединения с базой данных.
     * @return Database
     */
    public static function getDb()
    {
        return App::db();
    }
}
