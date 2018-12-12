<?php

namespace Player\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Session\Container;

/**
 * This is the main controller class of the User Demo application. It contains
 * site-wide actions such as Home or About.
 */
class PlayerController extends AbstractActionController
{

    protected $vhm;
    protected $repository;
    protected $cropImageService;
    protected $imageService;

    public function __construct($vhm, $repository, $cropImageService, $imageService)
    {
        $this->vhm = $vhm;
        $this->repository = $repository;
        $this->cropImageService = $cropImageService;
        $this->imageService = $imageService;
    }

    /**
     * This is the default "index" action of the controller. It displays the
     * Home page.
     */
    public function indexAction()
    {
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

    public function addAction()
    {
        //Include css and js for image upload
        $this->vhm->get('headScript')->appendFile('/js/upload-files.js');
        $this->vhm->get('headLink')->appendStylesheet('/css/upload-image.css');
        //Create session container for crop images
        $container = new Container('cropImages');
        $container->getManager()->getStorage()->clear('cropImages');

        //Create Player entity and form
        $player = $this->repository->newItem();
        $form = $this->repository->createForm($player);
        //Create new image object and form for image
        $image = $this->imageService->createImage();
        $formImage = $this->imageService->createImageForm($image);

        if ($this->getRequest()->isPost()) {
            $form->setData($this->getRequest()->getPost());
            //Set form image data
            $formImage->setData($this->getRequest()->getPost());

            if ($form->isValid() && $formImage->isValid()) {

                //Create image array and set it
                $imageFile = [];
                $imageFile = $this->getRequest()->getFiles('image');
                //Upload image
                if ($imageFile['error'] === 0) {
                    //Upload original file
                    $imageFiles = $this->cropImageService->uploadImage($imageFile, 'player', 'original', $image, 1);

                    if (is_array($imageFiles)) {
                        $folderOriginal = $imageFiles['imageType']->getFolder();
                        $fileName = $imageFiles['imageType']->getFileName();
                        $image = $imageFiles['image'];
                        //Upload thumb 150x100
                        $imageFiles = $this->cropImageService->resizeAndCropImage('public/' . $folderOriginal . $fileName, 'public/img/userFiles/players/thumb/', 150, 100, '150x100', $image);
                        //Create 400x400  crop
                        $imageFiles = $this->cropImageService->createCropArray('400x400', $folderOriginal, $fileName, 'public/img/userFiles/players/400x400/', 400, 400, $image);
                        $image = $imageFiles['image'];
                        $cropImages = $imageFiles['cropImages'];
                        //Create return URL
                        $returnURL = $this->cropImageService->createReturnURL('players', 'index');

                        //Create session container for crop
                        $this->cropImageService->createContainerImages($cropImages, $returnURL);

                        //Save image
                        $this->imageService->saveImage($image);
                        //Add image to player
                        $player->setPlayerImage($image);
                    } else {
                        $this->flashMessenger()->addErrorMessage($imageFiles);
                    }
                } else {
                    $this->flashMessenger()->addErrorMessage('Image not uploaded');
                }
                //End upload image
                //Save Item
                $this->repository->saveItem($player);

                if ($imageFile['error'] === 0 && is_array($imageFiles)) {
                    return $this->redirect()->toRoute('images', array('action' => 'crop'));
                } else {
                    return $this->redirect()->toRoute('players');
                }
            }
        }
        return new ViewModel(
            array(
                'form' => $form,
                'formImage' => $formImage
            )
        );
    }

    public function editAction()
    {
        //Include css and js for image upload
        $this->vhm->get('headScript')->appendFile('/js/upload-images.js');
        $this->vhm->get('headLink')->appendStylesheet('/css/upload-image.css');
        //Create session container for crop images
        $container = new Container('cropImages');
        $container->getManager()->getStorage()->clear('cropImages');

        $id = (int)$this->params()->fromRoute('id', 0);
        if (empty($id)) {
            return $this->redirect()->toRoute('players');
        }
        $player = $this->repository->getItem($id);

        if (empty($player)) {
            return $this->redirect()->toRoute('players');
        }
        $form = $this->repository->createForm($player);
        $image = $this->imageService->createImage();
        $formImage = $this->imageService->createImageForm($image);

        if ($this->getRequest()->isPost()) {
            $form->setData($this->getRequest()->getPost());
            $formImage->setData($this->getRequest()->getPost());

            if ($form->isValid() && $formImage->isValid()) {

                //Create image array and set it
                $imageFile = [];
                $imageFile = $this->getRequest()->getFiles('image');
                //Upload image
                if ($imageFile['error'] === 0) {
                    //Upload original file
                    $imageFiles = $this->cropImageService->uploadImage($imageFile, 'player', 'original', $image, 1);
                    if (is_array($imageFiles)) {
                        $folderOriginal = $imageFiles['imageType']->getFolder();
                        $fileName = $imageFiles['imageType']->getFileName();
                        $image = $imageFiles['image'];
                        //Upload thumb 150x100
                        $imageFiles = $this->cropImageService->resizeAndCropImage('public/' . $folderOriginal . $fileName, 'public/img/userFiles/players/thumb/', 150, 100, '150x100', $image);
                        //Create 450x300 crop
                        $imageFiles = $this->cropImageService->createCropArray('400x400', $folderOriginal, $fileName, 'public/img/userFiles/players/400x400/', 400, 400, $image);
                        $image = $imageFiles['image'];
                        $cropImages = $imageFiles['cropImages'];
                        //Create return URL
                        $returnURL = $this->cropImageService->createReturnURL('players', 'index');

                        //Create session container for crop
                        $this->cropImageService->createContainerImages($cropImages, $returnURL);

                        //Save blog image
                        $this->imageService->saveImage($image);
                        //Add image to player
                        $player->setPlayerImage($image);
                    } else {
                        $this->flashMessenger()->addErrorMessage($imageFiles);
                    }
                } else {
                    $this->flashMessenger()->addErrorMessage('Image not uploaded');
                }
                //End upload image

                //Save Item
                $this->repository->saveItem($player);

                if ($imageFile['error'] === 0 && is_array($imageFiles)) {
                    return $this->redirect()->toRoute('images', array('action' => 'crop'));
                } else {
                    return $this->redirect()->toRoute('players');
                }
            }
        }

        $returnURL = $this->cropImageService->createReturnURL('players', 'edit', $id);

        return new ViewModel(
            array(
                'form' => $form,
                'formImage' => $formImage,
                'image' => $player->getPLayerImage(),
                'returnURL' => $returnURL
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

    public function editPlayerAction() {
        $this->vhm->get('headScript')->appendFile('/js/upload-images.js');
        $this->vhm->get('headLink')->appendStylesheet('/css/upload-image.css');

        $id = $this->params()->fromRoute('id');
        if ($id == null) {
            $this->getResponse()->setStatusCode(404);
            return;
        }

        $player = $this->repository->getItem($id);
        if ($player == null) {
            $this->getResponse()->setStatusCode(404);
            return;
        }

        $user = $player->getUser();
        if($user->getId() != $this->currentUser()->getId()) {
            $this->getResponse()->setStatusCode(404);
            return;
        }

        $form = $this->repository->createForm($player);
        $image = $this->imageService->createImage();
        $formImage = $this->imageService->createImageForm($image);

        if ($this->getRequest()->isPost()) {
            $form->setData($this->getRequest()->getPost());
            $formImage->setData($this->getRequest()->getPost());

            if ($form->isValid() && $formImage->isValid()) {

                //Create image array and set it
                $imageFile = [];
                $imageFile = $this->getRequest()->getFiles('image');
                if($imageFile['size'] !== 0) {
                    //Upload image
                    if ($imageFile['error'] === 0) {
                        //Upload original file
                        $imageFiles = $this->cropImageService->uploadImage($imageFile, 'player', 'original', $image, 1);
                        if (is_array($imageFiles)) {
                            $folderOriginal = $imageFiles['imageType']->getFolder();
                            $fileName = $imageFiles['imageType']->getFileName();
                            $image = $imageFiles['image'];
                            //Upload thumb 150x100
                            $imageFiles = $this->cropImageService->resizeAndCropImage('public/' . $folderOriginal . $fileName, 'public/img/userFiles/players/thumb/', 150, 100, '150x100', $image);
                            //Create 450x300 crop
                            $imageFiles = $this->cropImageService->createCropArray('400x400', $folderOriginal, $fileName, 'public/img/userFiles/players/400x400/', 400, 400, $image);
                            $image = $imageFiles['image'];
                            $cropImages = $imageFiles['cropImages'];
                            //Create return URL
                            $returnURL = $this->cropImageService->createReturnURL('players', 'edit-player', $id);

                            //Create session container for crop
                            $this->cropImageService->createContainerImages($cropImages, $returnURL);

                            //Save blog image
                            $this->imageService->saveImage($image);
                            //Add image to player
                            $player->setPlayerImage($image);
                        } else {
                            $this->flashMessenger()->addErrorMessage($imageFiles);
                        }
                    } else {
                        $this->flashMessenger()->addErrorMessage('Image not uploaded');
                    }
                }
                //End upload image

                //Save Item
                $this->repository->saveItem($player);

                if ($imageFile['error'] === 0 && is_array($imageFiles)) {
                    return $this->redirect()->toRoute('images', array('action' => 'crop'));
                } else {
                    return $this->redirect()->toRoute('players', ['action' => 'edit-player', 'id' => $id]);
                }
            }
        }

        $returnURL = $this->cropImageService->createReturnURL('players', 'edit-player', $id);


        return new ViewModel([
            'player' => $player,
            'form' => $form,
            'formImage' => $formImage,
            'image' => $player->getPLayerImage(),
            'returnURL' => $returnURL
        ]);

    }

}
