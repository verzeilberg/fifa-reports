<?php
namespace Season\Factory;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Season\Controller\SeasonController;
use Season\Service\seasonService;

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
        $playerRepository = new \Player\Service\playerService($entityManager);
        // Instantiate the controller and inject dependencies
        return new SeasonController($vhm, $repository, $playerRepository);
    }
}