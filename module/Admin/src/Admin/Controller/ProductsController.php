<?php

namespace Admin\Controller;

use Application\Controller\AbstractAppController;
use Application\Model\Products;
use Admin\Form\ProductsForm;

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
        $products = $productsTable->getMany()->toArray();
        $request = $this->serviceLocator->get('request');
        $data = $request->getPost()->toArray();
        if ($request->isPost()) {
            if(!empty($data['sortby'])) {
                $filter = 'aufri_products_rent ' . $data['sortby'];
                $products = $productsTable->getMany(array(), array('order' => $filter))->toArray();
            } else if(!empty($data['productName'])) {
                $products = $productsTable->getMany(array('aufri_products_name' => $data['productName']))->toArray();
            }
        }
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
        $products = $productsTable->getOne(array('aufri_products_id' => $id));
        $productsImage = $products->getProductImage();

        $productsForm = new ProductsForm($products); // Render attraction form
        $nonFile = $request->getPost()->toArray(); // Get form content
        $File = $request->getFiles()->toArray(); // Get form file content
        $data = array_merge_recursive($nonFile, $File);
        if ($request->isPost()) {
            $products->setProductId($id);
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
        $productsForm->setData($data);
        $imgUpload = new \Zend\File\Transfer\Adapter\Http();
        $extension = new \Zend\Validator\File\Extension(array('extension' => array('png', 'jpg', 'jpeg')));
        $imgUpload->setValidators(array($extension), $data['image']['name']);
        if (!$imgUpload->isValid() && $data['image']['name'] != '') {
            $this->setErrorMessage("Only png, jpeg and jpg files are allowed");
        } else {
            try {
                $this->beginDbTransaction();
                $imgUpload->setDestination(APPLICATION_PUBLIC_PATH . '/upload/Products');
                $imgUpload->receive($data ['image']['name']);
                $products->setProductName($data['name']);
                $products->setProductStock($data['stock']);
                $products->setProductRent($data['rent']);
                $products->setProductSecurity($data['security']);
                $products->setProductCategory($data['category']);
                $products->setProductGender($data['gender']);
                $products->setProductSize($data['size']);
                $products->setProductDescription($data['description']);
                $products->setProductActualcost($data['actualcost']);
                $products->setProductBrand($data['brand']);
                $products->setProductOccassion($data['occassion']);
                $products->setProductDesigner($data['designer']);
                $products->setProductColor($data['color']);
                $products->setProductFromdate($data['fromdate']);
                $products->setProductTodate($data['todate']);
                $products->setProductSeotags($data['seotags']);
                if ($data['image']['name'] != '') {
                    $products->setProductImage($data['image']['name']);
                }
                $products = $productsTable->save($products);
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
        $product = $productsTable->getOne(array('aufri_products_id'=>$id));
        $view = array(
            'product' => $product
        );
        return $this->renderView($view);
    }

}
