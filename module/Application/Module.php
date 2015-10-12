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
                'CategoryTable' => function ($sm) {
                    $tableGateway = $sm->get('CategoryTableGateway');
                    $table = new Model\CategoryTable($tableGateway);
                    return $table;
                },
                'CategoryTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('dbAdapter');
                    $resultSetPrototype = new \Zend\Db\ResultSet\ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Model\Category());
                    return new \Zend\Db\TableGateway\TableGateway(Model\CategoryTable::TABLE_NAME, $dbAdapter, null, $resultSetPrototype);
                },
                'SizeTable' => function ($sm) {
                    $tableGateway = $sm->get('SizeTableGateway');
                    $table = new Model\SizeTable($tableGateway);
                    return $table;
                },
                'SizeTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('dbAdapter');
                    $resultSetPrototype = new \Zend\Db\ResultSet\ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Model\Size());
                    return new \Zend\Db\TableGateway\TableGateway(Model\SizeTable::TABLE_NAME, $dbAdapter, null, $resultSetPrototype);
                },
            )
        );
    }
}
