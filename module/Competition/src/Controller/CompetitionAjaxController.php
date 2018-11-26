<?php

namespace Competition\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\JsonModel;

/**
 * This is the main controller class of the User Demo application. It contains
 * site-wide actions such as Home or About.
 */
class CompetitionAjaxController extends AbstractActionController {

    protected $vhm;
    protected $repository;
    protected $gameRepository;
    protected $playerRepository;
    protected $seasonRepository;

    public function __construct($vhm, $repository, $gameRepository, $playerRepository, $seasonRepository) {
        $this->vhm = $vhm;
        $this->repository = $repository;
        $this->gameRepository = $gameRepository;
        $this->playerRepository = $playerRepository;
        $this->seasonRepository = $seasonRepository;
    }

    /**
     * This is the default "index" action of the controller. It displays the 
     * Home page.
     */
    public function generateGamesAction() {
        $success = true;
        $errorMessage = '';
        $competitionId = $this->getRequest()->getPost('competitionId');
        if (empty($competitionId)) {
            $success = false;
            $errorMessage = 'No competition id';
        }
        $competition = $this->repository->getItem($competitionId);
        if (empty($competition)) {
            $success = false;
            $errorMessage = 'No competition found';
        }
        $seasonId = $this->getRequest()->getPost('seasonId');
        if (empty($seasonId)) {
            $success = false;
            $errorMessage = 'No season id';
        }
        $season = $this->seasonRepository->getItem($seasonId);
        if (empty($season)) {
            $success = false;
            $errorMessage = 'No season found';
        }

        $gamesForDisplay = [];
        if ($success) {
            $games = [];
            $players = $this->repository->getPlayersIds($competitionId);
            $playersTemp = array_values($players);
            foreach (array_values($players) as $player) {
                if ($competition->getAwayHomeGame() == 1) {
                    $playersTemp = array_values($players);
                }

                if (($key = array_search($player, $players)) !== false) {
                    unset($playersTemp[$key]);
                }
                foreach ($playersTemp as $playerForArray) {
                    $games[][$player] = $playerForArray;
                }
            }
            shuffle($games);
            foreach ($games as $index => $game) {
                foreach ($game as $homeTeam => $awayTeam) {
                    $game = $this->gameRepository->newItem();
                    $game->setCompetition($competition);
                    $game->setSeason($season);
                    $homePlayer = $this->playerRepository->getItem($homeTeam);
                    $game->setHomePlayer($homePlayer);
                    $awayPlayer = $this->playerRepository->getItem($awayTeam);
                    $game->setAwayPlayer($awayPlayer);

                    $this->gameRepository->saveItem($game);
                    $gamesForDisplay[$index]['competitionid'] = $competition->getId();
                    $gamesForDisplay[$index]['gameid'] = $game->getId();
                    $gamesForDisplay[$index]['homeplayer'] = $homePlayer->getFullName();
                    $gamesForDisplay[$index]['awayplayer'] = $awayPlayer->getFullName();
                }
            }
        }
        return new JsonModel(
                array(
            'success' => $success,
            'errorMessage' => $errorMessage,
            'games' => $gamesForDisplay
                )
        );
    }

}
