<?php
declare(strict_types=1);

namespace App\Test\TestCase\Form;

use App\Form\DemoForm;
use Cake\TestSuite\TestCase;

/**
 * App\Form\DemoForm Test Case
 */
class DemoFormTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Form\DemoForm
     */
    protected $Demo;

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->Demo = new DemoForm();
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Demo);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Form\DemoForm::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
