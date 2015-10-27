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
            'admin_home' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route' => '/admin',
                    'defaults' => array(
                        'controller' => 'Admin\Controller\Index',
                        'action' => 'index'
                    )
                )
            ),
            'admin_view_products' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route' => '/admin/products',
                    'defaults' => array(
                        'controller' => 'Admin\Controller\Products',
                        'action' => 'index'
                    )
                )
            ),
            'admin_add_products' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route' => '/admin/products/add',
                    'defaults' => array(
                        'controller' => 'Admin\Controller\Products',
                        'action' => 'add'
                    )
                )
            ),
            'admin_edit_products' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/admin/products/edit/:id',
                    'constraints' => array(
                        'id' => '[0-9]+',
                        'type' => '[0-9]+'
                    ),
                    'defaults' => array(
                        'controller' => 'Admin\Controller\Products',
                        'action' => 'edit'
                    )
                )
            ),
            'admin_delete_products' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/admin/products/delete/:id',
                    'constraints' => array(
                        'id' => '[0-9]+',
                        'type' => '[0-9]+'
                    ),
                    'defaults' => array(
                        'controller' => 'Admin\Controller\Products',
                        'action' => 'delete'
                    )
                )
            ),
            'admin_showdetails_products' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/admin/products/details/:id',
                    'constraints' => array(
                        'id' => '[0-9]+',
                        'type' => '[0-9]+'
                    ),
                    'defaults' => array(
                        'controller' => 'Admin\Controller\Products',
                        'action' => 'details'
                    )
                )
            ),
            'admin_view_shopkeepers' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route' => '/admin/shopkeepers',
                    'defaults' => array(
                        'controller' => 'Admin\Controller\Shopkeeper',
                        'action' => 'index'
                    )
                )
            ),
            'admin_add_shopkeepers' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route' => '/admin/shopkeepers/add',
                    'defaults' => array(
                        'controller' => 'Admin\Controller\Shopkeeper',
                        'action' => 'add'
                    )
                )
            ),
            'admin_edit_shopkeepers' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/admin/shopkeepers/edit/:id',
                    'constraints' => array(
                        'id' => '[0-9]+',
                        'type' => '[0-9]+'
                    ),
                    'defaults' => array(
                        'controller' => 'Admin\Controller\Shopkeeper',
                        'action' => 'edit'
                    )
                )
            ),
            'admin_delete_shopkeepers' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/admin/shopkeepers/delete/:id',
                    'constraints' => array(
                        'id' => '[0-9]+',
                        'type' => '[0-9]+'
                    ),
                    'defaults' => array(
                        'controller' => 'Admin\Controller\Shopkeeper',
                        'action' => 'delete'
                    )
                )
            ),
            'admin_showdetails_shopkeepers' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/admin/shopkeepers/details/:id',
                    'constraints' => array(
                        'id' => '[0-9]+',
                        'type' => '[0-9]+'
                    ),
                    'defaults' => array(
                        'controller' => 'Admin\Controller\Shopkeeper',
                        'action' => 'details'
                    )
                )
            ),
            'admin_view_orders' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route' => '/admin/orders',
                    'defaults' => array(
                        'controller' => 'Admin\Controller\Products',
                        'action' => 'index'
                    )
                )
            ),

            'admin_view_coupons' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route' => '/admin/coupons',
                    'defaults' => array(
                        'controller' => 'Admin\Controller\Coupon',
                        'action' => 'index'
                    )
                )
            ),
            'admin_add_coupons' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route' => '/admin/coupons/add',
                    'defaults' => array(
                        'controller' => 'Admin\Controller\Coupon',
                        'action' => 'add'
                    )
                )
            ),
            'admin_edit_coupons' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/admin/coupons/edit/:id',
                    'constraints' => array(
                        'id' => '[0-9]+',
                        'type' => '[0-9]+'
                    ),
                    'defaults' => array(
                        'controller' => 'Admin\Controller\Coupon',
                        'action' => 'edit'
                    )
                )
            ),
            'admin_delete_coupons' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/admin/coupons/delete/:id',
                    'constraints' => array(
                        'id' => '[0-9]+',
                        'type' => '[0-9]+'
                    ),
                    'defaults' => array(
                        'controller' => 'Admin\Controller\Coupon',
                        'action' => 'delete'
                    )
                )
            ),
            'admin_showdetails_coupons' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/admin/coupons/details/:id',
                    'constraints' => array(
                        'id' => '[0-9]+',
                        'type' => '[0-9]+'
                    ),
                    'defaults' => array(
                        'controller' => 'Admin\Controller\Coupon',
                        'action' => 'details'
                    )
                )
            ),
            'admin_view_orders' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/admin/orders/',
                    'constraints' => array(
                        'id' => '[0-9]+',
                        'type' => '[0-9]+'
                    ),
                    'defaults' => array(
                        'controller' => 'Admin\Controller\Order',
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
            'Admin\Controller\Index' => 'Admin\Controller\IndexController',
            'Admin\Controller\Products' => 'Admin\Controller\ProductsController',
            'Admin\Controller\Shopkeeper' => 'Admin\Controller\ShopkeeperController',
            'Admin\Controller\Coupon' => 'Admin\Controller\CouponController',
            'Admin\Controller\Order' => 'Admin\Controller\OrderController'
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
            'menu' => __DIR__ . '/../view/admin/index/menu.phtml',
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
