<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\MatosTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\MatosTable Test Case
 */
class MatosTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\MatosTable
     */
    protected $Matos;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Matos',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Matos') ? [] : ['className' => MatosTable::class];
        $this->Matos = $this->getTableLocator()->get('Matos', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Matos);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\MatosTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
