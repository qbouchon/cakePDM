<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ConfigurationTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ConfigurationTable Test Case
 */
class ConfigurationTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ConfigurationTable
     */
    protected $Configuration;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Configuration',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Configuration') ? [] : ['className' => ConfigurationTable::class];
        $this->Configuration = $this->getTableLocator()->get('Configuration', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Configuration);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\ConfigurationTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
