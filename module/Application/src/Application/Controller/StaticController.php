<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class StaticController extends AbstractAppController
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
    public function aboutUsAction() {
        return $this->renderView();
    }
    public function howItWorksAction() {
        return $this->renderView();
    }
    public function rentViaUsAction() {
        return $this->renderView();
    }
}
