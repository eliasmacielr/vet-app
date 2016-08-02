<?php
namespace App\Test\TestCase\Form;

use App\Form\EditProfileForm;
use Cake\TestSuite\TestCase;

/**
 * App\Form\EditProfileForm Test Case
 */
class EditProfileFormTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Form\EditProfileForm
     */
    public $EditProfile;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $this->EditProfile = new EditProfileForm();
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->EditProfile);

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
