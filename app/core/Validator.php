<?php

class Validator
{
    private array $errors = [];

    public function required(
        string $field,
        mixed $value,
        string $label
    ): self {

        if (
            $value === null ||
            trim((string) $value) === ''
        ) {
            $this->errors[$field] =
                "{$label} is required.";
        }

        return $this;
    }

    public function email(
        string $field,
        mixed $value,
        string $label = 'Email'
    ): self {

        if (
            $value !== null &&
            $value !== '' &&
            !filter_var(
                $value,
                FILTER_VALIDATE_EMAIL
            )
        ) {
            $this->errors[$field] =
                "{$label} must be a valid email.";
        }

        return $this;
    }

    public function minLength(
        string $field,
        string $value,
        int $length,
        string $label
    ): self {

        if (strlen($value) < $length) {
            $this->errors[$field] =
                "{$label} must contain at least {$length} characters.";
        }

        return $this;
    }

    public function same(
        string $field,
        mixed $value,
        mixed $other,
        string $message
    ): self {

        if ($value !== $other) {
            $this->errors[$field] = $message;
        }

        return $this;
    }

    public function fails(): bool
    {
        return !empty($this->errors);
    }

    public function errors(): array
    {
        return $this->errors;
    }
}