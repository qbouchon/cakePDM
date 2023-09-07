<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ClosingDatesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ClosingDatesTable Test Case
 */
class ClosingDatesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ClosingDatesTable
     */
    protected $ClosingDates;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.ClosingDates',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('ClosingDates') ? [] : ['className' => ClosingDatesTable::class];
        $this->ClosingDates = $this->getTableLocator()->get('ClosingDates', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->ClosingDates);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\ClosingDatesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
