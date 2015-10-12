<?php

/**
 * Tour controller*
 * @author chandrika sharma <chandrika.sharma@optimusinfo.com>
 */

namespace Admin\Controller;

use Application\Controller\AbstractAppController;
use Application\Model\Products;
use Application\Model\Size;
use Admin\Form\ProductsForm;
/**
 * Tour controller class
 * includes methods to edit personal details
 *  @author chandrika sharma <chandrika.sharma@optimusinfo.com>
 * */
class ProductsController extends AbstractAppController {

    /**
     * Main action to dispaly all products
     * @return Boolean
     * */
    public function indexAction() {
        if (!$this->isLogin()) {
            $this->setErrorMessage('Log in first then continue.');
            return $this->redirect()->toRoute('home');
        }
        $productsTable = $this->getServiceLocator()->get('ProductsTable');
        $products = $productsTable->getProductListWithCategory();
        $view = array(
            'products' => $products,
        );
        return $this->renderView($view);
    }

    /**
     * Main action to add tours
     * @return Boolean
     * */
    public function addAction() {
        // Check for login
        if (!$this->isLogin()) {
            $this->setErrorMessage('Log in first then continue.');
            $this->redirect()->toRoute('auth');
        }
        // Set Variables
        $request = $this->serviceLocator->get('request');
        $products = new Products();
        $productsImage = '';
        $id = '';
        $productsTable = $this->getServiceLocator()->get('ProductsTable');

        $productsForm = new ProductsForm($products); // Render attraction form
        $nonFile = $request->getPost()->toArray(); // Get form content
        $File = $request->getFiles()->toArray(); // Get form file content
        $data = array_merge_recursive($nonFile, $File);
        if ($request->isPost()) {
            $this->validateForm($id, $productsForm, $data, $products, $productsTable);
        }
        return $this->renderView(
            array('form' => $productsForm)
        );
    }

    /**
     * Main action to edit tours
     * @return Boolean
     * */
    public function editAction() {
        // Check for login
        if (!$this->isLogin()) {
            $this->setErrorMessage('Log in first then continue.');
            $this->redirect()->toRoute('auth');
        }

        $request = $this->serviceLocator->get('request');
        $id = $this->params('id', false);

        $products = new Products();

        $productsTable = $this->serviceLocator->get('ProductsTable');
        $products = $productsTable->getOne(array(
            'id' => $id
        ));
        $productsImage = $products->getProductImage();

        $productsForm = new ProductsForm($products); // Render attraction form
        $nonFile = $request->getPost()->toArray(); // Get form content
        $File = $request->getFiles()->toArray(); // Get form file content
        $data = array_merge_recursive($nonFile, $File);
        if ($request->isPost()) {
            $products->setId($id);
            $this->validateForm($id, $productsForm, $data, $products, $productsTable);
        }
        return $this->renderView(
            array(
                'form' => $productsForm,
                'productsImage' => $productsImage
            )
        );
    }

    /**
     * Function created to validate form
     * @return TRUE
     * @param int    $id         contains tour id
     * @param string $tourForm   contains form name
     * @param array  $data       contains form values
     * @param array  $tourHelper contains tourhelper object
     * @param Object $tour       contains tour object
     * @param array  $tourImage  contains tour image detail
     * */
    function validateForm($id, $productsForm, $data,  $products, $productsTable) {
        $sizeObj = new Size();
        $sizeTable = $this->getServiceLocator()->get('SizeTable');
        $productsForm->setData($data);
        $imgUpload = new \Zend\File\Transfer\Adapter\Http();
        $extension = new \Zend\Validator\File\Extension(
                array
            ('extension' => array('png', 'jpg', 'jpeg'))
        );
        $imgUpload->setValidators(array($extension), $data['image']['name']);
        if (!$productsForm->isValid()) {
            return false;
        } elseif (!$imgUpload->isValid() && $data['image']['name'] != '') {
            $this->setErrorMessage("Only png, jpeg and jpg files are allowed");
        } else {
            try {
                $this->beginDbTransaction();
                $imgUpload->setDestination(APPLICATION_PUBLIC_PATH . '/upload/Products');
                $imgUpload->receive($data ['image'] ['name']);
                $products->setProductName($data['name']);
                $products->setProductPrice($data['price']);
                $products->setProductDescription($data['description']);
                $products->setProductCategory($data['category']);
                $products->setProductLength($data['sleeve']);
                $products->setProductFit($data['fit']);
                if ($data['image']['name'] != '') {
                    $products->setProductImage($data['image']['name']);
                }
                $products = $productsTable->save($products);
                foreach($data['size'] as $size) {
                    $sizeObj->setItemId($products->getId());
                    $sizeObj->setItemSize($size);
                    $sizeObj->setCategoryId($data['category']);
                    $sizeTable->save($sizeObj);
                }
                $this->setSuccessMessage("Products added successsfully");
                $this->commitDbTransaction();
                return $this->redirect()->toRoute('admin_view_products');
            } catch (Exception $ex) {
                $this->rollbackDbTransaction();
            }
        }
    }

    /**
     * Function created to show tour details
     * @return Boolean
     * */
    public function detailsAction() {
        if (!$this->isLogin()) {
            $this->setErrorMessage('Log in first then continue.');
            return $this->redirect()->toRoute('home');
        }
        $id = $this->params('id', false);

        $productsTable = $this->getServiceLocator()->get('ProductsTable');
        $product = $productsTable->getOne(array('id'=>$id));
        $view = array(
            'product' => $product
        );
        return $this->renderView($view);
    }

    /**
     * Function to delete a specific tour
     * @return Boolean
     * */
    public function tourDeleteAjaxAction() {
        if (!$this->isLogin()) {
            $this->setErrorMessage('Log in first then continue.');
            return $this->redirect()->toRoute('home');
        }
        $request = $this->getServiceLocator()->get('request');
        $tourId = $request->getPost('tourId', false);
        $tour = new Tour();
        $tourTable = $this->getServiceLocator()->get('TourTable');
        $stageActivityTable = $this->getServiceLocator()->get('ItineraryActivityTable');
        $tour = $tourTable->getOne(
                array(
                    'tpod_tour_id' => $tourId
                )
        );
        $checkTour = count($stageActivityTable->getOne(array('tpod_stg_act_stg_attr_id' => $tourId)));
        if ($checkTour > 0) {
            $message = 'Tour ' . $tour->getTourTitle() . ' bind with some itinerary';
            return new JsonModel(array('data' => $message));
        } else {
            $tour->setTourStatus(Tour::STATUS_INACTIVE);
            $tourTable->save($tour);
            $message = 'deleted successfully';
            return new JsonModel(array('data' => $message));
        }
    }
}
