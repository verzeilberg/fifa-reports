<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use User\Entity\User;

/**
 * This is the main controller class of the User Demo application. It contains
 * site-wide actions such as Home or About.
 */
class IndexController extends AbstractActionController
{
    protected $entityManager;
    protected $vhm;
    private $seasonRepository;
    private $gameRepository;
    private $resultRepository;
    private $competitionRepository;
    private $playerRepository;

    /**
     * Constructor. Its purpose is to inject dependencies into the controller.
     */
    public function __construct($entityManager, $vhm, $seasonRepository, $gameRepository, $resultRepository, $competitionRepository, $playerRepository)
    {
        $this->entityManager = $entityManager;
        $this->vhm = $vhm;
        $this->seasonRepository = $seasonRepository;
        $this->gameRepository = $gameRepository;
        $this->resultRepository = $resultRepository;
        $this->competitionRepository = $competitionRepository;
        $this->playerRepository = $playerRepository;
    }

    /**
     * This is the default "index" action of the controller. It displays the
     * Home page.
     */
    public function indexAction()
    {
        $this->layout('layout/home');
        $this->vhm->get('headScript')->appendFile('/js/application.js');

        $season = $this->seasonRepository->getItem(1);
        $currentDate = new \DateTime();

        $weekArray = $this->gameRepository->getStartAndEndDate($currentDate->format('W'), $currentDate->format('Y'));
        $games = $this->gameRepository->getGamesBySeasonAndDates($season->getId(), $weekArray);
        $results = $this->resultRepository->getResultsBySeason(1);
        $topScorers = $this->resultRepository->getTopScoresBySeason(1);
        $bottomScorers = $this->resultRepository->getBottomScoresBySeason(1);


        $currentDateTime = new \DateTime();
        $weekNr = $currentDateTime->format('W');

        return new ViewModel([
            'season' => $season,
            'games' => $games,
            'weekNr' => $weekNr,
            'results' => $results,
            'topScorers' => $topScorers,
            'bottomScorers' => $bottomScorers
        ]);
    }

    public function gameScheduleAction()
    {

        $season = $this->seasonRepository->getItem(1);

        return new ViewModel([
            'season' => $season
        ]);
    }

    public function gamesResultsAction()
    {
        $this->vhm->get('headScript')->appendFile('/js/game.js');
        $season = $this->seasonRepository->getItem(1);

        return new ViewModel([
            'season' => $season
        ]);
    }

    /*
     * Rules page
     */

    public function rulesAction()
    {
        return new ViewModel();
    }

    /*
     * Competition page
     */
    public function getCompetitionAction()
    {
        $this->vhm->get('headScript')->appendFile('/js/competition.js');
        $id = (int)$this->params()->fromRoute('id', 0);
        if (empty($id)) {
            return $this->redirect()->toRoute('competitions');
        }
        $competition = $this->competitionRepository->getItem($id);
        if (empty($competition)) {
            return $this->redirect()->toRoute('competitions');
        }

        $results = $this->resultRepository->getResultsBySeason(1);


        return new ViewModel(
            array(
                'competition' => $competition,
                'results' => $results
            )
        );
    }

    /**
     * The "settings" action displays the info about currently logged in user.
     */
    public function settingsAction()
    {
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

    /**
     * The "profile" action displays the users profile for editing.
     */
    public function profileAction()
    {
        $this->vhm->get('headScript')->appendFile('/js/chart/chart.bundle.min.js');

        $id = $this->params()->fromRoute('id');
        if ($id == null) {
            $this->getResponse()->setStatusCode(404);
            return;
        }

        $player = $this->playerRepository->getItem($id);
        if ($player == null) {
            $this->getResponse()->setStatusCode(404);
            return;
        }

        $loggedOnUser = false;
        if(
            is_object($player->getUser()) &&
            is_object($this->currentUser()) &&
            $player->getUser()->getId() == $this->currentUser()->getId()
        ) {
            $loggedOnUser = true;
        }

        return new ViewModel([
            'player' => $player,
            'loggedOnUser' => $loggedOnUser
        ]);
    }

}
