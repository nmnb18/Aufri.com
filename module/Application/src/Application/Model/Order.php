<?php

namespace Application\Model;

use Application\Model\AbstractDbModel;

class Order extends AbstractDbModel {

    protected $aufriOrdersId;
    protected $aufriOrdersProductIdFk;
    protected $aufriOrdersShopkeeperIdFk;
    protected $aufriOrdersUserIdFk;
    protected $aufriOrdersDate;
    protected $aufriOrdersCouponIdFk;
    protected $aufriOrdersStatus;

    public function getOrderId() {
        return $this->aufriOrdersId;
    }
    public function getOrderProductIdFk() {
        return $this->aufriOrdersProductIdFk;
    }
    public function getOrderShopkeeperIdFk() {
        return $this->aufriOrdersShopkeeperIdFk;
    }
    public function getOrderUserIdFk() {
        return $this->aufriOrdersUserIdFk;
    }
    public function getOrderDate() {
        return $this->aufriOrdersDate;
    }
    public function getOrderCouponIdFk() {
        return $this->aufriOrdersCouponIdFk;
    }
    public function getOrderStatus() {
        return $this->aufriOrdersStatus;
    }

    public function setOrderId($aufriOrdersId) {
        return $this->aufriOrdersId = $aufriOrdersId;
    }
    public function setOrderProductIdFk($aufriOrdersProductIdFk) {
        return $this->aufriOrdersProductIdFk = $aufriOrdersProductIdFk;
    }
    public function setOrderShopkeeperIdFk($aufriOrdersShopkeeperIdFk) {
        return $this->aufriOrdersShopkeeperIdFk = $aufriOrdersShopkeeperIdFk;
    }
    public function setOrderUserIdFk($aufriOrdersUserIdFk) {
        return $this->aufriOrdersUserIdFk = $aufriOrdersUserIdFk;
    }
    public function setOrderDate($aufriOrdersDate) {
        return $this->aufriOrdersDate = $aufriOrdersDate;
    }
    public function setOrderCouponIdFk($aufriOrdersCouponIdFk) {
        return $this->aufriOrdersCouponIdFk = $aufriOrdersCouponIdFk;
    }
    public function setOrderStatus($aufriOrdersStatus) {
        return $this->aufriOrdersStatus = $aufriOrdersStatus;
    }
}
