<?php

namespace Game\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\JsonModel;

/**
 * This is the main controller class of the User Demo application. It contains
 * site-wide actions such as Home or About.
 */
class GameAjaxController extends AbstractActionController {

    protected $vhm;
    protected $repository;

    public function __construct($vhm, $repository) {
        $this->vhm = $vhm;
        $this->repository = $repository;
    }

    /**
     * This is the default "index" action of the controller. It displays the 
     * Home page.
     */
    public function setPlayDateAction() {
        $success = true;
        $errorMessage = '';
        if ($this->getRequest()->isPost()) {
            $gameId = $this->getRequest()->getPost('gameId');
            if (empty($gameId)) {
                $success = false;
                $errorMessage = 'No game id';
            }
            $game = $this->repository->getItem($gameId);
            if (empty($game)) {
                $success = false;
                $errorMessage = 'No game found';
            }
            $playDate = $this->getRequest()->getPost('playDate');
            if (empty($playDate)) {
                $success = false;
                $errorMessage = 'No play date selected found';
            } else {

                $timeStamp = strtotime($playDate);

                if ($timeStamp !== false) {

                    $dt = new \DateTime();
                    $dt->setTimestamp($timeStamp);

                    $game->setPlayDate($dt);
                    $this->repository->saveItem($game);
                    $success = true;
                    $errorMessage = '';
                } else {
                   $success = false;
                $errorMessage = 'Play date is not a date'; 
                }
            }
        }

        return new JsonModel(
                array(
            'success' => $success,
            'errorMessage' => $errorMessage
                )
        );
    }

    public function setSortOrderAction() {
        $success = true;
        $errorMessage = '';
        if ($this->getRequest()->isPost()) {
            $gameSortOrders = $this->getRequest()->getPost('gameSortOrders');

            if(count($gameSortOrders) > 0) {
                foreach ($gameSortOrders as $sortOrder => $gameId) {

                    if($sortOrder == 0) continue;

                    $game = $this->repository->getItem($gameId);
                    $game->setSortOrder($sortOrder);
                    $this->repository->saveItem($game);

                }

                $success = true;
                $errorMessage = '';

            } else {
                $success = false;
                $errorMessage = 'No games found';
            }
        }

        return new JsonModel(
            array(
                'success' => $success,
                'errorMessage' => $errorMessage
            )
        );
    }

}
