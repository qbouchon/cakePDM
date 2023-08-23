<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ArchivedResource Entity
 *
 * @property int $id
 * @property string $name
 * @property string|null $picture
 * @property string|null $picture_path
 * @property string|null $description
 * @property int|null $domain_id
 * @property int|null $max_duration
 * @property bool|null $archive
 *
 * @property \App\Model\Entity\Domain $domain
 */
class ArchivedResource extends Entity
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
        'picture_path' => true,
        'description' => true,
        'domain_id' => true,
        'max_duration' => true,
        'archive' => true,
        'domain' => true,
    ];
}
