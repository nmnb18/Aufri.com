<?php

namespace Application\Model;

use Application\Model\AbstractDbTable;
use Application\Model\User;
use Application\Model\UserRole;
use Application\Model\UserRoleTable;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Expression;
use Zend\Db\Sql\Predicate;

class CategoryTable extends AbstractDbTable {

    const TABLE_NAME = 'paridhan_category';

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

    public function save(Category $category) {
        $data = $user->getRawData();
        if ($user->getId() > 0) {
            $id = $user->getId();
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
