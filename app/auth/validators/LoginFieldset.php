<?php
namespace auth\validators;

use auth\validators\EmailField;
use auth\validators\PasswordField;
use base\Fieldset;

/**
 * Валидатор набора полей входа.
 */
class LoginFieldset extends Fieldset
{
    /**
     * Переопределяем конструктор.
     * @param array валидаторы полей или правила
     */
    public function __construct(array $fields = null)
    {
        $fields = array_merge([
            'email' => new EmailField,
            'password' => new PasswordField,
        ], $fields ?? []);
        parent::__construct($fields);
    }
}
