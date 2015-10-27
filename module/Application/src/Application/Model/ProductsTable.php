<?php

namespace Application\Model;

use Application\Model\AbstractDbTable;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Expression;
use Zend\Db\Sql\Update;

class ProductsTable extends AbstractDbTable {

    const TABLE_NAME = 'aufri_products';

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


    public function save(Products $tour) {
        $data = $tour->getRawData();
        if ($tour->getProductId() > 0) {
            $id = $tour->getProductId();
            $this->tableGateway->update($data, array('aufri_products_id' => $id));
        } else {
            if (!$this->tableGateway->insert($data)) {
                throw new \Exception("Could not new row $id");
            }
            $id = (int) $this->tableGateway->lastInsertValue;
        }
        return $this->getOne(array('aufri_products_id' => $id));
    }

}
