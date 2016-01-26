<?php

namespace Application\Controller;

use Zend\View\Model\ViewModel;
use Zend\Cache\Storage\Adapter;
use Application\Model\User;
use Application\Model\Address;
use Application\Model\UserTable;
use Zend\Crypt\Password\Bcrypt;
use Application\Controller\AbstractAppController;

class AuthController extends AbstractAppController
{

    public function renderView($variables = null, $options = null)
    {
        if (!isset($variables['navigation'])) {
            $variables['navigation'] = $this->getNavigation();
            $variables['cartproducts'] = $this->getCartProducts();
        }
        return parent::renderView($variables, $options);
    }
    public function indexAction()
    {
        return $this->renderView();
    }
    /**
     * Main function for login
     * @return TRUE
     * */
    public function loginAction()
    {
        $request = $this->getServiceLocator()->get('request');
        $data = $request->getPost()->toArray();
        if ($request->isPost()) {
            $user = new User();
            $bcrypt = new Bcrypt();
            $userTable = $this->getServiceLocator()->get('UserTable');
            $user = $userTable->getOne(array('aufri_users_email' => $data['email']));
            if (!empty($user) && !empty($data['password'])) {
                if ($bcrypt->verify($data['password'], $user->getUserPassword())) {
                    $this->updateSessionWithUser($user, false);
                    $this->setSuccessMessage('Login Success');
                    $this->redirect()->toRoute('home');
                }
            } else {
                $this->setErrorMessage('Invalid Login Details');
            }
        }
        return $this->renderView();
    }
    public function registerAction()
    {
        $request = $this->getServiceLocator()->get('request');
        $data = $request->getPost()->toArray();
        if ($request->isPost()) {

            $bcrypt = new Bcrypt();
            $userTable = $this->getServiceLocator()->get('UserTable');
            $user = $userTable->getOne(array('aufri_users_email' => $data['email']));
            if (!empty($user)) {// email already exist
                $this->setErrorMessage('Email Already exsit');
                return $this->renderView();
            }
            $addressTable = $this->getServiceLocator()->get('AddressTable');
            $address = new Address();
            $user = new User();
            $address->setAddressCity($data['city']);
            $address->setAddressPincode($data['pincode']);
            $address->setAddressAddress($data['address']);
            $address->setAddressLandmark($data['landmark']);
            $address = $addressTable->save($address);
            $user->setUserEmail($data['email']);
            if(!empty($data['password'])) {
                $user->setUserPassword($bcrypt->create($data['password']));
            }
            $user->setUserPhoneNo($data['mobile']);
            $user->setUserName($data['name']);
            $user->setUserAddressIdFk($address->getAddressId());
            $userTable->save($user);
            $this->setSuccessMessage('Profile Saved, now you can login');
        }
        return $this->renderView();
    }

    public function logoutAction()
    {
        $this->getSession()->getManager()->destroy();
        $past = time() - 3600;
        setcookie('minimalize_window', '', $past, '/');
        setcookie('open_window', '', $past, '/');
        return $this->redirect()->toRoute('home');
        return false;
    }
    /**
     * Function to set user session with userId and email
     * @param Object  $user
     * @param Boolean $facebook
     * @param Boolean $user_profile
     * @return TRUE
     * */
    protected function updateSessionWithUser($user, $facebook = false, $user_profile = null)
    {
        $session = $this->getSession();
        $session['user_id'] = $user->getUserId();
        $session['user_email'] = $user->getUserEmail();
        $session['user_name'] = $user->getUserName();
    }

}
