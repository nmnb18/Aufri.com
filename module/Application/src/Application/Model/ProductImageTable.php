<?php

namespace Application\Model;

use Application\Model\AbstractDbTable;
use Application\Model\Order;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Expression;
use Zend\Db\Sql\Predicate;
use Zend\Db\Sql\Sql;

class ProductImageTable extends AbstractDbTable {

    const TABLE_NAME = 'aufri_product_images';

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

    public function save(ProductImage $productImage) {
        $data = $productImage->getRawData();
        if ($productImage->getImageId() > 0) {
            $id = $productImage->getImageId();
            $this->tableGateway->update($data, array('aufri_product_images_id' => $id));
        } else {
            if (!$this->tableGateway->insert($data)) {
                throw new \Exception("Could not new row $id");
            }
            $id = (int) $this->tableGateway->lastInsertValue;
        }
        return $this->getOne(array('aufri_product_images_id' => $id));
    }
}
