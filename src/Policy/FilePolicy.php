<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\File;
use Authorization\IdentityInterface;

/**
 * File policy
 */
class FilePolicy
{
    /**
     * Check if $user can add File
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\File $file
     * @return bool
     */
    public function canAdd(IdentityInterface $user, File $file)
    {
         return $user->admin ? true :  false;
    }

    /**
     * Check if $user can edit File
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\File $file
     * @return bool
     */
    public function canEdit(IdentityInterface $user, File $file)
    {
         return $user->admin ? true :  false;
    }

    /**
     * Check if $user can delete File
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\File $file
     * @return bool
     */
    public function canDelete(IdentityInterface $user, File $file)
    {
         return $user->admin ? true :  false;
    }

    /**
     * Check if $user can view File
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\File $file
     * @return bool
     */
    public function canView(IdentityInterface $user, File $file)
    {
         return $user->admin ? true :  false;
    }

    
}
