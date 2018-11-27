<?php

namespace Game\Service;

use Zend\ServiceManager\ServiceLocatorInterface;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use DoctrineORMModule\Form\Annotation\AnnotationBuilder;

/*
 * Entities
 */
use Game\Entity\Game;

class gameService implements gameServiceInterface {

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

        $items = $this->entityManager->getRepository(Game::class)
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
        $item = $this->entityManager->getRepository(Game::class)
                ->findOneBy(['id' => $id], []);

        return $item;
    }

    /**
     *
     * Get array of items based on season id and start- end date
     *
     * @param       seasonId $seasonId The id of the season you want to fetch the games from
     * @param       dates $dates array with an start- and end date
     * @return void
     */
    public function getGamesBySeasonAndDates($seasonId, $dates) {
        $qb = $this->entityManager->getRepository(Game::class)->createQueryBuilder('g');
        $qb->join('g.season', 's');
        $qb->where('s.id = ' . $seasonId);
        $qb->andWhere('g.playDate >= :start');
        $qb->andWhere('g.playDate <= :end');
        $qb->setParameter('start', new \DateTime($dates['start']));
        $qb->setParameter('end', new \DateTime($dates['end']));
        $query = $qb->getQuery();
        $result = $query->getResult();
        return $result;
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
        $qb = $this->entityManager->getRepository(Game::class)->createQueryBuilder('c');
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
        $form->setHydrator(new DoctrineHydrator($this->entityManager, 'Game\Entity\Game'));
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
        $item = new Game();
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
