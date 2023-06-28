<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DomainsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DomainsTable Test Case
 */
class DomainsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\DomainsTable
     */
    protected $Domains;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Domains',
        'app.Resources',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Domains') ? [] : ['className' => DomainsTable::class];
        $this->Domains = $this->getTableLocator()->get('Domains', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Domains);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\DomainsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
