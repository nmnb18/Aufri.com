<?php

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
return array(
    'router' => array(
        'routes' => array(
            'home' => array(
                'type' => 'literal',
                'options' => array(
                    'route' => '/',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Index',
                        'action' => 'index'
                    )
                )
            ),

            'auth' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/auth/:action',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*'
                    ),
                    'defaults' => array(
                        'controller' => 'Application\Controller\Auth',
                        'action' => 'login'
                    )
                )
            ),
            'auth_logout' => array(
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => array(
                    'route' => '/logout[/]',
                    'constraints' => array(
                        'key' => '[a-zA-Z0-9_-]+'
                    ),
                    'defaults' => array(
                        'controller' => 'Application\Controller\Auth',
                        'action' => 'logout'
                    )
                )
            ),
            'category_landing' => array(
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => array(
                    'route' => '/shop/:category/:subCategory/:subCategoryName/:categoryId[/:size]',
                    'constraints' => array(
                        'key' => '[a-zA-Z0-9_-]+'
                    ),
                    'defaults' => array(
                        'controller' => 'Application\Controller\Category',
                        'action' => 'index'
                    )
                )
            ),
            'product_landing' => array(
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => array(
                    'route' => '/shop/product/:category/:subCategory/:subCategoryName/:productId',
                    'constraints' => array(
                        'key' => '[a-zA-Z0-9_-]+'
                    ),
                    'defaults' => array(
                        'controller' => 'Application\Controller\Product',
                        'action' => 'index'
                    )
                )
            ),
            'cart_landing' => array(
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => array(
                    'route' => '/shop/product/shopping/cart',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Cart',
                        'action' => 'index'
                    )
                )
            ),
            'ajax_sort_product' => array(
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => array(
                    'route' => '/shop/sort/products/:sortValue/:categoryId/:category/:subCategory/:subCategoryName/:size',
                    'constraints' => array(
                        'key' => '[a-zA-Z0-9_-]+'
                    ),
                    'defaults' => array(
                        'controller' => 'Application\Controller\Category',
                        'action' => 'ajaxSortProducts'
                    )
                )
            ),
            'delete_cart_item' => array(
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => array(
                    'route' => '/shop/cart/product/delete/:itemId',
                    'constraints' => array(
                        'key' => '[a-zA-Z0-9_-]+'
                    ),
                    'defaults' => array(
                        'controller' => 'Application\Controller\Cart',
                        'action' => 'delete'
                    )
                )
            ),
            'edit_cart' => array(
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => array(
                    'route' => '/shop/products/cart/edit/',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Cart',
                        'action' => 'editCart'
                    )
                )
            ),
            'checkout' => array(
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => array(
                    'route' => '/shop/products/checkout/',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Checkout',
                        'action' => 'index'
                    )
                )
            ),
            'login' => array(
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => array(
                    'route' => '/shop/user/login',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Auth',
                        'action' => 'login'
                    )
                )
            ),
            'register' => array(
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => array(
                    'route' => '/shop/user/register',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Auth',
                        'action' => 'register'
                    )
                )
            ),
            'place_order' => array(
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => array(
                    'route' => '/shop/user/place/order',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Order',
                        'action' => 'placeOrder'
                    )
                )
            ),
            'about_us' => array(
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => array(
                    'route' => '/shop/user/about/us',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Static',
                        'action' => 'aboutUs'
                    )
                )
            ),
            'how_it_works' => array(
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => array(
                    'route' => '/shop/user/how/it/works',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Static',
                        'action' => 'howItWorks'
                    )
                )
            ),
            'rent_via_us' => array(
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => array(
                    'route' => '/shop/user/rent/viaus',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Static',
                        'action' => 'rentViaUs'
                    )
                )
            ),
        )
    ),
    'service_manager' => array(
        'factories' => array(
            'navigation' => 'Zend\Navigation\Service\DefaultNavigationFactory',
            'Zend\Db\Adapter\Adapter' => 'Zend\Db\Adapter\AdapterServiceFactory'
        ),
        'abstract_factories' => array(
            'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
            'Zend\Log\LoggerAbstractServiceFactory',
            'Zend\Db\Adapter\AdapterAbstractServiceFactory'
        ),
        'aliases' => array(
            'translator' => 'MvcTranslator'
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
            'Application\Controller\Index' => 'Application\Controller\IndexController',
            'Application\Controller\Auth' => 'Application\Controller\AuthController',
            'Application\Controller\Product' => 'Application\Controller\ProductController',
            'Application\Controller\Category' => 'Application\Controller\CategoryController',
            'Application\Controller\Cart' => 'Application\Controller\CartController',
            'Application\Controller\Checkout' => 'Application\Controller\CheckoutController',
            'Application\Controller\Order' => 'Application\Controller\OrderController',
            'Application\Controller\Static' => 'Application\Controller\StaticController',
        )
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions' => true,
        'doctype' => 'HTML5',
        'not_found_template' => 'error/404',
        'exception_template' => 'error/index',
        'template_map' => array(
            'layout/layout' => __DIR__ . '/../view/layout/layout.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404' => __DIR__ . '/../view/error/404.phtml',
            'error/index' => __DIR__ . '/../view/error/index.phtml',
            'ajax-product-sort' => __DIR__ . '/../view/application/category/ajax-product-sort.phtml'
        ),
        'strategies' => array(
            'ViewJsonStrategy'
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
