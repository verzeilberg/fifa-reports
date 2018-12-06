<?php

namespace Season\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

/**
 * This is the main controller class of the User Demo application. It contains
 * site-wide actions such as Home or About.
 */
class SeasonController extends AbstractActionController
{

    protected $vhm;
    protected $repository;
    protected $playerRepository;

    public function __construct($vhm, $repository, $playerRepository)
    {
        $this->vhm = $vhm;
        $this->repository = $repository;
        $this->playerRepository = $playerRepository;
    }

    /**
     * This is the default "index" action of the controller. It displays the
     * Home page.
     */
    public function indexAction()
    {
        $seasons = $this->repository->getItems();

        $searchString = '';
        if ($this->getRequest()->isPost()) {
            $searchString = $this->getRequest()->getPost('search');
            $seasons = $this->repository->searchItems($searchString);
        }
        return new ViewModel(
            array(
                'seasons' => $seasons,
                'searchString' => $searchString
            )
        );
    }

    public function addAction()
    {
        $this->vhm->get('headScript')->appendFile('/js/season.js');
        $season = $this->repository->newItem();
        $form = $this->repository->createForm($season);
        if ($this->getRequest()->isPost()) {
            $form->setData($this->getRequest()->getPost());

            if ($form->isValid()) {
                //Save Item
                $this->repository->saveItem($season);

                return $this->redirect()->toRoute('seasons');
            }
        }
        return new ViewModel(
            array(
                'form' => $form
            )
        );
    }

    public function editAction()
    {
        $this->vhm->get('headScript')->appendFile('/js/season.js');
        $id = (int)$this->params()->fromRoute('id', 0);
        if (empty($id)) {
            return $this->redirect()->toRoute('seasons');
        }
        $season = $this->repository->getItem($id);
        if (empty($season)) {
            return $this->redirect()->toRoute('seasons');
        }
        $form = $this->repository->createForm($season);

        if ($this->getRequest()->isPost()) {
            $form->setData($this->getRequest()->getPost());

            if ($form->isValid()) {

                if (empty($this->getRequest()->getPost('competitions'))) {
                    $season->removeAllCompetitions();
                }

                //Save Item
                $this->repository->saveItem($season);

                return $this->redirect()->toRoute('seasons');
            }
        }

        return new ViewModel(
            array(
                'form' => $form
            )
        );
    }

    public function showAction()
    {
        $id = (int)$this->params()->fromRoute('id', 0);
        if (empty($id)) {
            return $this->redirect()->toRoute('seasons');
        }
        $season = $this->repository->getItem($id);
        if (empty($season)) {
            return $this->redirect()->toRoute('seasons');
        }

        $players = $this->playerRepository->getUnCompetitionItems();

        return new ViewModel(
            array(
                'season' => $season,
                'players' => $players
            )
        );
    }

    public function gamesAction()
    {
        $this->vhm->get('headScript')->appendFile('/js/season.js');
        $id = (int)$this->params()->fromRoute('id', 0);
        if (empty($id)) {
            return $this->redirect()->toRoute('seasons');
        }
        $season = $this->repository->getItem($id);
        if (empty($season)) {
            return $this->redirect()->toRoute('seasons');
        }

        $games = $season->getGames();

        return new ViewModel(
            array(
                'season' => $season,
                'games' => $games
            )
        );
    }

    /**
     *
     * Action to manage playoffs
     */
    public function playOffsAction()
    {

        $this->vhm->get('headScript')->appendFile('/js/season.js');
        $id = (int)$this->params()->fromRoute('id', 0);
        if (empty($id)) {
            return $this->redirect()->toRoute('seasons');
        }
        $season = $this->repository->getItem($id);
        if (empty($season)) {
            return $this->redirect()->toRoute('seasons');
        }

        return new ViewModel(
            array(
                'season' => $season
            )
        );
    }

    /**
     *
     * Action to delete the customer from the database
     */
    public function deleteAction()
    {
        $id = (int)$this->params()->fromRoute('id', 0);
        if (empty($id)) {
            return $this->redirect()->toRoute('seasons');
        }
        $season = $this->repository->getItem($id);
        if (empty($season)) {
            return $this->redirect()->toRoute('seasons');
        }

        $this->repository->deleteItem($season);
        $this->flashMessenger()->addSuccessMessage('Item removed');
        return $this->redirect()->toRoute('seasons');
    }

}
