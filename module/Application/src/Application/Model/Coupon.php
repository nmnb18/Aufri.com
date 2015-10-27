<?php

namespace Application\Model;

use Application\Model\AbstractDbModel;

class Coupon extends AbstractDbModel {

    protected $aufriCouponsId;
    protected $aufriCouponsName;
    protected $aufriCouponsCode;
    protected $aufriCouponsStartdate;
    protected $aufriCouponsEnddate;
    protected $aufriCouponsDiscount;
    protected $aufriCouponsAvailFor;
    protected $aufriCouponsMinorder;
    protected $aufriCouponsType;
    protected $aufriCouponsCountAnyCustomer;
    protected $aufriCouponsCountSingleCustomer;
    protected $aufriCouponsStatus;

    public function getCouponId() {
        return $this->aufriCouponsId;
    }
    public function getCouponName() {
        return $this->aufriCouponsName;
    }
    public function getCouponCode() {
        return $this->aufriCouponsCode;
    }
    public function getCouponStartdate() {
        return $this->aufriCouponsStartdate;
    }
    public function getCouponEnddate() {
        return $this->aufriCouponsEnddate;
    }
    public function getCouponDiscount() {
        return $this->aufriCouponsDiscount;
    }
    public function getCouponAvailFor() {
        return $this->aufriCouponsAvailFor;
    }
    public function getCouponMinorder() {
        return $this->aufriCouponsMinorder;
    }
    public function getCouponType() {
        return $this->aufriCouponsType;
    }
    public function getCouponCountForAnyCustomer() {
        return $this->aufriCouponsCountAnyCustomer;
    }
    public function getCouponForSingleCustomer() {
        return $this->aufriCouponsCountSingleCustomer;
    }
    public function getCouponStatus() {
        return $this->aufriCouponsStatus;
    }

    public function setCouponId($aufriCouponsId) {
        return $this->aufriCouponsId = $aufriCouponsId;
    }
    public function setCouponName($aufriCouponsName) {
        return $this->aufriCouponsName = $aufriCouponsName;
    }
    public function setCouponCode($aufriCouponsCode) {
        return $this->aufriCouponsCode = $aufriCouponsCode;
    }
    public function setCouponStartdate($aufriCouponsStartdate) {
        return $this->aufriCouponsStartdate = $aufriCouponsStartdate;
    }
    public function setCouponEnddate($aufriCouponsEnddate) {
        return $this->aufriCouponsEnddate = $aufriCouponsEnddate;
    }
    public function setCouponDiscount($aufriCouponsDiscount) {
        return $this->aufriCouponsDiscount = $aufriCouponsDiscount;
    }
    public function setCouponAvailFor($aufriCouponsAvailFor) {
        return $this->aufriCouponsAvailFor = $aufriCouponsAvailFor;
    }
    public function setCouponMinorder($aufriCouponsMinorder) {
        return $this->aufriCouponsMinorder = $aufriCouponsMinorder;
    }
    public function setCouponType($aufriCouponsType) {
        return $this->aufriCouponsType = $aufriCouponsType;
    }
    public function setCouponCountForAnyCustomer($aufriCouponsCountAnyCustomer) {
        return $this->aufriCouponsCountAnyCustomer = $aufriCouponsCountAnyCustomer;
    }
    public function setCouponForSingleCustomer($aufriCouponsCountSingleCustomer) {
        return $this->aufriCouponsCountSingleCustomer = $aufriCouponsCountSingleCustomer;
    }
    public function setCouponStatus($aufriCouponsStatus) {
        return $this->aufriCouponsStatus = $aufriCouponsStatus;
    }
}
