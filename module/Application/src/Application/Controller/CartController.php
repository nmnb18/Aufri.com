<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class CartController extends AbstractAppController
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
        $cartProducts = $this->getCartProducts();
        return $this->renderView(array(
            'cartProducts' => $cartProducts
        ));
    }
    public function editCartAction()
    {
        $request = $this->serviceLocator->get('request');
        $data = $request->getPost()->toArray();
        if($request->isPost()) {
            $session = $this->getSession();
            $session['aufrecart'][$data['product-index']] = array(
                'productId' => $data['product-id'],
                'quantity' => 1,
                'product_size' => $data['product-size'],
                'product_del_date' => $data['product-del-date'],
                'product_return_date' => $data['product-return-date']
            );
        }
        return $this->redirect()->toRoute('cart_landing');
    }
    public function deleteAction()
    {
        $session = $this->getSession();
        $itemId = $this->params('itemId', false);
        unset($session['aufrecart'][$itemId]);
        $session['cart_count'] = $session['cart_count'] - 1;
        return $this->redirect()->toRoute('cart_landing');
    }
}
