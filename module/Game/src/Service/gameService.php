<?php

namespace Game\Service;

use Zend\ServiceManager\ServiceLocatorInterface;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use DoctrineORMModule\Form\Annotation\AnnotationBuilder;
use Application\Traits\timeDateService;
use Application\Service\defaultService;

/*
 * Entities
 */
use Game\Entity\Game;

class gameService extends defaultService implements gameServiceInterface {


    use timeDateService;

    /**
     * Set the columns for searching
     */
    private $searchColumns = ['name'];

    private $entityManager;


    /**
     * Constructor.
     */
    public function __construct($entityManager)
    {
        parent::setEntityManager($entityManager);
        parent::setEntity('Game\Entity\Game');
        parent::setSearchColumns($this->searchColumns);
        $this->entityManager = $entityManager;
    }

    /**
     *
     * Convert an object to array
     *
     * @param      object $object to be converted
     * @return      array
     *
     */
    public function convertObjectToArray($object) {
        $class_methods = get_class_methods($object);
        $objectArray = [];
        foreach ($class_methods as $method_name) {
            if (substr($method_name, 0, 3) == 'get') {
                $value = $object->$method_name();
                $index = lcfirst(substr_replace($method_name, '', 0 ,3));
                $objectArray[$index] = $value;
            }
        }
        return $objectArray;
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


}
