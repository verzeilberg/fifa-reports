<?php
namespace Application\Controller\Factory;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Application\Controller\IndexController;
use Season\Service\seasonService;
use Game\Service\gameService;
use Result\Service\resultService;

/**
 * This is the factory for IndexController. Its purpose is to instantiate the
 * controller and inject dependencies into it.
 */
class IndexControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $vhm = $container->get('ViewHelperManager');
        $entityManager = $container->get('doctrine.entitymanager.orm_default');
        $seasonRepository = new seasonService($entityManager);
        $gameRepository = new gameService($entityManager);
        $resultRepository = new resultService($entityManager);
        // Instantiate the controller and inject dependencies
        return new IndexController($vhm, $seasonRepository, $gameRepository, $resultRepository);
    }
}