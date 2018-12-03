<?php

namespace Competition\Service;

use Zend\ServiceManager\ServiceLocatorInterface;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use DoctrineORMModule\Form\Annotation\AnnotationBuilder;
use Application\Service\defaultService;

/*
 * Entities
 */

use Competition\Entity\Competition;

class competitionService extends defaultService implements competitionServiceInterface
{

    /**
     * Set the columns for searching
     */
    private $searchColumns = ['name'];


    /**
     * Constructor.
     */
    public function __construct($entityManager)
    {
        parent::setEntityManager($entityManager);
        parent::setEntity('Competition\Entity\Competition');
        parent::setSearchColumns($this->searchColumns);
    }

    /**
     *
     * Get array of player id's of given competition
     *
     * @return      array
     *
     */
    public function getPlayersIds($id)
    {

        $competition = $this->getItem($id);
        $playersIds = [];
        foreach ($competition->getPlayers() as $player) {
            $playersIds[] = $player->getId();
        }

        return $playersIds;
    }


}
