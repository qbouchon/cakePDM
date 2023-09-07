<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\ClosingDates;
use Authorization\IdentityInterface;

/**
 * ClosingDates policy
 */
class ClosingDatesPolicy
{
    /**
     * Check if $user can add ClosingDates
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\ClosingDates $closingDates
     * @return bool
     */
    public function canAdd(IdentityInterface $user, ClosingDates $closingDates)
    {
        return $user->admin ? true : false;
    }

    /**
     * Check if $user can edit ClosingDates
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\ClosingDates $closingDates
     * @return bool
     */
    public function canEdit(IdentityInterface $user, ClosingDates $closingDates)
    {
        return $user->admin ? true : false;
    }

    /**
     * Check if $user can delete ClosingDates
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\ClosingDates $closingDates
     * @return bool
     */
    public function canDelete(IdentityInterface $user, ClosingDates $closingDates)
    {
        return $user->admin ? true : false;
    }

    /**
     * Check if $user can view ClosingDates
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\ClosingDates $closingDates
     * @return bool
     */
    public function canView(IdentityInterface $user, ClosingDates $closingDates)
    {
        return $user->admin ? true : false;
    }
}
