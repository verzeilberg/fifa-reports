<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use User\Entity\User;

/**
 * This is the main controller class of the User Demo application. It contains
 * site-wide actions such as Home or About.
 */
class IndexController extends AbstractActionController {

    /**
     * Entity manager.
     * @var Doctrine\ORM\EntityManager
     */
    private $seasonRepository;

    /**
     * Constructor. Its purpose is to inject dependencies into the controller.
     */
    public function __construct($seasonRepository) {
        $this->seasonRepository = $seasonRepository;
    }

    /**
     * This is the default "index" action of the controller. It displays the 
     * Home page.
     */
    public function indexAction() {
        $this->layout('layout/home');
        
        $season = $this->seasonRepository->getItem(1);
        
        
        return new ViewModel([
            'season' => $season
        ]);
    }

    public function rulesAction() {
        return new ViewModel();
    }

    /**
     * The "settings" action displays the info about currently logged in user.
     */
    public function settingsAction() {
        $id = $this->params()->fromRoute('id');

        if ($id != null) {
            $user = $this->entityManager->getRepository(User::class)
                    ->find($id);
        } else {
            $user = $this->currentUser();
        }

        if ($user == null) {
            $this->getResponse()->setStatusCode(404);
            return;
        }

        if (!$this->access('profile.any.view') &&
                !$this->access('profile.own.view', ['user' => $user])) {
            return $this->redirect()->toRoute('not-authorized');
        }

        return new ViewModel([
            'user' => $user
        ]);
    }

}
