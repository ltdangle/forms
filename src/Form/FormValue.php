<?php declare(strict_types=1);

namespace Sodalto\Forms\Form;

use Sodalto\Forms\Form\ValueObjectInterface;

/**
 * Form value object.
 */
class FormValue
{
    private ValueObjectInterface $valueObject;
    private $dirtyValue = '';
    private bool $ready = false;
    private string $valueObjectClass;
    private string $error = '';

    public function getValueObject(): ValueObjectInterface
    {
        return $this->valueObject;
    }

    public function setValueObject(ValueObjectInterface $value): void
    {
        $this->valueObject = $value;
    }

    public function getDirtyValue()
    {
        return $this->dirtyValue;
    }

    public function setDirtyValue($dirtyValue): void
    {
        $this->dirtyValue = $dirtyValue;
    }

    public function isReady(): bool
    {
        return $this->ready;
    }

    public function setReady(bool $ready): void
    {
        $this->ready = $ready;
    }

    public function getValueObjectClass(): string
    {
        return $this->valueObjectClass;
    }


    public function setValueObjectClass(string $valueObjectClass): void
    {
        $this->valueObjectClass = $valueObjectClass;
    }


    public function getError(): string
    {
        return $this->error;
    }

    public function setError(string $error): void
    {
        $this->error = $error;
    }
}