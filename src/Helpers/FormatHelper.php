<?php

namespace LaraToolkit\Helpers;

use Illuminate\Http\JsonResponse;

class FormatHelper
{
    public static function dateToBr(string $date): string
    {
        return date('d/m/Y', strtotime($date));
    }

    public static function dateToMysql(string $date): string
    {
        return date('Y-m-d', strtotime($date));
    }

    public static function datetimeToBr(string $date): string
    {
        return date('d/m/Y H:i:s', strtotime($date));
    }

    public static function datetimeToMysql(string $date)
    {
        return date('Y-m-d H:i:s', strtotime($date));
    }

    public static function floatToBr(float $value): string
    {
        return number_format($value, 2, ',', '.');
    }

    public static function cpf(string $cpf): string
    {
        return substr($cpf, 0, 3) . '.' . substr($cpf, 3, 3) . '.' . substr($cpf, 6, 3) . '-' . substr($cpf, 9, 2);
    }

    public static function cnpj(string $cnpj): string
    {
        return substr($cnpj, 0, 2) . '.' . substr($cnpj, 2, 3) . '.' . substr($cnpj, 5, 3) . '/' . substr($cnpj, 8, 4) . '-' . substr($cnpj, 12, 2);
    }

    public static function phone(string $phone): string
    {
        return '(' . substr($phone, 0, 2) . ') ' . substr($phone, 2, 4) . '-' . substr($phone, 6, 4);
    }

    public static function cep(string $cep): string
    {
        return substr($cep, 0, 5) . '-' . substr($cep, 5, 3);
    }
}