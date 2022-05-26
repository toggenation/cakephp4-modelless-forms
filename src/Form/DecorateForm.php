<?php

declare(strict_types=1);

namespace App\Form;

use Exception;


class DecorateForm
{
    public $validator;

    public function __construct($wrapped, $formName = null)
    {
        $this->wrapped = $wrapped;

        $this->form = $formName;
    }

    public function __call($name, $values)
    {
        if (method_exists($this->wrapped, $name)) {
            $field = $this->wrap($values[0]);

            $args = array_slice($values, 1);

            $this->wrapped->$name($field, ...$args);

            return $this;
        }

        throw new Exception("Missing method called in DecorateForm {$name}");
    }

    public function wrap($field)
    {
        if (!empty($this->form)) {
            return $this->form . '-' . $field;
        }

        return $field;
    }
}