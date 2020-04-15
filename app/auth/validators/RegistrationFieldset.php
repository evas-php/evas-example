<?php
namespace auth\validators;

use auth\validators\LoginFieldset;

/**
 * Валидатор набора полей регистрации.
 */
class RegistrationFieldset extends LoginFieldset
{
    /**
     * Переопределяем конструктор.
     * @param array валидаторы полей или правила
     */
    public function __construct(array $fields = null)
    {
        $fields = array_merge([
            'password_repeat' => [
                'label' => 'Повтор пароля', 
                'same' => 'password', 'sameLabel' => 'Пароль'
            ],
            'first_name' => ['min' => 2, 'max' => 60],
            'last_name' => ['min' => 2, 'max' => 60],
        ], $fields);
        parent::__construct($fields);
    }
}
