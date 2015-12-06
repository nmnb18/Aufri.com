<?php

// Admin IndexController

namespace Admin\Controller;

use Application\Controller\AbstractAppController;

class OrderController extends AbstractAppController {

    // Main action for view
    public function indexAction() {
        if (!$this->isLogin()) {              // Check for login
            $this->setErrorMessage('Log in first then continue.');
            return $this->redirect()->toRoute('home');
        }
        $orderTable = $this->getServiceLocator()->get('OrderTable');
        $orderList = $orderTable->getOrdersList();
        $view = array('orderList' => $orderList);
        return $this->renderView($view);
    }
    public function editAction() {
        if (!$this->isLogin()) {
            $this->setErrorMessage('Log in first then continue.');
            $this->redirect()->toRoute('auth');
        }

        $request = $this->serviceLocator->get('request');
        $id = $this->params('id', false);
        
        $this->renderView();
    }
}
