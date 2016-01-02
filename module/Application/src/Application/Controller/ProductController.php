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
        }
        return parent::renderView($variables, $options);
    }

    public function indexAction() {
        $session = $this->getSession();
        $session['cart_count'] = 0;
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
            $session['product_id'] = $productId;
            $session['product_size'] = $data['product-size'];
            $session['product_del_date'] = $data['product-del-date'];
            $session['product_return_date'] = $data['product-return-date'];
            $session['cart_count'] = $session['cart_count'] + 1;
        }
        $view = array(
            'prevoius' => $prevoius,
            'product' => $product,
            'sizes' => $sizes,
            'bookedDates' => json_encode($sizeArray)
        );
        return $this->renderView($view);
    }
}
