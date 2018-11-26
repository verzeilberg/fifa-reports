<?php
namespace Player\Factory;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Player\Controller\PlayerAjaxController;
use Player\Service\playerService;
use Competition\Service\competitionService;

/**
 * This is the factory for IndexController. Its purpose is to instantiate the
 * controller and inject dependencies into it.
 */
class PlayerAjaxControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {   
        $vhm = $container->get('ViewHelperManager');
        $entityManager = $container->get('doctrine.entitymanager.orm_default');
        $repository = new playerService($entityManager);
        $competitionRepository = new competitionService($entityManager);
        // Instantiate the controller and inject dependencies
        return new PlayerAjaxController($vhm, $repository, $competitionRepository);
    }
}