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
}
