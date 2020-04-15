<?php
namespace auth\validators;

use base\Field;

/**
 * Валидтор поля email.
 */
class EmailField extends Field
{
    public $min = 8;
    public $max = 60;
    public $pattern = '/^.{1,}@.{1,}\..{1,16}$/';
}
