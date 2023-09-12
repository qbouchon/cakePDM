<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * User Entity
 *
 * @property int $id
 * @property string|null $firstname
 * @property string|null $lastname
 * @property string|null $username
 * @property string|null $email
 * @property string|null $password
 * @property bool|null $active
 * @property bool $admin
 *
 * @property \App\Model\Entity\Reservation[] $reservations
 */

use Authentication\PasswordHasher\DefaultPasswordHasher;

class User extends Entity
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
        'firstname' => true,
        'lastname' => true,
        'username' => true,
        'email' => true,
        'password' => true,
        'active' => true,
        'admin' => true,
        'reservations' => true,
    ];

    protected array $_virtual = [
        'fullname'
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array<string>
     */
    protected array $_hidden = [
        'password',
    ];


     // Automatically hash passwords when they are changed.
    protected function _setPassword(string $password)
    {
        $hasher = new DefaultPasswordHasher();
        return $hasher->hash($password);
    }

    protected function _getFullName()
    {
        return $this->firstname . ' ' . $this->lastname;
    }
    
}
