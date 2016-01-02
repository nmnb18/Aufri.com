<?php

namespace Application\Model;

use Application\Model\AbstractDbModel;

class Size extends AbstractDbModel {

    protected $aufriProductSizeId;
    protected $aufriProductSizeName;
    protected $aufriProductIdFk;
    protected $aufriProductAvailableStartdate;
    protected $aufriProductAvailableEnddate;
    protected $aufriProductSizeStatus;
    protected $aufriProductCategoryId;
    protected $aufriProductSubcategoryId;

    public function getProductSizeId() {
        return $this->aufriProductSizeId;
    }
    public function getProductSizeName() {
        return $this->aufriProductSizeName;
    }
    public function getProductIdFk() {
        return $this->aufriProductIdFk;
    }
    public function getProductAvailabelStartdate() {
        return $this->aufriProductAvailableStartdate;
    }
    public function getProductAvailabelEnddate() {
        return $this->aufriProductAvailableEnddate;
    }
    public function getProductSizeStatus() {
        return $this->aufriProductSizeStatus;
    }
    public function getProductCategoryId() {
        return $this->aufriProductCategoryId;
    }
    public function getProductSubcategoryId() {
        return $this->aufriProductSubcategoryId;
    }

    public function setProductSizeId($aufriProductSizeId) {
        return $this->aufriProductSizeId = $aufriProductSizeId;
    }
    public function setProductSizeName($aufriProductSizeName) {
        return $this->aufriProductSizeName = $aufriProductSizeName;
    }
    public function setProductIdFk($aufriProductIdFk) {
        return $this->aufriProductIdFk = $aufriProductIdFk;
    }
    public function setProductAvailabelStartdate($aufriProductAvailableStartdate) {
        return $this->aufriProductAvailableStartdate = $aufriProductAvailableStartdate;
    }
    public function setProductAvailabelEnddate($aufriProductAvailableEnddate) {
        return $this->aufriProductAvailableEnddate = $aufriProductAvailableEnddate;
    }
    public function setProductSizeStatus($aufriProductSizeStatus) {
        return $this->aufriProductSizeStatus = $aufriProductSizeStatus;
    }
    public function setProductCategoryId($aufriProductCategoryId) {
        return $this->aufriProductCategoryId = $aufriProductCategoryId;
    }
    public function setProductSubcategoryId($aufriProductSubcategoryId) {
        return $this->aufriProductSubcategoryId = $aufriProductSubcategoryId;
    }
}
