<?php
namespace Club\Factory;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Club\Controller\ClubController;
use Club\Service\clubService;
use UploadImages\Service\cropImageService;
use UploadImages\Service\imageService;

/**
 * This is the factory for IndexController. Its purpose is to instantiate the
 * controller and inject dependencies into it.
 */
class ClubControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {   
        $vhm = $container->get('ViewHelperManager');
        $entityManager = $container->get('doctrine.entitymanager.orm_default');
        $config = $container->get('config');
        $repository = new clubService($entityManager);
        $cropImageService = new cropImageService($entityManager, $config);
        $imageService = new imageService($entityManager, $config);
        // Instantiate the controller and inject dependencies
        return new ClubController($vhm, $repository, $cropImageService, $imageService);
    }
}