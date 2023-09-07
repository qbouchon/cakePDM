<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ClosingDatesFixture
 */
class ClosingDatesFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'name' => 'Lorem ipsum dolor sit amet',
                'start_date' => '2023-09-07',
                'end_date' => '2023-09-07',
            ],
        ];
        parent::init();
    }
}
