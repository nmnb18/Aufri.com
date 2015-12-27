<?php

/**
 * Global Configuration Override
 *
 * You can use this file for overriding configuration values from modules, etc.
 * You would place values in here that are agnostic to the environment and not
 * sensitive to security.
 *
 * @NOTE: In practice, this file will typically be INCLUDED in your source
 * control, so do not include passwords or other sensitive information in this
 * file.
 */
return array(
    // ...
    //Database connection
    'db' => array(
        'adapters' => array(
            'dbAdapter' => array(
                'driver' => 'Pdo_mysql',
                'database' => 'aufri',
                'hostname' => 'localhost',
                'port' => 3306,
                'username' => 'tvp',
                'password' => 'password',
                'driver_options' => array(
                    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\'',
                ),
            ),
        ),
    ),
    'navigation' => array(
        // navigation for admin
        'admin' => array(
            array(
                'label' => 'Home',
                'route' => 'main_home',
            ),
            array(
                'label' => 'Users',
                'route' => 'admin_users',
            ),
            array(
                'label' => 'Orders',
                'route' => 'admin_orders',
            ),
            array(
                'label' => 'Products',
                'route' => 'admin_products',
            ),
            array(
                'label' => 'Coupons',
                'route' => 'admin_coupons',
            ),
            array(
                'label' => 'Shopkeepers',
                'route' => 'admin_shopkeepers',
            ),
        ),
        // navigation for shopkeeper
        'agent' => array(
            array(
                'label' => 'Home',
                'route' => 'home',
            ),
            array(
                'label' => 'Products',
                'route' => 'products',
            ),
        ),
    ),
    'service_manager' => array(
        'abstract_factories' => array(
            'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
            'Zend\Log\LoggerAbstractServiceFactory',
            'Zend\Navigation\Service\NavigationAbstractServiceFactory'
        ),
        'aliases' => array(
            'translator' => 'MvcTranslator',
        ),
        'factories' => array(
            'Zend\Db\Adapter\Adapter' => 'Zend\Db\Adapter\AdapterServiceFactory',
        )
    ),
);
