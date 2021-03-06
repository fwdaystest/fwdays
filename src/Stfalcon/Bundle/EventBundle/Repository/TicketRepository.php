<?php

namespace Stfalcon\Bundle\EventBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Application\Bundle\UserBundle\Entity\User;
use Stfalcon\Bundle\EventBundle\Entity\Event;

/**
 * EventRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class TicketRepository extends EntityRepository
{

    /**
     * Find tickets of active events for some user
     *
     * @param User $user
     *
     * @return array
     */
    public function findTicketsOfActiveEventsForUser(User $user)
    {
        return $this->getEntityManager()
            ->createQuery('
                SELECT t
                FROM StfalconEventBundle:Ticket t
                JOIN t.event e
                WHERE e.active = TRUE
                    AND t.user = :user
            ')
            ->setParameter('user', $user)
            ->getResult();
    }

    /**
     * Find tickets by event
     *
     * @param Event $event
     *
     * @return array
     */
    public function findTicketsByEvent(Event $event)
    {
        return $this->getEntityManager()
            ->createQuery('
                SELECT t
                FROM StfalconEventBundle:Ticket t
                JOIN t.event e
                WHERE e.active = TRUE
                    AND t.event = :event
            ')
            ->setParameter('event', $event)
            ->getResult();
    }

    /**
     * Find tickets by event group by user
     *
     * @param Event $event
     *
     * @return array
     */
    public function findTicketsByEventGroupByUser(Event $event)
    {
        return $this->getEntityManager()
            ->createQuery('
                SELECT t
                FROM StfalconEventBundle:Ticket t
                JOIN t.event e
                WHERE e.active = TRUE
                    AND t.event = :event
                GROUP BY t.user
            ')
            ->setParameter('event', $event)
            ->getResult();
    }
}
