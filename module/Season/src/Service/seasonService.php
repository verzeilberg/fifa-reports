<?php

namespace Season\Service;

use Zend\ServiceManager\ServiceLocatorInterface;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use DoctrineORMModule\Form\Annotation\AnnotationBuilder;
use Application\Service\defaultService;

/*
 * Entities
 */

use Season\Entity\Season;

class seasonService extends defaultService implements seasonServiceInterface
{

    /**
     * Set the columns for searching
     */
    private $searchColumns = ['surName', 'lastName', 'screenName'];

    /**
     * Constructor.
     */
    public function __construct($entityManager)
    {
        parent::setEntityManager($entityManager);
        parent::setEntity('Season\Entity\Season');
        parent::setSearchColumns($this->searchColumns);
    }

}
