<?php
namespace Competition\Factory;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Competition\Controller\CompetitionAjaxController;
use Competition\Service\competitionService;
use Player\Service\playerService;
use Game\Service\gameService;
use Season\Service\seasonService;

/**
 * This is the factory for IndexController. Its purpose is to instantiate the
 * controller and inject dependencies into it.
 */
class CompetitionAjaxControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {   
        $vhm = $container->get('ViewHelperManager');
        $entityManager = $container->get('doctrine.entitymanager.orm_default');
        $repository = new competitionService($entityManager);
        $gameRepository = new gameService($entityManager);
        $playerRepository = new playerService($entityManager);
        $seasonRepository = new seasonService($entityManager);
        // Instantiate the controller and inject dependencies
        return new CompetitionAjaxController($vhm, $repository, $gameRepository, $playerRepository, $seasonRepository);
    }
}