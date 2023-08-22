<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\Domain;
use Authorization\IdentityInterface;

/**
 * Domain policy
 */
class DomainPolicy
{
    /**
     * Check if $user can add Domain
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Domain $domain
     * @return bool
     */
    public function canAdd(IdentityInterface $user, Domain $domain)
    {
        return $user->admin ? true : false;
    }

    /**
     * Check if $user can edit Domain
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Domain $domain
     * @return bool
     */
    public function canEdit(IdentityInterface $user, Domain $domain)
    {
        return $user->admin ? true : false;
    }

    /**
     * Check if $user can delete Domain
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Domain $domain
     * @return bool
     */
    public function canDelete(IdentityInterface $user, Domain $domain)
    {
       return $user->admin ? true : false;
    }

    /**
     * Check if $user can view Domain
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Domain $domain
     * @return bool
     */
    public function canView(IdentityInterface $user, Domain $domain)
    {
        return $user->admin ? true : false;
    }

    public function canResources(IdentityInterface $user, Domain $domain)
     {;
        return true;
     }
}
