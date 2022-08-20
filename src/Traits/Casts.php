<?php

namespace Vollborn\LaravelRequestCast\Traits;

use Vollborn\LaravelRequestCast\Classes\CastTypes;
use function gettype;

trait Casts
{
    protected function prepareForValidation(): void
    {
        $this->castValues();
    }

    /**
     * @return array
     */
    protected function casts(): array
    {
        return [];
    }

    protected function castValues(): void
    {
        $casts = $this->casts();

        foreach ($casts as $key => $value) {
            $this->addKey($key);

            $this->$key = match ($value) {
                CastTypes::ARRAY => $this->castToArray($value),
                CastTypes::BOOLEAN => $this->castToBoolean($value),
                CastTypes::INTEGER => $this->castToInt($value),
                default => $this->castToString($value),
            };
        }
    }

    /**
     * @param string $key
     * @return void
     */
    protected function addKey(string $key): void
    {
        if (!isset($this->$key)) {
            $this->$key = null;
        }
    }

    /**
     * @param string $value
     * @return array|null
     */
    protected function castToArray(mixed $value): ?array
    {
        if ($value !== null) {
            return (array) $value;
        }

        return null;
    }

    /**
     * @param mixed $value
     * @return int|null
     */
    protected function castToInt(mixed $value): ?int
    {
        if ($value !== null) {
            return (int) $value;
        }

        return null;
    }

    /**
     * @param mixed $value
     * @return bool|null
     */
    protected function castToBoolean(mixed $value): ?bool
    {
        if ($value !== null) {
            return (bool) $value;
        }

        return null;
    }

    /**
     * @param mixed $value
     * @return string|null
     */
    protected function castToString(mixed $value): ?string
    {
        // prevent array to string conversion
        if (gettype($value) === "array") {
            return null;
        }

        if ($value !== null) {
            return (string) $value;
        }

        return null;
    }
}
