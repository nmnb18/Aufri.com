<?php

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license http://framework.zend.com/license/new-bsd New BSD License
 */
return array(
    'router' => array(
        'routes' => array(
            'shopkeeper_home' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route' => '/shopkeeper',
                    'defaults' => array(
                        'controller' => 'Shopkeeper\Controller\Index',
                        'action' => 'index'
                    )
                )
            ),
            'shopkeeper_view_products' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route' => '/shopkeeper/products',
                    'defaults' => array(
                        'controller' => 'Shopkeeper\Controller\Product',
                        'action' => 'index'
                    )
                )
            ),
            'shopkeeper_view_orders' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route' => '/shopkeeper/orders',
                    'defaults' => array(
                        'controller' => 'Shopkeeper\Controller\Order',
                        'action' => 'index'
                    )
                )
            ),
        )
    ),
    'translator' => array(
        'locale' => 'en_US',
        'translation_file_patterns' => array(
            array(
                'type' => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern' => '%s.mo'
            )
        )
    ),
    'controllers' => array(
        'invokables' => array(
            'Shopkeeper\Controller\Index' => 'Shopkeeper\Controller\IndexController',
            'Shopkeeper\Controller\Product' => 'Shopkeeper\Controller\ProductController',
            'Shopkeeper\Controller\Order' => 'Shopkeeper\Controller\OrderController'
        )
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions' => true,
        'doctype' => 'HTML5',
        'not_found_template' => 'error/404',
        'exception_template' => 'error/index',
        'template_map' => array(
            'error/404' => __DIR__ . '/../view/error/404.phtml',
            'error/index' => __DIR__ . '/../view/error/index.phtml',
            //'menu' => __DIR__ . '/../view/admin/index/menu.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view'
        )
    ),
    // Placeholder for console routes
    'console' => array(
        'router' => array(
            'routes' => array()
        )
    )
);
