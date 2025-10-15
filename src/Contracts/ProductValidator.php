<?php

namespace App\Contracts;

interface ProductValidator
{
    /**
     * @param array $input
     * @return array [bool valid, array errors]
     */
    public function validate(array $input): array;
}
