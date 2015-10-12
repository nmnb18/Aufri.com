<?php

namespace Application\Model;

use Application\Model\AbstractDbTable;
use Application\Model\Size;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Expression;
use Zend\Db\Sql\Predicate;

class SizeTable extends AbstractDbTable {

    const TABLE_NAME = 'paridhan_item_size';

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
        $select->order("id DESC");
        if (!empty($params)) {
            foreach ($params as $key => $value) {
                $select->{$key}($value);
            }
        }
        return $this->tableGateway->selectWith($select);
    }

    public function save(Size $size) {
        $data = $size->getRawData();
        if ($size->getId() > 0) {
            $id = $size->getId();
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
