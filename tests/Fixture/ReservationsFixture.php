<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ReservationsFixture
 */
class ReservationsFixture extends TestFixture
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
                'start_date' => '2023-06-29',
                'end_date' => '2023-06-29',
                'is_back' => 1,
                'resource_id' => 1,
                'user_id' => 1,
            ],
        ];
        parent::init();
    }
}
