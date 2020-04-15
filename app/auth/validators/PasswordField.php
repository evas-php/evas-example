<?php
namespace auth\validators;

use base\Field;

/**
 * Валидтор поля пароль.
 */
class PasswordField extends Field
{
    public $label = 'Пароль';
    public $min = 6;
    public $max = 30;
}
