<?php
namespace Application;
use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
class Module {
    public function onBootstrap(MvcEvent $e) {
        $eventManager = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
        $eventManager->attach(MvcEvent::EVENT_DISPATCH, function($e) {
            $controller = $e->getTarget();
            if ($controller instanceof \Application\Controller\IndexController) {
                $controller->layout('layout/public.phtml');
            }
        });
    }
    public function getAutoloaderConfig() {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
    public function getConfig() {
        return include __DIR__ . '/config/module.config.php';
    }
    public function getServiceConfig() {
        return array(
            'factories' => array(

                'UserTable' => function ($sm) {
                    $tableGateway = $sm->get('UserTableGateway');
                    $table = new Model\UserTable($tableGateway);
                    return $table;
                },
                'UserTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('dbAdapter');
                    $resultSetPrototype = new \Zend\Db\ResultSet\ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Model\User());
                    return new \Zend\Db\TableGateway\TableGateway(Model\UserTable::TABLE_NAME, $dbAdapter, null, $resultSetPrototype);
                },

                'ProductsTable' => function ($sm) {
                    $tableGateway = $sm->get('ProductsTableGateway');
                    $table = new Model\ProductsTable($tableGateway);
                    return $table;
                },
                'ProductsTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('dbAdapter');
                    $resultSetPrototype = new \Zend\Db\ResultSet\ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Model\Products());
                    return new \Zend\Db\TableGateway\TableGateway(Model\ProductsTable::TABLE_NAME, $dbAdapter, null, $resultSetPrototype);
                },
                'ShopkeeperTable' => function ($sm) {
                    $tableGateway = $sm->get('ShopkeeperTableGateway');
                    $table = new Model\ShopkeeperTable($tableGateway);
                    return $table;
                },
                'ShopkeeperTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('dbAdapter');
                    $resultSetPrototype = new \Zend\Db\ResultSet\ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Model\Shopkeeper());
                    return new \Zend\Db\TableGateway\TableGateway(Model\ShopkeeperTable::TABLE_NAME, $dbAdapter, null, $resultSetPrototype);
                },
                'AddressTable' => function ($sm) {
                    $tableGateway = $sm->get('AddressTableGateway');
                    $table = new Model\AddressTable($tableGateway);
                    return $table;
                },
                'AddressTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('dbAdapter');
                    $resultSetPrototype = new \Zend\Db\ResultSet\ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Model\Address());
                    return new \Zend\Db\TableGateway\TableGateway(Model\AddressTable::TABLE_NAME, $dbAdapter, null, $resultSetPrototype);
                },
                'CouponTable' => function ($sm) {
                    $tableGateway = $sm->get('CouponTableGateway');
                    $table = new Model\CouponTable($tableGateway);
                    return $table;
                },
                'CouponTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('dbAdapter');
                    $resultSetPrototype = new \Zend\Db\ResultSet\ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Model\Coupon());
                    return new \Zend\Db\TableGateway\TableGateway(Model\CouponTable::TABLE_NAME, $dbAdapter, null, $resultSetPrototype);
                },
                'OrderTable' => function ($sm) {
                    $tableGateway = $sm->get('OrderTableGateway');
                    $table = new Model\OrderTable($tableGateway);
                    return $table;
                },
                'OrderTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('dbAdapter');
                    $resultSetPrototype = new \Zend\Db\ResultSet\ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Model\Order());
                    return new \Zend\Db\TableGateway\TableGateway(Model\OrderTable::TABLE_NAME, $dbAdapter, null, $resultSetPrototype);
                },
            )
        );
    }
}
