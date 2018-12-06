<?php
namespace PlayOff\Factory;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use PlayOff\Controller\PlayOffAjaxController;
use PlayOff\Service\playOffService;
use Season\Service\seasonService;

/**
 * This is the factory for IndexController. Its purpose is to instantiate the
 * controller and inject dependencies into it.
 */
class PlayOffAjaxControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {   
        $vhm = $container->get('ViewHelperManager');
        $entityManager = $container->get('doctrine.entitymanager.orm_default');
        $repository = new playOffService($entityManager);
        $seasonRepository = new seasonService($entityManager);
        // Instantiate the controller and inject dependencies
        return new PlayOffAjaxController($vhm, $repository, $seasonRepository);
    }
}