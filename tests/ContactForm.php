<?php declare(strict_types=1);

namespace Sodalto\Tests;

use Sodalto\Forms\Form\AbstractForm;
use Sodalto\Forms\Form\FormValue;
use Sodalto\Tests\ValueObjects\ContactMessage;
use Sodalto\Tests\ValueObjects\Email;
use Sodalto\Tests\ValueObjects\Name;

class ContactForm extends AbstractForm
{

    /**
     * Form greeting message.
     */
    private string $greeting='';

    public FormValue $name;
    public FormValue $email;
    public FormValue $message;

    public function setGreeting(string $greeting): void
    {
        $this->greeting = $greeting;
    }

    /**
     * @inheritdoc
     */
    protected function _configureFormValues()
    {
        $this->name = new FormValue();
        $this->name->setValueObjectClass(Name::class);
        $this->validateValues[] = $this->name;

        $this->email = new FormValue();
        $this->email->setValueObjectClass(Email::class);
        $this->validateValues[] = $this->email;

        $this->message = new FormValue();
        $this->message->setValueObjectClass(ContactMessage::class);
        $this->validateValues[] = $this->message;
    }

    public function setValues( $name,  $email,  $message)
    {
        $this->name->setDirtyValue($name);
        $this->email->setDirtyValue($email);
        $this->message->setDirtyValue($message);
    }

    /**
     * @inheritdoc
     */
    public function getHtml(): string
    {
        return <<<HTML
            <form 
                action="{$this->submitUrl}" 
                class="my-20 p-10 max-w-xl mx-auto shadow-md sm:border-0 md:border md:border-gray-900 md:dark:border-gray-100 bg-gray-100 dark:bg-gray-800 text-gray-900 dark:text-gray-100"
                method="post"
                >
            <div class="mb-10">
                <h1 class="font-bold text-4xl mb-3">Get in touch</h1>
                <p class="font-medium text-lg mb-5 contact-form-message">{$this->xss($this->greeting)}</p>
                <hr class="border-gray-900 dark:border-gray-100">
            </div>
            
            <div class="mb-5">
                <label for="message" class="text-lg flex justify-between items-end">
                    <span>Message</span>
                    <span class="text-xs text-red-500 ">{$this->message->getError()}</span>
                </label>
                <textarea name="message" id="message" cols="30" rows="10" class="shadow-md mt-1 block w-full sm:text-sm rounded-none border-gray-900 dark:border-gray-100 bg-white dark:bg-gray-900">{$this->xss($this->message->getDirtyValue())}</textarea>
            </div>
            
            <div class="mb-5">
                <label for="name" class="text-lg flex justify-between items-end">
                    <span>Name</span>
                    <span class="text-xs text-red-500 ">{$this->name->getError()}</span>
                </label>
                <div class="mt-1 flex shadow-md">
                    <span class="inline-flex items-center px-3 rounded-none border border-r-0 border-gray-900 dark:border-gray-100"><i class="fas fa-user"></i></span>
                    <input 
                        type="text" 
                        name="name" 
                        class="flex-1 block w-full sm:text-sm rounded-none border border-gray-900 dark:border-gray-100 bg-white dark:bg-gray-900" 
                        value="{$this->xss($this->name->getDirtyValue())}"
                    />
                </div>
            </div>
            <div class="mb-5">
                <label for="email" class="text-lg flex justify-between items-end">
                <span>Email</span>
                <span class="text-xs text-red-500 ">{$this->email->getError()}</span>
                </label>
                <div class="mt-1 flex shadow-md">
                    <span class="inline-flex items-center px-3 rounded-none border border-r-0 border-gray-900 dark:border-gray-100"><i class="fas fa-envelope"></i></span>
                    <input 
                        type="email" 
                        name="email" 
                        class="flex-1 block w-full sm:text-sm rounded-none border border-gray-900 dark:border-gray-100 bg-white dark:bg-gray-900"
                        value="{$this->xss($this->email->getDirtyValue())}"
                    />
                </div>
            </div>
            <div>
                <button type="submit" class="font-medium shadow-md rounded-none p-2 w-full focus:outline-none focus:ring-2 focus:ring-offset-2 border border-gray-900 dark:border-gray-100 bg-gray-800 dark:bg-gray-200 text-gray-200 dark:text-gray-800 hover:bg-gray-900 dark:hover:bg-gray-100"><i class="fas fa-check"></i> Send</button>
            </div>
        </form>
       HTML;

    }

}
