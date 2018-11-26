<?php
namespace Competition\Factory;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Competition\Controller\CompetitionController;
use Competition\Service\competitionService;

/**
 * This is the factory for IndexController. Its purpose is to instantiate the
 * controller and inject dependencies into it.
 */
class CompetitionControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {   
        $vhm = $container->get('ViewHelperManager');
        $entityManager = $container->get('doctrine.entitymanager.orm_default');
        $repository = new competitionService($entityManager);
        // Instantiate the controller and inject dependencies
        return new CompetitionController($vhm, $repository);
    }
}