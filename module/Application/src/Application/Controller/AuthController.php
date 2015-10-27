<?php

/**
 * Auth controller to add city*
 * @author chandrika sharma <chandrika.sharma@optimusinfo.com>
 */

namespace Application\Controller;

use Zend\View\Model\ViewModel;
use Zend\Cache\Storage\Adapter;
use Application\Model\User;
use Application\Model\UserTable;
use Zend\Crypt\Password\Bcrypt;
use Application\Controller\AbstractAppController;
use Application\Model\UserRole;
use Application\Form\LoginForm;
use Application\Form\ForgotPasswordForm;

/**
 * Auth controller class
 * includes methods for login authentication
 *  * @author chandrika sharma <chandrika.sharma@optimusinfo.com>
 * */
class AuthController extends AbstractAppController
{

    /**
     * Main function for login
     * @return TRUE
     * */
    public function loginAction()
    {   // login form object
        $loginForm = new LoginForm();
        $request = $this->getServiceLocator()->get('request');
        $data = $request->getPost()->toArray();
        //set the post data to form
        $loginForm->setData($data);
        if ($request->isPost()) {
            if ($loginForm->isValid()) {
                $this->validateForm($data, $loginForm);
            }
        }
        return $this->renderView(array('form' => $loginForm));
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
     * Function to validate login form
     * @param Array  $data
     * @param Object $loginForm
     * @return TRUE
     * */
    public function validateForm($data, $loginForm)
    {
        $user = new User();
        $bcrypt = new Bcrypt();
        $userTable = $this->getServiceLocator()->get('UserTable');
        $user = $userTable->getOne(array('aufri_users_email' => $data['email']));
        if (!empty($user) && !empty($data['password'])) {
            if ($bcrypt->verify($data['password'], $user->getUserPassword())) {
                $this->updateSessionWithUser($user, false);
                return $this->redirect()->toRoute('admin_home');
            }
        } else {
            $this->setErrorMessage('Invalid login credentials');
        }
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
    }

}
