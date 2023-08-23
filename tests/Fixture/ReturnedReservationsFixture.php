<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ReturnedReservationsFixture
 */
class ReturnedReservationsFixture extends TestFixture
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
                'start_date' => '2023-08-23',
                'end_date' => '2023-08-23',
                'is_back' => 1,
                'back_date' => '2023-08-23',
                'resource_id' => 1,
                'user_id' => 1,
            ],
        ];
        parent::init();
    }
}
