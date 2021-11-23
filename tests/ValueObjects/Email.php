<?php declare(strict_types=1);

namespace Sodalto\Tests\ValueObjects;

use Sodalto\Forms\Form\ValueObjectInterface;

class Email implements \Sodalto\Forms\Form\ValueObjectInterface
{
    private string $email;

    public function __construct(string $email)
    {
        if (strlen($email) == 0) {
            throw new \InvalidArgumentException('Email cannot be empty.');
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException("Email address is invalid.");
        }
        $this->email = $email;
    }

    public function getValue()
    {
        return $this->email;
    }
}