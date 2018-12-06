<?php
namespace PlayOff\Factory;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use PlayOff\Controller\PlayOffController;
use PlayOff\Service\playOffService;

/**
 * This is the factory for IndexController. Its purpose is to instantiate the
 * controller and inject dependencies into it.
 */
class PlayOffControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {   
        $vhm = $container->get('ViewHelperManager');
        $entityManager = $container->get('doctrine.entitymanager.orm_default');
        $repository = new playOffService($entityManager);
        $playerRepository = new \Player\Service\playerService($entityManager);
        // Instantiate the controller and inject dependencies
        return new PlayOffController($vhm, $repository, $playerRepository);
    }
}