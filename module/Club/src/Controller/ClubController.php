<?php

namespace Club\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Session\Container;

/**
 * This is the main controller class of the User Demo application. It contains
 * site-wide actions such as Home or About.
 */
class ClubController extends AbstractActionController {

    protected $vhm;
    protected $repository;
    protected $cropImageService;
    protected $imageService;

    public function __construct($vhm, $repository, $cropImageService, $imageService) {
        $this->vhm = $vhm;
        $this->repository = $repository;
        $this->cropImageService = $cropImageService;
        $this->imageService = $imageService;
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
            'clubs' => $clubs,
            'searchString' => $searchString
                )
        );
    }

    public function addAction() {
        //Include css and js for image upload
        $this->vhm->get('headScript')->appendFile('/js/upload-files.js');
        $this->vhm->get('headLink')->appendStylesheet('/css/upload-image.css');
        //Create session container for crop images
        $container = new Container('cropImages');
        $container->getManager()->getStorage()->clear('cropImages');

        //Create Club entity and form
        $club = $this->repository->newItem();
        $form = $this->repository->createForm($club);

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
                    $imageFiles = $this->cropImageService->uploadImage($imageFile, 'club', 'original', $image, 1);

                    if (is_array($imageFiles)) {
                        $folderOriginal = $imageFiles['imageType']->getFolder();
                        $fileName = $imageFiles['imageType']->getFileName();
                        $image = $imageFiles['image'];
                        //Upload thumb 150x100
                        $imageFiles = $this->cropImageService->resizeAndCropImage('public/' . $folderOriginal . $fileName, 'public/img/userFiles/clubs/thumb/', 100, 100, '100x100', $image);
                        //Create 450x300 crop
                        $imageFiles = $this->cropImageService->createCropArray('200x250', $folderOriginal, $fileName, 'public/img/userFiles/clubs/200x2500/', 200, 250, $image);
                        $image = $imageFiles['image'];
                        $cropImages = $imageFiles['cropImages'];
                        //Create return URL
                        $returnURL = $this->cropImageService->createReturnURL('clubs', 'index');

                        //Create session container for crop
                        $this->cropImageService->createContainerImages($cropImages, $returnURL);

                        //Save image
                        $this->imageService->saveImage($image);
                        //Add image to club
                        $club->setClubImage($image);
                    } else {
                        $this->flashMessenger()->addErrorMessage($imageFiles);
                    }
                } else {
                    $this->flashMessenger()->addErrorMessage('Image not uploaded');
                }
                //End upload image
                //Save Item
                $this->repository->saveItem($club);

                if ($imageFile['error'] === 0 && is_array($imageFiles)) {
                    return $this->redirect()->toRoute('images', array('action' => 'crop'));
                } else {
                    return $this->redirect()->toRoute('clubs');
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

    public function editAction() {
        $this->vhm->get('headScript')->appendFile('/js/upload-images.js');
        $this->vhm->get('headLink')->appendStylesheet('/css/upload-image.css');

        //Create session container for crop images
        $container = new Container('cropImages');
        $container->getManager()->getStorage()->clear('cropImages');

        $id = (int) $this->params()->fromRoute('id', 0);
        if (empty($id)) {
            return $this->redirect()->toRoute('clubs');
        }
        $club = $this->repository->getItem($id);

        if (empty($club)) {
            return $this->redirect()->toRoute('clubs');
        }
        $form = $this->repository->createForm($club);
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
                    $imageFiles = $this->cropImageService->uploadImage($imageFile, 'club', 'original', $image, 1);
                    if (is_array($imageFiles)) {
                        $folderOriginal = $imageFiles['imageType']->getFolder();
                        $fileName = $imageFiles['imageType']->getFileName();
                        $image = $imageFiles['image'];
                        //Upload thumb 150x100
                        $imageFiles = $this->cropImageService->resizeAndCropImage('public/' . $folderOriginal . $fileName, 'public/img/userFiles/clubs/thumb/', 100, 100, '150x100', $image);
                        //Create 450x300 crop
                        $imageFiles = $this->cropImageService->createCropArray('200x250', $folderOriginal, $fileName, 'public/img/userFiles/clubs/200x250/', 200, 250, $image);
                        $image = $imageFiles['image'];
                        $cropImages = $imageFiles['cropImages'];
                        //Create return URL
                        $returnURL = $this->cropImageService->createReturnURL('clubs', 'index');

                        //Create session container for crop
                        $this->cropImageService->createContainerImages($cropImages, $returnURL);

                        //Save blog image
                        $this->imageService->saveImage($image);
                        //Add image to club
                        $club->setClubImage($image);
                    } else {
                        $this->flashMessenger()->addErrorMessage($imageFiles);
                    }
                } else {
                    $this->flashMessenger()->addErrorMessage('Image not uploaded');
                }
                //End upload image

                //Save Item
                $this->repository->saveItem($club);

                if ($imageFile['error'] === 0 && is_array($imageFiles)) {
                    return $this->redirect()->toRoute('images', array('action' => 'crop'));
                } else {
                    return $this->redirect()->toRoute('clubs');
                }
            }
        }

        $returnURL = $this->cropImageService->createReturnURL('clubs', 'edit', $id);

        return new ViewModel(
            array(
                'form' => $form,
                'formImage' => $formImage,
                'image' => $club->getClubImage(),
                'returnURL' => $returnURL
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
            return $this->redirect()->toRoute('clubs');
        }
        $club = $this->repository->getItem($id);
        if (empty($club)) {
            return $this->redirect()->toRoute('clubs');
        }

        $this->repository->deleteItem($club);
        $this->flashMessenger()->addSuccessMessage('Item removed');
        return $this->redirect()->toRoute('clubs');
    }


}
