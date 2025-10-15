<?php

namespace App\Domain;

use App\Contracts\ProductValidator;

class SimpleProductValidator implements ProductValidator
{
    public function validate(array $input): array
    {
        $errors = [];

        if (!isset($input['name']) || strlen(trim($input['name'])) < 2 || strlen($input['name']) > 100) {
            $errors[] = "Nome inválido (precisa ter entre 2 e 100 caracteres).";
        }

        if (!isset($input['price']) || !is_numeric($input['price']) || $input['price'] < 0) {
            $errors[] = "Preço inválido (precisa ser numérico e >= 0).";
        }

        return [empty($errors), $errors];
    }
}
