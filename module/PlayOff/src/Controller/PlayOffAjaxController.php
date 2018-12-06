<?php

namespace PlayOff\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\JsonModel;

/**
 * This is the main controller class of the User Demo application. It contains
 * site-wide actions such as Home or About.
 */
class PlayOffAjaxController extends AbstractActionController {

    protected $vhm;
    protected $repository;
    protected $seasonRepository;

    public function __construct($vhm, $repository, $seasonRepository) {
        $this->vhm = $vhm;
        $this->repository = $repository;
        $this->seasonRepository = $seasonRepository;
    }

    /**
     * This is the default "index" action of the controller. It displays the 
     * Home page.
     */
    public function addAction() {
        $success = true;
        $errorMessage = '';
        if ($this->getRequest()->isPost()) {
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

            $playOff = $this->repository->newItem();
            $playOff->setSeason($season);
            $this->repository->saveItem($playOff);


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
