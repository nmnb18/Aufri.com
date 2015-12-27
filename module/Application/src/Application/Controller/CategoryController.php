<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;

class CategoryController extends AbstractAppController
{
    public function renderView($variables = null, $options = null)
    {
        if (!isset($variables['navigation'])) {
            $variables['navigation'] = $this->getNavigation();
        }
        return parent::renderView($variables, $options);
    }

    public function indexAction()
    {
        // get variables from route to set prevoius links
        $category = $this->params('category', false);
        $subCategory = $this->params('subCategory', false);
        $subCategoryName = $this->params('subCategoryName', false);
        $categoryId = $this->params('categoryId', false);
        $prevoius = array(
            'category' => $category,
            'subCategory' => $subCategory,
            'subCategoryName' => $subCategoryName,
            'categoryId' => $categoryId
        );
        // get category wise Products
        $productTable = $this->getServiceLocator()->get('ProductsTable');
        $products = $productTable->getMany(array('aufri_products_subcategory' => $categoryId))->toArray();
        $view = array(
            'prevoius' => $prevoius,
            'products' => $products
        );
        return $this->renderView($view);
    }

    public function ajaxSortProductsAction()
    {
        // get variables from route to set prevoius links
        $sortValue = $this->params('sortValue', false);
        $categoryId = $this->params('categoryId', false);
        // get category wise Products
        $productTable = $this->getServiceLocator()->get('ProductsTable');
        $products = $productTable->getMany(array('aufri_products_subcategory' => $categoryId), array('order' => 'aufri_products_rent '.$sortValue ))->toArray();
        $view = $this->renderView(array(
            'products' => $products
        ));
        $view->setTerminal(true);
        $view->setTemplate('application/category/ajax-product-sort.phtml');
        return $view;
    }
}
