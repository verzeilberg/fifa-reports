<?php

namespace PlayOff\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\JsonModel;

/**
 * This is the main controller class of the User Demo application. It contains
 * site-wide actions such as Home or About.
 */
class PlayOffAjaxController extends AbstractActionController
{

    protected $vhm;
    protected $repository;
    protected $seasonRepository;
    protected $playOffTypeRepository;

    public function __construct($vhm, $repository, $seasonRepository, $playOffTypeRepository)
    {
        $this->vhm = $vhm;
        $this->repository = $repository;
        $this->seasonRepository = $seasonRepository;
        $this->playOffTypeRepository = $playOffTypeRepository;
    }

    /**
     * This is the default "index" action of the controller. It displays the
     * Home page.
     */
    public function addAction()
    {
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
            $playOffTypeId = $this->getRequest()->getPost('playOffTypeId');
            if (empty($playOffTypeId)) {
                $success = false;
                $errorMessage = 'No play off type id';
            }
            $playOffType = $this->playOffTypeRepository->getItem($playOffTypeId);
            if (empty($playOffType)) {
                $success = false;
                $errorMessage = 'No play off type found';
            }

            $playOffName = $season->getName() . ' ' . $playOffType->getName() . ' ' . $season->getEndDate()->format('Y');

            $playOff = $this->repository->newItem();
            $playOff->setPlayOffType($playOffType);
            $playOff->setSeason($season);
            $playOff->setName($playOffName);
            $this->repository->saveItem($playOff);


            $success = true;
            $errorMessage = '';
        }

        return new JsonModel(
            array(
                'success' => $success,
                'errorMessage' => $errorMessage,
                'playOff' => $playOff
            )
        );
    }

}
