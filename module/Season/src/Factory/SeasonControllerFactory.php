<?php
namespace Season\Factory;

use Interop\Container\ContainerInterface;
use Season\Controller\SeasonController;
use Zend\ServiceManager\Factory\FactoryInterface;
use Season\Service\seasonService;
use Player\Service\playerService;

/**
 * This is the factory for IndexController. Its purpose is to instantiate the
 * controller and inject dependencies into it.
 */
class SeasonControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {   
        $vhm = $container->get('ViewHelperManager');
        $entityManager = $container->get('doctrine.entitymanager.orm_default');
        $repository = new seasonService($entityManager);
        $playerRepository = new playerService($entityManager);
        // Instantiate the controller and inject dependencies
        return new SeasonController($vhm, $repository, $playerRepository);
    }
}