<?php

namespace Game\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

/**
 * This is the main controller class of the User Demo application. It contains
 * site-wide actions such as Home or About.
 */
class GameController extends AbstractActionController {

    protected $vhm;
    protected $repository;
    protected $resultRepository;

    public function __construct($vhm, $repository, $resultRepository) {
        $this->vhm = $vhm;
        $this->repository = $repository;
        $this->resultRepository = $resultRepository;
    }

    /**
     * This is the default "index" action of the controller. It displays the 
     * Home page.
     */
    public function indexAction() {
        $games = $this->repository->getItems();

        $searchString = '';
        if ($this->getRequest()->isPost()) {
            $searchString = $this->getRequest()->getPost('search');
            $games = $this->repository->searchItems($searchString);
        }

        return new ViewModel(
                array(
            'games' => $games,
            'searchString' => $searchString
                )
        );
    }

    public function addAction() {
        $this->vhm->get('headScript')->appendFile('/js/game.js');
        $game = $this->repository->newItem();
        $form = $this->repository->createForm($game);
        if ($this->getRequest()->isPost()) {
            $form->setData($this->getRequest()->getPost());

            if ($form->isValid()) {
                //Save Item
                $this->repository->saveItem($game);

                return $this->redirect()->toRoute('games');
            }
        }
        return new ViewModel(
                array(
            'form' => $form
                )
        );
    }

    public function editAction() {
        $id = (int) $this->params()->fromRoute('id', 0);
        $competitionId = (int) $this->params()->fromRoute('competitionid', 0);
        if (empty($competitionId)) {
            return $this->redirect()->toRoute('competitions');
        }
        if (empty($id)) {
            return $this->redirect()->toRoute('competitions', array('action' => 'show', 'id' => $competitionId));
        }
        $game = $this->repository->getItem($id);
        if (empty($game)) {
            return $this->redirect()->toRoute('competitions', array('action' => 'show', 'id' => $competitionId));
        }
        $form = $this->repository->createForm($game);
        $season = $game->getSeason();
        if ($this->getRequest()->isPost()) {
            $form->setData($this->getRequest()->getPost());

            if ($form->isValid()) {
                //Save Item
                $this->repository->saveItem($game);

                return $this->redirect()->toRoute('competitions', array('action' => 'show', 'id' => $competitionId));
            }
        }

        return new ViewModel(
                array(
            'game' => $game,
            'season' => $season,
            'form' => $form
                )
        );
    }

    public function editStatsAction() {
        $this->vhm->get('headScript')->appendFile('/js/game.js');
        $id = (int) $this->params()->fromRoute('id', 0);
        $competitionId = (int) $this->params()->fromRoute('competitionid', 0);
        if (empty($competitionId)) {
            return $this->redirect()->toRoute('competitions');
        }
        if (empty($id)) {
            return $this->redirect()->toRoute('competitions', array('action' => 'show', 'id' => $competitionId));
        }
        $game = $this->repository->getItem($id);
        if (empty($game)) {
            return $this->redirect()->toRoute('competitions', array('action' => 'show', 'id' => $competitionId));
        }
        $form = $this->repository->createForm($game);
        
        if(is_object($game->getHomeGameResult())){
            $homeGameResult = $game->getHomeGameResult();
        } else {
            $homeGameResult = $this->resultRepository->newHomeItem();
        }
        
        $formHomeGameResult = $this->resultRepository->createHomeForm($homeGameResult);
        
        if(is_object($game->getAwayGameResult())){
            $awayGameResult = $game->getAwayGameResult();
        } else {
            $awayGameResult = $this->resultRepository->newAwayItem();
        }
        $formAwayGameResult = $this->resultRepository->createAwayForm($awayGameResult);
        
        $season = $game->getSeason();
        if ($this->getRequest()->isPost()) {
            
            $data = $this->getRequest()->getPost();
            
            if ($data['goalsH'] == $data['goalsA']) {
                $data['pointsH'] = 1;
                $data['pointsA'] = 1;
            } else if ($data['goalsH'] > $data['goalsA']) {
                $data['pointsH'] = 3;
                $data['pointsA'] = 0;
            } else if ($data['goalsH'] < $data['goalsA']) {
                $data['pointsH'] = 0;
                $data['pointsA'] = 3;
            }
            
            $form->setData($data);
            $formHomeGameResult->setData($data);
            $formAwayGameResult->setData($data);
            
            if ($form->isValid() && $formHomeGameResult->isValid() && $formAwayGameResult->isValid()) {
                //Save Items
                $this->repository->saveItem($game);
                $homeGameResult->setGame($game);
                $homeGameResult->setPlayer($game->getHomePlayer());
                $homeGameResult->setSeason($game->getSeason());
                $homeGameResult->setCompetition($game->getCompetition());
                $this->resultRepository->saveItem($homeGameResult);
                
                $awayGameResult->setGame($game);
                $awayGameResult->setPlayer($game->getAwayPlayer());
                $awayGameResult->setSeason($game->getSeason());
                $awayGameResult->setCompetition($game->getCompetition());
                $this->resultRepository->saveItem($awayGameResult);
                return $this->redirect()->toRoute('competitions', array('action' => 'show', 'id' => $competitionId));
            }
        }

        return new ViewModel(
                array(
            'game' => $game,
            'season' => $season,
            'form' => $form,
            'formHomeGameResult' => $formHomeGameResult,
            'formAwayGameResult' => $formAwayGameResult
                )
        );
    }

    /**
     * 
     * Action to delete the customer from the database
     */
    public function deleteAction() {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (empty($id)) {
            return $this->redirect()->toRoute('games');
        }
        $game = $this->repository->getItem($id);
        if (empty($game)) {
            return $this->redirect()->toRoute('games');
        }

        $this->repository->deleteItem($game);
        $this->flashMessenger()->addSuccessMessage('Item removed');
        return $this->redirect()->toRoute('games');
    }

}
