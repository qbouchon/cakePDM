<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ReturnedReservationsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ReturnedReservationsTable Test Case
 */
class ReturnedReservationsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ReturnedReservationsTable
     */
    protected $ReturnedReservations;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.ReturnedReservations',
        'app.Resources',
        'app.Users',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('ReturnedReservations') ? [] : ['className' => ReturnedReservationsTable::class];
        $this->ReturnedReservations = $this->getTableLocator()->get('ReturnedReservations', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->ReturnedReservations);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\ReturnedReservationsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\ReturnedReservationsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
