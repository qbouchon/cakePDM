<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\Configuration;
use Authorization\IdentityInterface;

/**
 * Configuration policy
 */
class ConfigurationPolicy
{
    /**
     * Check if $user can add Configuration
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Configuration $configuration
     * @return bool
     */
    public function canAdd(IdentityInterface $user, Configuration $configuration)
    {
        return $user->admin ? true : false;
    }

    /**
     * Check if $user can edit Configuration
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Configuration $configuration
     * @return bool
     */
    public function canEdit(IdentityInterface $user, Configuration $configuration)
    {
        return $user->admin ? true : false;
    }

    /**
     * Check if $user can delete Configuration
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Configuration $configuration
     * @return bool
     */
    public function canDelete(IdentityInterface $user, Configuration $configuration)
    {
        return $user->admin ? true : false;
    }

    /**
     * Check if $user can view Configuration
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Configuration $configuration
     * @return bool
     */
    public function canView(IdentityInterface $user, Configuration $configuration)
    {
        return $user->admin ? true : false;
    }
}
