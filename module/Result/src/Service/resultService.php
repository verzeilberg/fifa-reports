<?php

namespace Result\Service;

use Zend\ServiceManager\ServiceLocatorInterface;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use DoctrineORMModule\Form\Annotation\AnnotationBuilder;

/*
 * Entities
 */
use Result\Entity\Result;

class resultService implements resultServiceInterface {

    /**
     * Constructor.
     */
    public function __construct($entityManager) {
        $this->entityManager = $entityManager;
    }

    /**
     *
     * Get array of items
     *
     * @return      array
     *
     */
    public function getItems() {

        $items = $this->entityManager->getRepository(Result::class)
                ->findBy([], ['createdAt' => 'DESC']);

        return $items;
    }

    /**
     *
     * Get item object by on id
     *
     * @param       id  $id The id to fetch the item from the database
     * @return      object
     *
     */
    public function getItem($id) {
        $item = $this->entityManager->getRepository(Result::class)
                ->findOneBy(['id' => $id], []);

        return $item;
    }
    
    
    public function getResultsBySeason($seasonId) {
        $qb = $this->entityManager->getRepository(Result::class)->createQueryBuilder('r');
        $qb->select('c.id as competitionId, '
                . 'p.id as playerId, '
                . 'p.surName as surName, '
                . 'p.lastNamePrefix as lastNamePrefix, '
                . 'p.lastName as lastName, '
                . 'SUM(r.goals) as totalGoals, '
                . 'SUM(r.goalsAgainst) as totalAgainstGoals, '
                . '(SUM(r.goals) - SUM(r.goalsAgainst)) as targetBalance, '
                . 'COUNT(r.id) as totalGames, '
                . 'SUM(r.points) as totalPoints, '
                . 'SUM(CASE WHEN r.points = 3 THEN 1 ELSE 0 END) AS gamesWon, '
                . 'SUM(CASE WHEN r.points = 0 THEN 1 ELSE 0 END) AS gamesLost, '
                . 'SUM(CASE WHEN r.points = 1 THEN 1 ELSE 0 END) AS gamesDraw '
                );
        $qb->leftJoin('r.season', 's');
        $qb->leftJoin('r.player', 'p');
        $qb->leftJoin('r.competition', 'c');
        $qb->where('s.id = :seasonId');
        $qb->groupBy('r.player');
        $qb->addGroupBy('r.competition');
        $qb->orderBy('totalPoints', 'DESC');
        $qb->addOrderBy('r.player', 'ASC');
        $qb->setParameter('seasonId', $seasonId);
        $query = $qb->getQuery();
        $result = $query->getResult();
        
        $resultsByCompetition = [];
        foreach($result as $index => $result){
            $resultsByCompetition[$result['competitionId']][$result['playerId']] = $result;
        }
        return $resultsByCompetition;
        
    }

    /**
     *
     * Get array of items
     * @var $searchString string to search for
     *
     * @return      array
     *
     */
    public function searchItems($searchString) {
        $qb = $this->entityManager->getRepository(Result::class)->createQueryBuilder('c');
        $orX = $qb->expr()->orX();
        $orX->add($qb->expr()->like('c.name', $qb->expr()->literal("%$searchString%")));
        $qb->where($orX);
        $query = $qb->getQuery();
        $result = $query->getResult();
        return $result;
    }

    /**
     *
     * Create form of an object
     *
     * @param       item $item object
     * @return      form
     *
     */
    public function createForm($item) {
        $builder = new AnnotationBuilder($this->entityManager);
        $form = $builder->createForm($item);
        $form->setHydrator(new DoctrineHydrator($this->entityManager, 'Result\Entity\Result'));
        $form->bind($item);
        return $form;
    }


    /**
     *
     * Create a new item object
     * @return      object
     *
     */
    public function newItem() {
        $item = new Result();
        return $item;
    }

    /**
     *
     * Save a item to the database
     * @param       item $item object
     * @param       user $user object
     * @return      void
     *
     */
    public function saveItem($item) {
        $this->storeItem($item);
    }

    /**
     *
     * Update a item in database
     * @param       item $item object
     * @param       user $user object
     * @return      void
     *
     */
    public function updateItem($item) {
        $this->storeItem($item);
    }

    /**
     *
     * Save a item to database
     * @param       item $item object
     * @return      void
     *
     */
    public function storeItem($item) {
        $this->entityManager->persist($item);
        $this->entityManager->flush();
    }

    /**
     *
     * Delete a item from the database
     * @param       item $item object
     * @return      void
     *
     */
    public function deleteItem($item) {
        $this->entityManager->remove($item);
        $this->entityManager->flush();
    }

}
