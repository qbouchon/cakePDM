<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\Reservation;
use Authorization\IdentityInterface;
use Cake\I18n\FrozenTime;

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
        if($user->admin && $reservation->start_date >= FrozenTime::now()) //Pour éviter les problèmes, on ne peut pas éditer de réservations en cours
            return true;
        elseif($reservation->user_id == $user->id && $reservation->start_date > FrozenTime::now()) //On autorise si la réservation appartient à l'utilisateur et qu'elle n'est pas en cours
            return true;
        else
            return false;
    }
     public function canEditForUser(IdentityInterface $user, Reservation $reservation)
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

        if($user->admin)
            return true;
        elseif($reservation->user_id == $user->id && $reservation->start_date > FrozenTime::now()) //On autorise si la réservation appartient à l'utilisateur et qu'elle n'est pas en cours
            return true;
        else
            return false;
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

     public function canStats(IdentityInterface $user, Reservation $reservation)
    {
        return $user->admin ? true : false;
    }


}
