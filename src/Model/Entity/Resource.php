<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Resource Entity
 *
 * @property int $id
 * @property string $name
 * @property string|null $picture
 * @property string|null $description
 * @property int|null $domain_id
 * @property bool|null $archive
 *
 * @property \App\Model\Entity\Domain $domain
 * @property \App\Model\Entity\File[] $files
 * @property \App\Model\Entity\Reservation[] $reservations
 */
class Resource extends Entity
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
        'name' => true,
        'picture' => true,
        'description' => true,
        'domain_id' => true,
        'archive' => true,
        'domain' => true,
        'files' => true,
        'reservations' => true,
    ];
}
