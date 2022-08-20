<?php

namespace Vollborn\LaravelRequestCast\Classes;

use Illuminate\Foundation\Http\FormRequest;
use Vollborn\LaravelRequestCast\Traits\Casts;

class CastedRequest extends FormRequest
{
    use Casts;
}
