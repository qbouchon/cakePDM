<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ReservationTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ReservationTable Test Case
 */
class ReservationTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ReservationTable
     */
    protected $Reservation;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Reservation',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Reservation') ? [] : ['className' => ReservationTable::class];
        $this->Reservation = $this->getTableLocator()->get('Reservation', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Reservation);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\ReservationTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
