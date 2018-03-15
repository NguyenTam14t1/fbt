<?php

namespace App\Repositories\Contracts;

interface NewsInterface
{
    public function getRandomNews($limit = 0);
}
