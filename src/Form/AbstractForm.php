<?php declare(strict_types=1);

namespace Sodalto\Forms\Form;

abstract class AbstractForm
{
    /**
     * Submit url for the form.
     */
    protected string $submitUrl = '';

    /**
     * Array of FormValue objects.
     * @var FormValue[];
     */
    protected array $validateValues;

    public function __construct()
    {
        $this->_configureFormValues();
    }

    /**
     * Validates form.
     */
    protected function _validate(): bool
    {
        $isValid = true;
        foreach ($this->validateValues as $formValue) {
            try {
                $valueObjectClass = $formValue->getValueObjectClass();
                $valueObject = new $valueObjectClass($formValue->getDirtyValue());
            } catch (\InvalidArgumentException $e) {
                $isValid = false;
                $formValue->setError($e->getMessage());
                continue;
            }
            $formValue->setValueObject($valueObject);
        }
        return $isValid;
    }

    /**
     * Helper method to protect against xss.
     */
    protected function xss(string $html): string
    {
        return htmlspecialchars($html, ENT_QUOTES, 'UTF-8');
    }

    /**
     * Configures $formValues array.
     */
    abstract protected function _configureFormValues();


    public function isValid(): bool
    {
        return $this->_validate();
    }

    public function setSubmitUrl(string $submitUrl): void
    {
        $this->submitUrl = $submitUrl;
    }

    /**
     * Returns form's HTML.
     */
    abstract public function getHtml(): string;
}