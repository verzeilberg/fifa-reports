<?php
namespace Player\Factory;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Player\Controller\PlayerController;
use Player\Service\playerService;
use UploadImages\Service\cropImageService;
use UploadImages\Service\imageService;

/**
 * This is the factory for IndexController. Its purpose is to instantiate the
 * controller and inject dependencies into it.
 */
class PlayerControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {   
        $vhm = $container->get('ViewHelperManager');
        $config = $container->get('config');
        $entityManager = $container->get('doctrine.entitymanager.orm_default');
        $repository = new playerService($entityManager);
        $cropImageService = new cropImageService($entityManager, $config);
        $imageService = new imageService($entityManager, $config);
        // Instantiate the controller and inject dependencies
        return new PlayerController($vhm, $repository, $cropImageService, $imageService);
    }
}