<?php

namespace App\Contracts;

interface FileGenerator
{
    public function generate(array $data, array $options): string;
}
