<?php

namespace Application\Model;

use Application\Model\AbstractDbModel;

class Products extends AbstractDbModel {

    protected $aufriProductsId;
    protected $aufriProductsName;
    protected $aufriProductsImageIdFk;
    protected $aufriProductsShopkeeperIdFk;
    protected $aufriProductsGender;
    protected $aufriProductsSize;
    protected $aufriProductsWaist;
    protected $aufriProductsRent;
    protected $aufriProductsSecurity;
    protected $aufriProductsCategory;
    protected $aufriProductsStock;
    protected $aufriProductsStatus;
    protected $aufriProductsDescription;

    public function getProductId() {
        return $this->aufriProductsId;
    }
    public function getProductName() {
        return $this->aufriProductsName;
    }
    public function getProductImage() {
        return $this->aufriProductsImageIdFk;
    }
    public function getProductShopkeeper() {
        return $this->aufriProductsShopkeeperIdFk;
    }
    public function getProductGender() {
        return $this->aufriProductsGender;
    }
    public function getProductSize() {
        return $this->aufriProductsSize;
    }
    public function getProductWaist() {
        return $this->aufriProductsWaist;
    }
    public function getProductRent() {
        return $this->aufriProductsRent;
    }
    public function getProductSecurity() {
        return $this->aufriProductsSecurity;
    }
    public function getProductStatus() {
        return $this->aufriProductsStatus;
    }
    public function getProductCategory() {
        return $this->aufriProductsCategory;
    }
    public function getProductStock() {
        return $this->aufriProductsStock;
    }
    public function getProductDescription() {
        return $this->aufriProductsDescription;
    }

    public function setProductId($aufriProductsId) {
        return $this->aufriProductsId = $aufriProductsId;
    }
    public function setProductName($aufriProductsName) {
        return $this->aufriProductsName = $aufriProductsName;
    }
    public function setProductImage($aufriProductsImageIdFk) {
        return $this->aufriProductsImageIdFk = $aufriProductsImageIdFk;
    }
    public function setProductShopkeeper($aufriProductsShopkeeperIdFk) {
        return $this->aufriProductsShopkeeperIdFk = $aufriProductsShopkeeperIdFk;
    }
    public function setProductGender($aufriProductsGender) {
        return $this->aufriProductsGender = $aufriProductsGender;
    }
    public function setProductSize($aufriProductsSize) {
        return $this->aufriProductsSize = $aufriProductsSize;
    }
    public function setProductWaist($aufriProductsWaist) {
        return $this->aufriProductsWaist = $aufriProductsWaist;
    }
    public function setProductRent($aufriProductsRent) {
        return $this->aufriProductsRent = $aufriProductsRent;
    }
    public function setProductSecurity($aufriProductsSecurity) {
        return $this->aufriProductsSecurity = $aufriProductsSecurity;
    }
    public function setProductStatus($aufriProductsStatus) {
        return $this->aufriProductsStatus = $aufriProductsStatus;
    }
    public function setProductCategory($aufriProductsCategory) {
        return $this->aufriProductsCategory = $aufriProductsCategory;
    }
    public function setProductStock($aufriProductsStock) {
        return $this->aufriProductsStock = $aufriProductsStock;
    }
    public function setProductDescription($aufriProductsDescription) {
        return $this->aufriProductsDescription = $aufriProductsDescription;
    }

}
