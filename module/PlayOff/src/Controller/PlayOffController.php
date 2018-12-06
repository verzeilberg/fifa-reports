<?php

namespace PlayOff\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

/**
 * This is the main controller class of the User Demo application. It contains
 * site-wide actions such as Home or About.
 */
class PlayOffController extends AbstractActionController {

    protected $vhm;
    protected $repository;
    protected $playerRepository;

    public function __construct($vhm, $repository, $playerRepository) {
        $this->vhm = $vhm;
        $this->repository = $repository;
        $this->playerRepository = $playerRepository;
    }

    /**
     * This is the default "index" action of the controller. It displays the 
     * Home page.
     */
    public function indexAction() {
        $playOffs = $this->repository->getItems();

        $searchString = '';
        if ($this->getRequest()->isPost()) {
            $searchString = $this->getRequest()->getPost('search');
            $playOffs = $this->repository->searchItems($searchString);
        }
        return new ViewModel(
                array(
            'playOffs' => $playOffs,
            'searchString' => $searchString
                )
        );
    }
    
    public function addAction() {
        $this->vhm->get('headScript')->appendFile('/js/play-off.js');
        $playOff = $this->repository->newItem();
        $form = $this->repository->createForm($playOff);
        if ($this->getRequest()->isPost()) {
            $form->setData($this->getRequest()->getPost());

            if ($form->isValid()) { 
                //Save Item
                $this->repository->saveItem($playOff);

                return $this->redirect()->toRoute('playoffs');
            }
        }
        return new ViewModel(
                array(
            'form' => $form
                )
        );
    }

    public function editAction() {
        $this->vhm->get('headScript')->appendFile('/js/play-off.js');
        $id = (int) $this->params()->fromRoute('id', 0);
        if (empty($id)) {
            return $this->redirect()->toRoute('playoffs');
        }
        $playOff = $this->repository->getItem($id);
        if (empty($playOff)) {
            return $this->redirect()->toRoute('playoffs');
        }
        $form = $this->repository->createForm($playOff);

        if ($this->getRequest()->isPost()) {
            $form->setData($this->getRequest()->getPost());

            if ($form->isValid()) {
                
                if(empty($this->getRequest()->getPost('competitions'))) {
                    $playOff->removeAllCompetitions();
                }
                
                //Save Item
                $this->repository->saveItem($playOff);

                return $this->redirect()->toRoute('playoffs');
            }
        }

        return new ViewModel(
                array(
            'form' => $form
                )
        );
    }
    
    /**
     * 
     * Action to delete the playoff from the database
     */
    public function deleteAction() {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (empty($id)) {
            return $this->redirect()->toRoute('playoffs');
        }
        $playOff = $this->repository->getItem($id);
        if (empty($playOff)) {
            return $this->redirect()->toRoute('playoffs');
        }

        $this->repository->deleteItem($playOff);
        $this->flashMessenger()->addSuccessMessage('Item removed');
        return $this->redirect()->toRoute('playoffs');
    }

}
