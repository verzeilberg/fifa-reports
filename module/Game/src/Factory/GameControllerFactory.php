<?php
namespace Game\Factory;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Game\Controller\GameController;
use Game\Service\gameService;
use Result\Service\resultService;

/**
 * This is the factory for IndexController. Its purpose is to instantiate the
 * controller and inject dependencies into it.
 */
class GameControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {   
        $vhm = $container->get('ViewHelperManager');
        $entityManager = $container->get('doctrine.entitymanager.orm_default');
        $repository = new gameService($entityManager);
        $resultRepository = new resultService($entityManager);
        // Instantiate the controller and inject dependencies
        return new GameController($vhm, $repository, $resultRepository);
    }
}