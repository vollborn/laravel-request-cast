<?php

namespace Vollborn\LaravelRequestCast\Classes;

use Illuminate\Foundation\Http\FormRequest;

class CastTypes extends FormRequest
{
    public const INT = 'int';
    public const STRING = 'string';
    public const ARRAY = 'array';
    public const BOOL = 'boolean';

    public const BOOLEAN = self::BOOL;
    public const INTEGER = self::INT;
}
