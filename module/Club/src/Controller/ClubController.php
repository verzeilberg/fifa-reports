<?php

namespace Club\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

/**
 * This is the main controller class of the User Demo application. It contains
 * site-wide actions such as Home or About.
 */
class ClubController extends AbstractActionController {

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
        $clubs = $this->repository->getItems();

        $searchString = '';
        if ($this->getRequest()->isPost()) {
            $searchString = $this->getRequest()->getPost('search');
            $clubs = $this->repository->searchItems($searchString);
        }

        return new ViewModel(
                array(
            'customers' => $clubs,
            'searchString' => $searchString
                )
        );
    }

}
