<?php declare(strict_types=1);

namespace Sodalto\Tests\ValueObjects;

use Sodalto\Forms\Form\ValueObjectInterface;

class ContactMessage implements ValueObjectInterface
{
    private string $message;

    public function __construct(string $message)
    {
        if (strlen($message) == 0) {
            throw new \InvalidArgumentException('Message cannot be empty.');
        }

        if (strlen($message) < 10) {
            throw new \InvalidArgumentException('Message is too small.');
        }

        if (strlen($message) > 255) {
            throw new \InvalidArgumentException('Message is too large.');
        }

        $this->message = $message;
    }

    public function getValue()
    {
        return $this->message;
    }
}