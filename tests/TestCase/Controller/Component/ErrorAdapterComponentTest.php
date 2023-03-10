<?php
namespace App\Test\TestCase\Controller\Component;

use App\Controller\Component\ErrorAdapterComponent;
use Cake\Controller\ComponentRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\Component\ErrorAdapterComponent Test Case
 */
class ErrorAdapterComponentTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Controller\Component\ErrorAdapterComponent
     */
    public $ErrorAdapter;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $registry = new ComponentRegistry();
        $this->ErrorAdapter = new ErrorAdapterComponent($registry);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ErrorAdapter);

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
