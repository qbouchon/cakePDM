<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\I18n\FrozenTime;

/**
 * Reservation Entity
 *
 * @property int $id
 * @property \Cake\I18n\FrozenDate $start_date
 * @property \Cake\I18n\FrozenDate $end_date
 * @property bool|null $is_back
 * @property \Cake\I18n\FrozenDate|null $back_date
 * @property int $resource_id
 * @property int $user_id
 *
 * @property \App\Model\Entity\Resource $resource
 * @property \App\Model\Entity\User $user
 */
class Reservation extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected $_accessible = [
        'start_date' => true,
        'end_date' => true,
        'is_back' => true,
        'back_date' => true,
        'resource_id' => true,
        'user_id' => true,
        'resource' => true,
        'user' => true,
    ];



    public function checkStartDate()
    {
        $today = FrozenTime::now();

        if($this->start_date<$today->i18nFormat('yyyy-MM-dd'))
            return false; 
        
        return true;
    }


    //Check if start_date before end_date
    public function checkDates()
    {
        if($this->end_date < $this->start_date)
            return false;
        else
            return true;
    }

    //Check if the duration of reservation is not greater than the maximum duration for the specific resource
    public function checkReservationDuration()
    {

        $durationInDays = ($this->end_date->getTimestamp() - $this->start_date->getTimestamp()) / (24 * 60 * 60);
        if($durationInDays > $this->resource->max_duration)
            return false;
        else
            return true;
    }

    //Check if there is no overlape reservation for the resource
    public function checkOverlapeReservation()
    {

        foreach($this->resource->reservations as $reservation)
        {
            //We only check if the resource "is not back"
            if($reservation->start_date <= $this->end_date && $reservation->end_date >= $this->start_date && !$reservation->is_back)
                return false;

        }

        return true;
    }


}
