<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * File Entity
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $file_path
 * @property int|null $resource_id
 *
 * @property \App\Model\Entity\Resource $resource
 */
class File extends Entity
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
    protected array $_accessible = [
        'name' => true,
        'file_path' => true,
        'resource_id' => true,
        'resource' => true,
    ];


    public function getFilePath(){ 

        return  WWW_ROOT.'resourcesfiles'.DS.$this->file_path;

    }

}
