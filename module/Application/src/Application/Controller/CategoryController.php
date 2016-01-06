<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;
use Application\Model\Category;

class CategoryController extends AbstractAppController
{
    protected $previous = array();
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
        $size = $this->params('size', false);
        if($size) {
            $size = $size;
        } else {
            $size = 'ALL';
        }
        $this->previous = array(
            'category' => $category,
            'subCategory' => $subCategory,
            'subCategoryName' => $subCategoryName,
            'categoryId' => $categoryId,
            'size' => $size
        );
        // get categories on the basis of category and subCategory
        if($category == 'Western') {
            $categoryType = 1;
        } else if($category == 'Ethnic') {
            $categoryType = 2;
        }

        if($subCategory == 'Men') {
            $gender = 1;
        } else if($subCategory == 'Women') {
            $gender = 2;
        }
        // get list of category
        $subCategoryTable = $this->getServiceLocator()->get('SubcategoryTable');
        $subCategory = $subCategoryTable->getMany(array('aufri_product_subcategory_gender' => $gender,
        'aufri_product_subcategory_category_id_fk' => $categoryType))->toArray();

        // get category wise Products
        
        $productTable = $this->getServiceLocator()->get('ProductsTable');
        $products = $productTable->getMany(array('aufri_products_subcategory' => $categoryId, 'aufri_products_size' => $size))->toArray();
        $view = array(
            'prevoius' => $this->previous,
            'products' => $products,
            'subCategories' => $subCategory
        );
        return $this->renderView($view);
    }

    public function ajaxSortProductsAction()
    {
        // get variables from route to set prevoius links
        $sortValue = $this->params('sortValue', false);
        $categoryId = $this->params('categoryId', false);
        $category = $this->params('category', false);
        $subCategory = $this->params('subCategory', false);
        $subCategoryName = $this->params('subCategoryName', false);
        $size = $this->params('size', false);
        $this->previous = array(
            'category' => $category,
            'subCategory' => $subCategory,
            'subCategoryName' => $subCategoryName,
            'categoryId' => $categoryId,
            'size' => $size
        );
        // get category wise Products
        $productTable = $this->getServiceLocator()->get('ProductsTable');
        $products = $productTable->getMany(array('aufri_products_subcategory' => $categoryId, 'aufri_products_size' => $size), array('order' => 'aufri_products_rent '.$sortValue ))->toArray();
        $view = $this->renderView(array(
            'products' => $products,
            'prevoius' => $this->previous
        ));
        $view->setTerminal(true);
        $view->setTemplate('application/category/ajax-product-sort.phtml');
        return $view;
    }
}
