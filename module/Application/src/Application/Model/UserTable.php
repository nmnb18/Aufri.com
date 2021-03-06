<?php

namespace Application\Model;

use Application\Model\AbstractDbTable;
use Application\Model\User;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Expression;
use Zend\Db\Sql\Predicate;

class UserTable extends AbstractDbTable {

    const TABLE_NAME = 'aufri_users';

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

    public function save(User $user) {
        $data = $user->getRawData();
        if ($user->getUserId() > 0) {
            $id = $user->getUserId();
            $this->tableGateway->update($data, array('aufri_users_id' => $id));
        } else {
            if (!$this->tableGateway->insert($data)) {
                throw new \Exception("Could not new row $id");
            }
            $id = (int) $this->tableGateway->lastInsertValue;
        }
        return $this->getOne(array('aufri_users_id' => $id));
    }
}
