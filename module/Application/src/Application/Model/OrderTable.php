<?php

namespace Application\Model;

use Application\Model\AbstractDbTable;
use Application\Model\Order;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Expression;
use Zend\Db\Sql\Predicate;
use Zend\Db\Sql\Sql;

class OrderTable extends AbstractDbTable {

    const TABLE_NAME = 'aufri_orders';

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

    public function save(Order $order) {
        $data = $order->getRawData();
        if ($order->getOrderId() > 0) {
            $id = $order->getOrderId();
            $this->tableGateway->update($data, array('aufri_orders_id' => $id));
        } else {
            if (!$this->tableGateway->insert($data)) {
                throw new \Exception("Could not new row $id");
            }
            $id = (int) $this->tableGateway->lastInsertValue;
        }
        return $this->getOne(array('aufri_orders_id' => $id));
    }
    protected function getSqlContent($db, $sql, $select) {
        $stmt = $db->query($sql->getSqlStringForSqlObject($select));
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }

    public function getOrdersList() {
        $sql = new Sql($this->tableGateway->getAdapter());
        $db = $this->tableGateway->getAdapter()->getDriver()->getConnection()->getResource();
        $select = new Select(self::TABLE_NAME);
        $columns = array('orderId'=>'aufri_orders_id','productId'=>'aufri_orders_product_id_fk','shopkeeperId'=>'aufri_orders_shopkeeper_id_fk',
        'userId'=>'aufri_orders_user_id_fk','orderDate'=>'aufri_orders_date','couponId'=>'aufri_orders_coupon_id_fk','orderStatus'=>'aufri_orders_status');
        $select->columns($columns);
        $select->join(array(
            'productTable' => ProductsTable::TABLE_NAME
        ), 'productTable.aufri_products_id=aufri_orders.aufri_orders_product_id_fk', array(
            'productName' => 'aufri_products_name','productRent' => 'aufri_products_rent',
            'productDeposit' => 'aufri_products_security'
                ), Select::JOIN_LEFT);
        $select->join(array(
            'shopkeeperTable' => ShopkeeperTable::TABLE_NAME
        ), 'shopkeeperTable.aufri_shopkeeper_id=aufri_orders.aufri_orders_shopkeeper_id_fk', array(
            'shopkeeperName'=>'aufri_shopkeeper_name'
                ), Select::JOIN_LEFT);
        $select->join(array(
            'couponTable' => CouponTable::TABLE_NAME
        ), 'couponTable.aufri_coupons_id=aufri_orders.aufri_orders_coupon_id_fk', array(
            'couponName'=>'aufri_coupons_name', 'couponCode' => 'aufri_coupons_code','couponDiscount'=>'aufri_coupons_discount'
                ), Select::JOIN_LEFT);
        $select->join(array(
            'userTable' => UserTable::TABLE_NAME
        ), 'userTable.aufri_users_id=aufri_orders.aufri_orders_user_id_fk', array(
            'userName'=>'aufri_users_name','userPhone'=>'aufri_users_phone_no','userAddressId'=>'aufri_users_address_id_fk'
                ), Select::JOIN_LEFT);
        $select->join(array(
            'addressTable' => AddressTable::TABLE_NAME
        ), 'addressTable.aufri_address_id=userTable.aufri_users_address_id_fk',array('addressId'=>'aufri_address_id','userAddress'=>'aufri_address_address'),
        Select::JOIN_LEFT);

        return $this->getSqlContent($db, $sql, $select);
    }
}
