<?php declare(strict_types=1);

namespace Sodalto\Tests\ValueObjects;

use Sodalto\Forms\Form\ValueObjectInterface;

class Name implements ValueObjectInterface
{
    private string $name;

    public function __construct(string $name)
    {
        if (strlen($name) == 0) {
            throw new \InvalidArgumentException('Name cannot be empty.');
        }

        if (strlen($name) > 100) {
            throw new \InvalidArgumentException('Name is too big.');
        }

        $this->name = $name;
    }

    public function getValue()
    {
        return $this->name;
    }
}