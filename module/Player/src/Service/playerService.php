<?php

namespace Player\Service;

use Zend\ServiceManager\ServiceLocatorInterface;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use DoctrineORMModule\Form\Annotation\AnnotationBuilder;

/*
 * Entities
 */
use Player\Entity\Player;

class playerService implements playerServiceInterface {

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

        $items = $this->entityManager->getRepository(Player::class)
                ->findBy(['deletedAt' => null], ['lastName' => 'ASC', 'surName' => 'ASC',  'createdAt' => 'DESC']);

        return $items;
    }
    
    /**
     *
     * Get array of items
     *
     * @return      array
     *
     */
    public function getUnCompetitionItems() {

        $items = $this->entityManager->getRepository(Player::class)
                ->findBy(['deletedAt' => null, 'competition' => null], ['lastName' => 'ASC', 'surName' => 'ASC',  'createdAt' => 'DESC']);

        return $items;
    }
    
    public function getStatsForPlayerInSeason() {
        $qb = $this->entityManager->getRepository(Player::class)->createQueryBuilder('p');
        $qb->join('p.homeGames', 'hg');
        $qb->join('p.awayGames', 'ag');
        //@todo finish him
        
        $query = $qb->getQuery();
        $result = $query->getResult();
        return $result;
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
        $item = $this->entityManager->getRepository(Player::class)
                ->findOneBy(['id' => $id], []);

        return $item;
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
        $qb = $this->entityManager->getRepository(Player::class)->createQueryBuilder('c');
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
        $form->setHydrator(new DoctrineHydrator($this->entityManager, 'Player\Entity\Player'));
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
        $item = new Player();
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
