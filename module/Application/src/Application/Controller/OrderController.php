<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Model\User;
use Application\Model\Order;
use Application\Model\Address;
use Application\Model\UserTable;
use Zend\Crypt\Password\Bcrypt;

class OrderController extends AbstractAppController
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
        return $this->renderView(array('user' => $user));
    }
    public function placeOrderAction() {
        $request = $this->getServiceLocator()->get('request');
        $data = $request->getPost()->toArray();
        if ($request->isPost()) {
            $bcrypt = new Bcrypt();
            $userTable = $this->getServiceLocator()->get('UserTable');
            $user = $userTable->getOne(array('aufri_users_email' => $data['email']));
            $order = new Order();
            $orderTable = $this->getServiceLocator()->get('OrderTable');
            if (empty($user)) {// email already exist
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
                $user = $userTable->save($user);
            }
            $cartProducts = $this->getCartProducts();
            foreach ($cartProducts as $cartProduct) {
                $order->setOrderProductIdFk($cartProduct['id']);
                $order->setOrderUserIdFk($user->getUserId());
                $order->setProductOrderSize($cartProduct['size']);
                $order->setOrderStatus('New Order');
                $order->setOrderDate(date('Y-m-d'));
                $order = $orderTable->save($order);
            }
            $this->setSuccessMessage('Order SuccessFully Placed...');
            $session['cart_count'] = 0;
        }
        return $this->renderView(
        array(
            'orderId' => 'AUFRIORDER#'.$order->getOrderId()
        )
    );
    }
}
