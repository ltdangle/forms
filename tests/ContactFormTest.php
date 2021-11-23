<?php declare(strict_types=1);

namespace Sodalto\Tests;


use PHPUnit\Framework\TestCase;
use Sodalto\Tests\ContactForm;

class ContactFormTest extends TestCase
{
    /**
     * @test
     */
    public function it_instantiates()
    {
        $cForm = $this->_buildForm();
        $this->assertTrue($cForm instanceof ContactForm);
    }

    /**
     * @test
     */
    public function it_doesnt_validate_incorrect_values()
    {
        $cForm = $this->_buildForm();
        $cForm->setValues('', '', '');
        $this->assertFalse($cForm->isValid());
    }

    /**
     * @test
     */
    public function it_renders_html()
    {
        $cForm = $this->_buildForm();
        $message = 'My contact form';
        $cForm->setGreeting($message);
        $this->assertTrue((bool)strpos($cForm->getHtml(), $message));
    }

    private function _buildForm(): ContactForm
    {
        $cForm = new ContactForm();
        return $cForm;
    }
}