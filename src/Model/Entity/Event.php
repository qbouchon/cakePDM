<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\I18n\FrozenTime;

/**
 * Event Entity (parsing reservation for fullcalendar)
 *
 * @property int|null $id
 * @property string|null title
 * @property \Cake\I18n\FrozenDate $start
 * @property \Cake\I18n\FrozenDate $end
 * @property bool|null $allDay
 * @property bool|null $overLap
 * @property string|null $color
 * @property bool|null $isBack
 * @property string|null $tooltip
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
        'id' => true,
        'title' => true,
        'start' => true,
        'end' => true,
        'allDay' => true,
        'overlap' => true,
        'color' => true,
        'isBack' => true,
        'tooltip' => true,
    ];



}
