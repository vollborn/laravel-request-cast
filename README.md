# Laravel Request Cast

Laravel Request Cast is a small package to cast Laravels request values into their supposed types.
 
For example:
If you build an API and validate a request parameter as int, the value attached to the request object can still be a string.
It only validates the content, but does not change its data type.

This JSON body would result as a string in your controller, because it is a string in the request itself too:
```json
{
    "integer": "1251"
}
```

This package aims to fix this inconvenience. The same request will result as an int in your controller, if used correctly.

## Installation

This package is available at composer.
To install it, run:
```
composer require vollborn/laravel-request-cast
```

## Usage

There are two ways of using this package.
<br />You can either...

1. Use it as an extended class
2. or as a trait if you need to extend something else.

Both will work the same way, just a different writing style.

### Using a parent class

This is Laravels default request.
```php
use Illuminate\Foundation\Http\FormRequest;

class TestRequest extends FormRequest
{
    ...
```

We change the extended class, and should be up and running!
```php
use Vollborn\LaravelRequestCast\Classes\CastedRequest;

class TestRequest extends CastedRequest
{
    ...
```

### Using a trait

Simply add the "Casts" trait to your request.
<br />That should be it.

```php
use Illuminate\Foundation\Http\FormRequest;
use Vollborn\LaravelRequestCast\Traits\Casts;

class TestRequest extends FormRequest
{
    use Casts;
    ...
```

### Casting values

Casting values is pretty easy. You just need to add the "casts" function to your request, just like the "rules" function:
```php
<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Vollborn\LaravelRequestCast\Traits\Casts;

class TestRequest extends FormRequest
{
    use Casts;

    /**
     * @return array
     */
    public function casts(): array
    {
        return [
            'test' => CastTypes::BOOLEAN
        ];
    }

    ...
}
```
This request would cast the "test" parameter to a boolean.

Following cast types are available:
```php
# Strings
CastTypes::STRING

# Booleans
CastTypes::BOOLEAN
CastTypes::BOOL

# Integers
CastTypes::INTEGER
CastTypes::INT

# Arrays
CastTypes::ARRAY
```

**Please note:**
<br />Casted values can be null. For example: if you cast to a boolean, the value can be *true*, *false* OR *null*.
<br />This is supposed to be like that. If the value is null, your validation / rules will check if it is valid or not.


## Examples

Here are some example requests using casts. Feel free to copy and try it out!

### Using a parent class

```php
<?php

namespace App\Http\Requests;

use Vollborn\LaravelRequestCast\Classes\CastedRequest;
use Vollborn\LaravelRequestCast\Classes\CastTypes;

class TestRequest extends CastedRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array
     */
    public function casts(): array
    {
        return [
            'test' => CastTypes::BOOLEAN
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'test' => 'nullable|boolean'
        ];
    }
}
```

### Using a trait

```php
<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Vollborn\LaravelRequestCast\Classes\CastTypes;
use Vollborn\LaravelRequestCast\Traits\Casts;

class TestRequest extends FormRequest
{
    use Casts;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array
     */
    public function casts(): array
    {
        return [
            'test' => CastTypes::BOOLEAN
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'test' => 'nullable|boolean'
        ];
    }
}
```
