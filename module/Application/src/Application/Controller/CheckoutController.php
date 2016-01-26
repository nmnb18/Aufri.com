<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class CheckoutController extends AbstractAppController
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
        $total = 0;
        foreach($cartProducts as $cartItem) {
            $total = $total + $cartItem['rent'] + $cartItem['deposit'];
        }
        $session = $this->getSession();
        $userTable = $this->getServiceLocator()->get('UserTable');
        $user = $userTable->getOne(array('aufri_users_id' => $session['user_id']));
        $addressId = $user->getUserAddressIdFk();
        $addressTable = $this->getServiceLocator()->get('AddressTable');
        $address = $addressTable->getOne(array('aufri_address_id' => $addressId));
        return $this->renderView(array(
            'cartProducts' => $cartProducts,
            'total' => $total,
            'user' => $user,
            'address' => $address
        ));
    }
}
