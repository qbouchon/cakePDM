<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ReservationFixture
 */
class ReservationFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'reservation';
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
                'start_date' => '2023-06-20 07:54:40',
                'end_date' => '2023-06-20 07:54:40',
                'id_matos' => 1,
                'id_users' => 1,
            ],
        ];
        parent::init();
    }
}
