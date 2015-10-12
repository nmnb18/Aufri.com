<?php

namespace Application\Model;

use Application\Model\AbstractDbTable;
use Application\Model\Itinerary;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Expression;
use Zend\Db\Sql\Update;
use Application\Model\CategoryTable;
use Application\Model\SizeTable;
class ProductsTable extends AbstractDbTable {

    const TABLE_NAME = 'paridhan_item';

    public function getOne($where = array()) {
        $row = $this->tableGateway->select($where)->current();
        if (!$row) {
            return null;
        }
        return $row;
    }

    public function getMany($where = array(), $params = array()) {
        $select = new Select(self::TABLE_NAME);
        $select->where($where);
        if (!empty($params)) {
            foreach ($params as $key => $value) {
                $select->{$key}($value);
            }
        }
        return $this->tableGateway->selectWith($select);
    }

    protected function getSqlContent($select) {
        $sql = new Sql($this->tableGateway->getAdapter());
        $db = $this->tableGateway->getAdapter()->getDriver()->getConnection()->getResource();
        $stmt = $db->query($sql->getSqlStringForSqlObject($select));
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }

    public function getProductListWithCategory() {
        $select = new Select(self::TABLE_NAME);
        $columns = array('productId' => 'id', 'productName' => 'name', 'productImage' => 'image', 'productPrice' => 'price');
        $select->columns($columns);
        $select->join(array(
            'category' => CategoryTable::TABLE_NAME
        ), 'category.id = paridhan_item.category', array(
            'productCategory' => 'category'), Select::JOIN_LEFT);
        return $this->getSqlContent($select);
    }

    public function getProductListWithSize($where = array()) {
        $select = new Select(self::TABLE_NAME);
        $columns = array('id' => 'id', 'name' => 'name', 'image' => 'image', 'price' => 'price', 'description' => 'description', 'fit' => 'fit', 'length' => 'length');
        $select->columns($columns);
        $select->join(array(
            'size' => SizeTable::TABLE_NAME
        ), 'size.item_id = paridhan_item.id', array(
            'itemSize' => 'item_size'), Select::JOIN_LEFT);
        $select->where($where);
        return $this->getSqlContent($select);
    }

    public function getProductWithStyle($categoryId) {
        $select = new Select(SizeTable::TABLE_NAME);
        $columns = array('itemId' => 'item_id', 'categoryId' => 'category_id', 'size' => 'item_size', 'sizeCount' => new Expression('Count(item_size)'));
        $select->group('item_size');
        $select->where(array('category_id'=>$categoryId));
        $select->columns($columns);
        return $this->getSqlContent($select);
    }

    public function getProductWithFitLength($where = array(), $params = array()) {
        $select = new Select(self::TABLE_NAME);
        $select->where($where);
        if (!empty($params)) {
            foreach ($params as $key => $value) {
                $select->{$key}($value);
            }
        }
        return $this->getSqlContent($select);
    }
    public function getProductById($where = array(), $params = array()) {
        $select = new Select(self::TABLE_NAME);
        $select->where($where);
        if (!empty($params)) {
            foreach ($params as $key => $value) {
                $select->{$key}($value);
            }
        }
        return $this->getSqlContent($select);
    }
    public function save(Products $tour) {
        $data = $tour->getRawData();
        if ($tour->getId() > 0) {
            $id = $tour->getId();
            $this->tableGateway->update($data, array('id' => $id));
        } else {
            if (!$this->tableGateway->insert($data)) {
                throw new \Exception("Could not new row $id");
            }
            $id = (int) $this->tableGateway->lastInsertValue;
        }

        return $this->getOne(array('id' => $id));
    }

}
