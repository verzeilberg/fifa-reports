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

        if (is_object($game->getHomeResult())) {
            $resultHome = $game->getHomeResult();
        } else {
            $resultHome = $this->resultRepository->newItem();
        }
        $formHome = $this->resultRepository->createForm($resultHome);
        if (is_object($game->getAwayResult())) {
            $resultAway = $game->getAwayResult();
        } else {
            $resultAway = $this->resultRepository->newItem();
        }
        $formAway = $this->resultRepository->createForm($resultAway);
        $season = $game->getSeason();
        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getPost();
            $formHome->setData($data['homeForm']);
            $formAway->setData($data['awayForm']);

            // Home form
            foreach ($data['homeForm'] as $index => $item) {
                $functionName = 'set' . lcfirst($index);
                $item = (empty($item) ? 0 : $item);
                $resultHome->$functionName($item);
            }
            $resultHome->setHomeAway('H');
            $resultHome->setPlayer($game->getHomePlayer());
            $resultHome->setSeason($game->getSeason());
            $resultHome->setCompetition($game->getCompetition());
            $this->resultRepository->saveItem($resultHome);
            $game->setHomeResult($resultHome);
            $this->repository->saveItem($game);
            //Away form
            foreach ($data['awayForm'] as $index => $item) {
                $functionName = 'set' . lcfirst($index);
                $item = (empty($item) ? 0 : $item);
                $resultAway->$functionName($item);
            }
            $resultAway->setHomeAway('A');
            $resultAway->setPlayer($game->getAwayPlayer());
            $resultAway->setSeason($game->getSeason());
            $resultAway->setCompetition($game->getCompetition());
            $this->resultRepository->saveItem($resultAway);
            $game->setAwayResult($resultAway);
            $this->repository->saveItem($game);

            return $this->redirect()->toRoute('competitions', array('action' => 'show', 'id' => $game->getCompetition()->getId()));
        }

        return new ViewModel(
                array(
            'game' => $game,
            'season' => $season,
            'formHome' => $formHome,
            'formAway' => $formAway
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
