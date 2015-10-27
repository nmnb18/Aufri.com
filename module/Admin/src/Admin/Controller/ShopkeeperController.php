<?php

// Admin IndexController

namespace Admin\Controller;

use Application\Controller\AbstractAppController;
use Application\Model\Shopkeeper;
use Application\Model\Address;
use Admin\Form\ShopkeeperForm;

class ShopkeeperController extends AbstractAppController {

    // Main action for view
    public function indexAction() {
        if (!$this->isLogin()) {              // Check for login
            $this->setErrorMessage('Log in first then continue.');
            return $this->redirect()->toRoute('home');
        }
        $shopkeeperTable = $this->getServiceLocator()->get('ShopkeeperTable');
        $shopekeepers = $shopkeeperTable->getMany()->toArray();
        $view = array(
            'shopkeepers' => $shopekeepers,
        );
        return $this->renderView($view);
    }

    public function addAction() {
        // Check for login
        if (!$this->isLogin()) {
            $this->setErrorMessage('Log in first then continue.');
            $this->redirect()->toRoute('auth');
        }
        // Set Variables
        $request = $this->serviceLocator->get('request');
        $shopkeeper = new Shopkeeper();
        $address = new Address();
        $id = '';
        $shopkeeperTable = $this->getServiceLocator()->get('ShopkeeperTable');
        $shopkeeperForm = new ShopkeeperForm($shopkeeper, $address); // Render shopkeeper form
        $data = $request->getPost()->toArray(); // Get form content
        if ($request->isPost()) {
            $this->validateForm($id, $shopkeeperForm, $data, $shopkeeper, $shopkeeperTable, $address);
        }
        return $this->renderView(
            array('form' => $shopkeeperForm)
        );
    }

    public function editAction() {
        // Check for login
        if (!$this->isLogin()) {
            $this->setErrorMessage('Log in first then continue.');
            $this->redirect()->toRoute('auth');
        }
        // Set Variables
        $request = $this->serviceLocator->get('request');
        $id = $this->params('id', false);

        $shopkeeperTable = $this->getServiceLocator()->get('ShopkeeperTable');
        $shopkeeper = $shopkeeperTable->getOne(array('aufri_shopkeeper_id' => $id));
        $addressTable = $this->getServiceLocator()->get('AddressTable');
        $address = $addressTable->getOne(array('aufri_address_id' => $shopkeeper->getShopkeeperAddressId()));
        $address->setAddressId($shopkeeper->getShopkeeperAddressId());
        $shopkeeperForm = new ShopkeeperForm($shopkeeper, $address); // Render shopkeeper form
        $data = $request->getPost()->toArray(); // Get form content
        if ($request->isPost()) {
            $this->validateForm($id, $shopkeeperForm, $data, $shopkeeper, $shopkeeperTable, $address);
        }
        return $this->renderView(
            array('form' => $shopkeeperForm)
        );
    }

    function validateForm($id, $shopkeeperForm, $data,  $shopkeeper, $shopkeeperTable, $address) {
        $shopkeeperForm->setData($data);
        if (!$shopkeeperForm->isValid()) {
            return false;
        } else {
            try {
                $this->beginDbTransaction();
                $addressTable = $this->getServiceLocator()->get('AddressTable');
                $shopkeeper->setShopkeeperId($id);
                $address->setAddressCity($data['city']);
                $address->setAddressPincode($data['pincode']);
                $address->setAddressAddress($data['address']);
                $address->setAddressLandmark($data['landmark']);
                $address = $addressTable->save($address);
                $shopkeeper->setShopkeeperName($data['name']);
                $shopkeeper->setShopkeeperEmail($data['email']);
                $shopkeeper->setShopkeeperPhone($data['phoneno']);
                $shopkeeper->setShopkeeperDetails($data['details']);
                $shopkeeper->setShopkeeperAddressId($address->getAddressId());
                $shopkeeperTable->save($shopkeeper);
                $this->setSuccessMessage("Products added successsfully");
                $this->commitDbTransaction();
                return $this->redirect()->toRoute('admin_view_shopkeepers');
            } catch (Exception $ex) {
                $this->rollbackDbTransaction();
            }
        }
    }

    public function detailsAction() {
        if (!$this->isLogin()) {
            $this->setErrorMessage('Log in first then continue.');
            return $this->redirect()->toRoute('home');
        }
        $id = $this->params('id', false);
        $shopkeeperTable = $this->getServiceLocator()->get('ShopkeeperTable');
        $shopkeeper = $shopkeeperTable->getOne(array('aufri_shopkeeper_id'=>$id));
        $addressTable = $this->getServiceLocator()->get('AddressTable');
        $address = $addressTable->getOne(array('aufri_address_id' => $shopkeeper->getShopkeeperAddressId()));
        $view = array(
            'shopkeeper' => $shopkeeper,
            'address' => $address
        );
        return $this->renderView($view);
    }

}
