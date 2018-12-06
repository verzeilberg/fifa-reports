<?php

namespace PlayOff\Service;

use Zend\ServiceManager\ServiceLocatorInterface;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use DoctrineORMModule\Form\Annotation\AnnotationBuilder;
use Application\Service\defaultService;

/*
 * Entities
 */

use PlayOff\Entity\PlayOff;

class playOffService extends defaultService implements playOffServiceInterface
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
        parent::setEntity('PlayOff\Entity\PlayOff');
        parent::setSearchColumns($this->searchColumns);
    }

}
