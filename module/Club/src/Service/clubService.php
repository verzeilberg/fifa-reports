<?php

namespace Club\Service;

use Zend\ServiceManager\ServiceLocatorInterface;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use DoctrineORMModule\Form\Annotation\AnnotationBuilder;
use Application\Service\defaultService;

/*
 * Entities
 */

use Club\Entity\Club;

class clubService extends defaultService implements clubServiceInterface
{
    /**
     * Set the columns for searching
     */
    private $searchColumns = ['name', 'city'];


    /**
     * Constructor.
     */
    public function __construct($entityManager)
    {
        parent::setEntityManager($entityManager);
        parent::setEntity('Club\Entity\Club');
        parent::setSearchColumns($this->searchColumns);
    }

}
