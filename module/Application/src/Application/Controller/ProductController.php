<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;
use Zend\Db\Sql\Expression;

class ProductController extends AbstractAppController
{
    public function renderView($variables = null, $options = null)
    {
        if (!isset($variables['navigation'])) {
            $variables['navigation'] = $this->getNavigation();
            $variables['cartproducts'] = $this->getCartProducts();
        }
        return parent::renderView($variables, $options);
    }

    public function indexAction() {
        $session = $this->getSession();
        $category = $this->params('category', false);
        $subCategory = $this->params('subCategory', false);
        $subCategoryName = $this->params('subCategoryName', false);
        $productId = $this->params('productId', false);
        $sizeArray = array();
        $prevoius = array(
            'category' => $category,
            'subCategory' => $subCategory,
            'subCategoryName' => $subCategoryName,
            'productId' => $productId
        );
        $productTable = $this->getServiceLocator()->get('ProductsTable');
        $product = $productTable->getOne(array('aufri_products_id' => $productId));
        $sizeTable = $this->getServiceLocator()->get('SizeTable');
        $sizes = $sizeTable->getMany(array('aufri_product_id_fk' => $productId))->toArray();
        $sizeBookingTable = $this->getServiceLocator()->get('SizeBookingTable');
        $productImagesTable = $this->getServiceLocator()->get('ProductImageTable');
        $productImages = $productImagesTable->getMany(array('aufri_product_images_productid' => $productId))->toArray();
        foreach($sizes as $size) {
            $sizeArray[$size['aufriProductSizeName']] = array();
            $sizeBooked = $sizeBookingTable->getMany(array('aufri_product_size_booking_productid' => $productId,
            'aufri_product_size_booking_size' => $size['aufriProductSizeName']))->toArray();
            foreach($sizeBooked as $bookedSize) {
                array_push($sizeArray[$size['aufriProductSizeName']], $bookedSize['aufriProductSizeBookingDates']);
            }
        }
        $request = $this->serviceLocator->get('request');
        $data = $request->getPost()->toArray();
        if ($request->isPost()) {
            $session = $this->getSession();
            if(!isset($session['aufrecart'])) {
                $session['aufrecart'] = array();
            }
            $session['cart'] = array(
                'productId' => $productId,
                'quantity' => 1,
                'product_size' => $data['product-size'],
                'product_del_date' => $data['product-del-date'],
                'product_return_date' => $data['product-return-date']
            );
            array_push($session['aufrecart'], $session['cart']);
            if(!isset($session['cart_count'])) {
                $session['cart_count'] = 1;
            } else {
                $session['cart_count']++;
            }
        }
        $view = array(
            'prevoius' => $prevoius,
            'product' => $product,
            'sizes' => $sizes,
            'productImages' => $productImages,
            'bookedDates' => json_encode($sizeArray)
        );
        return $this->renderView($view);
    }
}
