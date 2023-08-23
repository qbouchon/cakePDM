<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ArchivedResourcesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ArchivedResourcesTable Test Case
 */
class ArchivedResourcesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ArchivedResourcesTable
     */
    protected $ArchivedResources;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.ArchivedResources',
        'app.Domains',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('ArchivedResources') ? [] : ['className' => ArchivedResourcesTable::class];
        $this->ArchivedResources = $this->getTableLocator()->get('ArchivedResources', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->ArchivedResources);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\ArchivedResourcesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\ArchivedResourcesTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
