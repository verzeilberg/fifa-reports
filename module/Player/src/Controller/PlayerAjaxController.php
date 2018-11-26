<?php

namespace Player\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\JsonModel;

/**
 * This is the main controller class of the User Demo application. It contains
 * site-wide actions such as Home or About.
 */
class PlayerAjaxController extends AbstractActionController {

    protected $vhm;
    protected $repository;
    protected $competitionRepository;

    public function __construct($vhm, $repository, $competitionRepository) {
        $this->vhm = $vhm;
        $this->repository = $repository;
        $this->competitionRepository = $competitionRepository;
    }

    /**
     * This is the default "index" action of the controller. It displays the 
     * Home page.
     */
    public function setCompetitionAction() {
        $success = true;
        $errorMessage = '';
        if ($this->getRequest()->isPost()) {
            $playerId = $this->getRequest()->getPost('playerId');
            if (empty($playerId)) {
                $success = false;
                $errorMessage = 'No player id';
            }
            $player = $this->repository->getItem($playerId);
            if (empty($player)) {
                $success = false;
                $errorMessage = 'No player found';
            }
            $competitionId = $this->getRequest()->getPost('competitionId');
            if (empty($competitionId)) {
                $success = false;
                $errorMessage = 'No competition id';
            }
            $competition = $this->competitionRepository->getItem($competitionId);
            if (empty($competition)) {
                $success = false;
                $errorMessage = 'No competition found';
            }

            $player->setCompetition($competition);
            $this->repository->saveItem($player);
            $success = true;
            $errorMessage = '';
        }

        return new JsonModel(
                array(
            'success' => $success,
            'errorMessage' => $errorMessage
                )
        );
    }

}
