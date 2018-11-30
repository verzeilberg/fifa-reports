<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use User\Entity\User;

/**
 * This is the main controller class of the User Demo application. It contains
 * site-wide actions such as Home or About.
 */
class IndexController extends AbstractActionController {
    protected $vhm;
    private $seasonRepository;
    private $gameRepository;
    private $resultRepository;

    /**
     * Constructor. Its purpose is to inject dependencies into the controller.
     */
    public function __construct($vhm, $seasonRepository, $gameRepository, $resultRepository) {
        $this->vhm = $vhm;
        $this->seasonRepository = $seasonRepository;
        $this->gameRepository = $gameRepository;
        $this->resultRepository = $resultRepository;
    }

    /**
     * This is the default "index" action of the controller. It displays the 
     * Home page.
     */
    public function indexAction() {
        $this->layout('layout/home');
        $this->vhm->get('headScript')->appendFile('/js/application.js');

        $season = $this->seasonRepository->getItem(1);
        $currentDate = new \DateTime();

        $weekArray = $this->getStartAndEndDate($currentDate->format('W'), $currentDate->format('Y'));
        $games = $this->gameRepository->getGamesBySeasonAndDates($season->getId(), $weekArray);
        $results = $this->resultRepository->getResultsBySeason(1);

        $currentDateTime = new \DateTime();
        $weekNr = $currentDateTime->format('W');

        return new ViewModel([
            'season' => $season,
            'games' => $games,
            'weekNr' => $weekNr,
            'results' => $results
        ]);
    }

    public function gameScheduleAction() {

        $season = $this->seasonRepository->getItem(1);

        return new ViewModel([
            'season' => $season
        ]);
    }

    public function gamesResultsAction() {
        $this->vhm->get('headScript')->appendFile('/js/game.js');
        $season = $this->seasonRepository->getItem(1);

        return new ViewModel([
            'season' => $season
        ]);
    }

    /*
     * Rules page
     */

    public function rulesAction() {
        return new ViewModel();
    }

    /*
     * @todo move this to service class
     */

    private function getStartAndEndDate($week, $year) {
        $dto = new \DateTime();
        $dto->setISODate($year, $week);
        $ret['start'] = $dto->format('Y-m-d');
        $dto->modify('+6 days');
        $ret['end'] = $dto->format('Y-m-d');
        return $ret;
    }

    /**
     * The "settings" action displays the info about currently logged in user.
     */
    public function settingsAction() {
        $id = $this->params()->fromRoute('id');

        if ($id != null) {
            $user = $this->entityManager->getRepository(User::class)
                    ->find($id);
        } else {
            $user = $this->currentUser();
        }

        if ($user == null) {
            $this->getResponse()->setStatusCode(404);
            return;
        }

        if (!$this->access('profile.any.view') &&
                !$this->access('profile.own.view', ['user' => $user])) {
            return $this->redirect()->toRoute('not-authorized');
        }

        return new ViewModel([
            'user' => $user
        ]);
    }

}
