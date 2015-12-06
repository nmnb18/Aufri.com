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
        $orderTable = $this->getServiceLocator()->get('OrderTable');
        $productsTable = $this->getServiceLocator()->get('ProductsTable');
        $todaysOrder = $orderTable->getMany(array('aufri_orders_date'=> date('Y-m-d')))->toArray();
        $totalOrders = $orderTable->getMany()->toArray();
        $totalProducts = $productsTable->getMany()->toArray();
        $outOfStock = $productsTable->getMany(array('aufri_products_stock' => 'Out of stock'))->toArray();
        return $this->renderView(
            array('todaysOrder' => $todaysOrder,
                  'totalOrders' => $totalOrders,
                  'totalProducts' => $totalProducts,
                  'outOfStockProducts' => $outOfStock)
        );
    }

}
