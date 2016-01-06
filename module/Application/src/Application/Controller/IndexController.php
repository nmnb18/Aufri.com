<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractAppController
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
}
