<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\Resource;
use Authorization\IdentityInterface;

/**
 * Resources policy
 */
class ResourcePolicy
{
    /**
     * Check if $user can add Resource
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Resource $resource
     * @return bool
     */
    public function canAdd(IdentityInterface $user, Resource $resource)
    {
        return $user->admin ? true : false;
    }

    /**
     * Check if $user can edit Resource
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Resource $resource
     * @return bool
     */
    public function canEdit(IdentityInterface $user, Resource $resource)
    {
        return $user->admin ? true : false;
    }

    /**
     * Check if $user can delete Resource
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Resource $resource
     * @return bool
     */
    public function canDelete(IdentityInterface $user, Resource $resource)
    {
        return $user->admin ? true : false;
    }

    /**
     * Check if $user can view Resource
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Resource $resource
     * @return bool
     */
    public function canView(IdentityInterface $user, Resource $resource)
    {
        return $user->admin ? true : false;
    }

     public function canArchive(IdentityInterface $user, Resource $resource)
    {
        return $user->admin ? true : false;
    }

     public function canUnArchive(IdentityInterface $user, Resource $resource)
    {
        return $user->admin ? true : false;
    }
    public function canGetReservationsDates(IdentityInterface $user, Resource $resource)
    {
        return true;
    }
}
