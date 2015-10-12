<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;
use Zend\Db\Sql\Expression;
class ProductsController extends AbstractRestfulController
{
    public function getList() {
        $categoryId = $this->params('categoryId', false);
        $productTable = $this->getServiceLocator()->get('ProductsTable');
        $products = $productTable->getProductListWithSize(array('category' => $categoryId));
        $productsWithSize = $productTable->getProductWithStyle($categoryId);
        $productWithFit = $productTable->getProductWithFitLength(array('category' => $categoryId),array('columns' => array('productCategory' => 'category','productFit' => 'fit','fitCount' => new Expression('COUNT(fit)')),'group' => 'fit'));
        $productWithLength = $productTable->getProductWithFitLength(array('category' => $categoryId),array('columns' => array('productCategory' => 'category','productLength' => 'length','lengthCount' => new Expression('COUNT(length)')),'group' => 'length'));
        return new JsonModel(array('products' => $products, 'productSize' => $productsWithSize, 'productFit' => $productWithFit, 'productLength' => $productWithLength));
    }

    public function getItemAction() {
        $itemId = $this->params('itemId', false);
        $productTable = $this->getServiceLocator()->get('ProductsTable');
        $item = $productTable->getProductById(array('id'=>$itemId));
        return new JsonModel($item);
    }
}
