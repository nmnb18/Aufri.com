<?php

namespace Application\Model;

use Application\Model\AbstractDbTable;
use Application\Model\Shopkeeper;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Expression;
use Zend\Db\Sql\Predicate;

class ShopkeeperTable extends AbstractDbTable {

    const TABLE_NAME = 'aufri_shopkeeper';

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

    public function save(Shopkeeper $shopkeeper) {
        $data = $shopkeeper->getRawData();
        if ($shopkeeper->getShopkeeperId() > 0) {
            $id = $shopkeeper->getShopkeeperId();
            $this->tableGateway->update($data, array('aufri_shopkeeper_id' => $id));
        } else {
            if (!$this->tableGateway->insert($data)) {
                throw new \Exception("Could not new row $id");
            }
            $id = (int) $this->tableGateway->lastInsertValue;
        }
        return $this->getOne(array('aufri_shopkeeper_id' => $id));
    }
}
