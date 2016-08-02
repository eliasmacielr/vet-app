<?php
namespace App\Test\TestCase\Form;

use App\Form\ChangePasswordForm;
use Cake\TestSuite\TestCase;

/**
 * App\Form\ChangePasswordForm Test Case
 */
class ChangePasswordFormTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Form\ChangePasswordForm
     */
    public $ChangePassword;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $this->ChangePassword = new ChangePasswordForm();
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ChangePassword);

        parent::tearDown();
    }

    /**
     * Test initial setup
     *
     * @return void
     */
    public function testInitialization()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
