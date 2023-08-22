<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\Reservation;
use Authorization\IdentityInterface;

/**
 * Reservation policy
 */
class ReservationPolicy
{
    /**
     * Check if $user can add Reservation
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Reservation $reservation
     * @return bool
     */
    public function canAdd(IdentityInterface $user, Reservation $reservation)
    {
        return true;
    }

      public function canAddForUser(IdentityInterface $user, Reservation $reservation)
    {
        return $user->admin ? true : false;
    }

    /**
     * Check if $user can edit Reservation
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Reservation $reservation
     * @return bool
     */
    public function canEdit(IdentityInterface $user, Reservation $reservation)
    {
        return $user->admin ? true : false;
    }

    /**
     * Check if $user can delete Reservation
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Reservation $reservation
     * @return bool
     */
    public function canDelete(IdentityInterface $user, Reservation $reservation)
    {
        return $user->admin ? true : false;
    }

    /**
     * Check if $user can view Reservation
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Reservation $reservation
     * @return bool
     */
    public function canView(IdentityInterface $user, Reservation $reservation)
    {
        return $user->admin ? true : false;
    }

    public function canSetBack(IdentityInterface $user, Reservation $reservation)
    {
        return $user->admin ? true : false;
    }

    public function canUnSetBack(IdentityInterface $user, Reservation $reservation)
    {
        return $user->admin ? true : false;
    }

}
