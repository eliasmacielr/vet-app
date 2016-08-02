<?php
namespace App\Test\TestCase\Model\Behavior;

use App\Model\Behavior\SearchedBehavior;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Behavior\SearchedBehavior Test Case
 */
class SearchedBehaviorTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Behavior\SearchedBehavior
     */
    public $Searched;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $this->Searched = new SearchedBehavior();
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Searched);

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
