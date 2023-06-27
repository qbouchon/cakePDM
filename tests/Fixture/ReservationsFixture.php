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
                'start_date' => '2023-06-27 08:10:03',
                'end_date' => '2023-06-27 08:10:03',
                'is_back' => 1,
                'id_matos' => 1,
                'id_users' => 1,
            ],
        ];
        parent::init();
    }
}
