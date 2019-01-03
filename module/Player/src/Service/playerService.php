<?php

namespace Player\Service;

use Zend\ServiceManager\ServiceLocatorInterface;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use DoctrineORMModule\Form\Annotation\AnnotationBuilder;
use Application\Service\defaultService;

/*
 * Entities
 */

use Player\Entity\Player;

class playerService extends defaultService implements playerServiceInterface
{

    /**
     * Set the columns for searching
     */
    private $searchColumns = ['surName', 'lastName', 'screenName'];
    /**
     * EntityManager for doctrine
     */
    private $entityManager;

    /**
     * Constructor.
     */
    public function __construct($entityManager)
    {
        parent::setEntityManager($entityManager);
        parent::setEntity('Player\Entity\Player');
        parent::setSearchColumns($this->searchColumns);
        $this->entityManager = $entityManager;
    }

    /**
     *
     * Get item object by on id
     *
     * @param       id $id The id to fetch the item from the database
     * @return      object
     *
     */
    public function getPlayerByUserId($id)
    {
        $qb = $this->entityManager->getRepository(Player::class)->createQueryBuilder('p');
        $qb->join('p.user','u');
        $qb->where('u.id = ' . $id);
        $query = $qb->getQuery();
        $result = $query->getResult();

        return $result;
    }

    /**
     *
     * Get array of players who are not set to a competition
     *
     * @return      array
     *
     */
    public function getUnCompetitionItems()
    {

        $items = $this->entityManager->getRepository(Player::class)
            ->findBy(['deletedAt' => null, 'competition' => null], ['lastName' => 'ASC', 'surName' => 'ASC', 'createdAt' => 'DESC']);

        return $items;
    }


}
