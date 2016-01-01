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
        $category = $this->params('category', false);
        $subCategory = $this->params('subCategory', false);
        $subCategoryName = $this->params('subCategoryName', false);
        $productId = $this->params('productId', false);
        $prevoius = array(
            'category' => $category,
            'subCategory' => $subCategory,
            'subCategoryName' => $subCategoryName,
            'productId' => $productId
        );
        $productTable = $this->getServiceLocator()->get('ProductsTable');
        $product = $productTable->getOne(array('aufri_products_id' => $productId));
        $view = array(
            'prevoius' => $prevoius,
            'product' => $product
        );
        return $this->renderView($view);
    }
}
