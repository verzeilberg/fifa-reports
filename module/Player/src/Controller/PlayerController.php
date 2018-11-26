<?php

namespace Player\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

/**
 * This is the main controller class of the User Demo application. It contains
 * site-wide actions such as Home or About.
 */
class PlayerController extends AbstractActionController {

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
    public function indexAction() {
        $players = $this->repository->getItems();

        $searchString = '';
        if ($this->getRequest()->isPost()) {
            $searchString = $this->getRequest()->getPost('search');
            $players = $this->repository->searchItems($searchString);
        }

        return new ViewModel(
                array(
            'players' => $players,
            'searchString' => $searchString
                )
        );
    }

    public function addAction() {
        $player = $this->repository->newItem();
        $form = $this->repository->createForm($player);
        if ($this->getRequest()->isPost()) {
            $form->setData($this->getRequest()->getPost());

            if ($form->isValid()) {
                //Save Item
                $this->repository->saveItem($player);

                return $this->redirect()->toRoute('players');
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
        if (empty($id)) {
            return $this->redirect()->toRoute('players');
        }
        $player = $this->repository->getItem($id);
        
        if (empty($player)) {
            return $this->redirect()->toRoute('players');
        }
        $form = $this->repository->createForm($player);

        if ($this->getRequest()->isPost()) {
            $form->setData($this->getRequest()->getPost());

            if ($form->isValid()) {
                //Save Item
                $this->repository->saveItem($player);

                return $this->redirect()->toRoute('players');
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
     * Action to delete the customer from the database
     */
    public function deleteAction() {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (empty($id)) {
            return $this->redirect()->toRoute('players');
        }
        $player = $this->repository->getItem($id);
        if (empty($player)) {
            return $this->redirect()->toRoute('players');
        }

        $this->repository->deleteItem($player);
        $this->flashMessenger()->addSuccessMessage('Item removed');
        return $this->redirect()->toRoute('players');
    }

}
