<?php

namespace Competition\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

/**
 * This is the main controller class of the User Demo application. It contains
 * site-wide actions such as Home or About.
 */
class CompetitionController extends AbstractActionController {

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
        $competitions = $this->repository->getItems();

        $searchString = '';
        if ($this->getRequest()->isPost()) {
            $searchString = $this->getRequest()->getPost('search');
            $competitions = $this->repository->searchItems($searchString);
        }

        return new ViewModel(
                array(
            'competitions' => $competitions,
            'searchString' => $searchString
                )
        );
    }

    public function addAction() {
        $this->vhm->get('headScript')->appendFile('/js/competition.js');
        $competition = $this->repository->newItem();
        $form = $this->repository->createForm($competition);
        if ($this->getRequest()->isPost()) {
            $form->setData($this->getRequest()->getPost());

            if ($form->isValid()) {
                //Save Item
                $this->repository->saveItem($competition);

                return $this->redirect()->toRoute('competitions');
            }
        }
        return new ViewModel(
                array(
            'form' => $form
                )
        );
    }

    public function editAction() {
        $this->vhm->get('headScript')->appendFile('/js/competition.js');
        $id = (int) $this->params()->fromRoute('id', 0);
        if (empty($id)) {
            return $this->redirect()->toRoute('competitions');
        }
        $competition = $this->repository->getItem($id);
        if (empty($competition)) {
            return $this->redirect()->toRoute('competitions');
        }
        $form = $this->repository->createForm($competition);

        if ($this->getRequest()->isPost()) {
            $form->setData($this->getRequest()->getPost());

            if ($form->isValid()) {
                //Save Item
                $this->repository->saveItem($competition);

                return $this->redirect()->toRoute('competitions');
            }
        }

        return new ViewModel(
                array(
            'form' => $form
                )
        );
    }

    public function showAction() {
        $this->vhm->get('headScript')->appendFile('/js/competition.js');
        $id = (int) $this->params()->fromRoute('id', 0);
        if (empty($id)) {
            return $this->redirect()->toRoute('competitions');
        }
        $competition = $this->repository->getItem($id);
        if (empty($competition)) {
            return $this->redirect()->toRoute('competitions');
        }
        
        $results = $this->resultRepository->getResultsBySeason(1);
        
        return new ViewModel(
                array(
                'competition' => $competition,
                'results' => $results
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
            return $this->redirect()->toRoute('competitions');
        }
        $competition = $this->repository->getItem($id);
        if (empty($competition)) {
            return $this->redirect()->toRoute('competitions');
        }

        $this->repository->deleteItem($competition);
        $this->flashMessenger()->addSuccessMessage('Item removed');
        return $this->redirect()->toRoute('competitions');
    }

}
