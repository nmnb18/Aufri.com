<?php

// Admin IndexController

namespace Admin\Controller;

use Application\Controller\AbstractAppController;
use Zend\View\Model\ViewModel;
use Admin\Form\ProfileForm;
use Application\Model\User;
use Application\Model\UserTable;
use Zend\Crypt\Password\Bcrypt;

class IndexController extends AbstractAppController {

    // Main action for view
    public function indexAction() {
        if (!$this->isLogin()) {              // Check for login
            $this->setErrorMessage('Log in first then continue.');
            return $this->redirect()->toRoute('home');
        }

        return $this->renderView();
    }

}
