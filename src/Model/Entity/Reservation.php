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


}
