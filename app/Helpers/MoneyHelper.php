<?php

namespace App\Helpers;

class MoneyHelper
{
    public static function convert(?string $amount): string
    {
        return '$ ' . ($amount ? number_format($amount, 2) : '0');
    }
}
