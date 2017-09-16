<?php

namespace App\Validators\Combine;


use Respect\Validation\Validator as v;

class CombineValidator
{

    private $errors = [];
    private $inputData;

    public function setInput(array $input)
    {
        $this->inputData = $input;
        return $this;
    }

    public function validate(): bool
    {
        /**
         * TODO validate 'sum', 'algo', 'source'
         */
        return true;
    }

    public function getErrors()
    {
        return $this->errors;
    }
}