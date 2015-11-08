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
    protected $aufriProductsActualcost;
    protected $aufriProductsBrand;
    protected $aufriProductsDesigner;
    protected $aufriProductsOccassion;
    protected $aufriProductsColor;
    protected $aufriProductsFromdate;
    protected $aufriProductsTodate;
    protected $aufriProductsOrdercount;
    protected $aufriProductsSeotags;

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
    public function getProductActualcost() {
        return $this->aufriProductsActualcost;
    }
    public function getProductBrand() {
        return $this->aufriProductsBrand;
    }
    public function getProductDesigner() {
        return $this->aufriProductsDesigner;
    }
    public function getProductOccassion() {
        return $this->aufriProductsOccassion;
    }
    public function getProductColor() {
        return $this->aufriProductsColor;
    }
    public function getProductFromdate() {
        return $this->aufriProductsFromdate;
    }
    public function getProductTodate() {
        return $this->aufriProductsTodate;
    }
    public function getProductOrdercount() {
        return $this->aufriProductsOrdercount;
    }
    public function getProductSeotags() {
        return $this->aufriProductsSeotags;
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
    public function setProductActualcost($aufriProductsActualcost) {
        return $this->aufriProductsActualcost = $aufriProductsActualcost;
    }
    public function setProductBrand($aufriProductsBrand) {
        return $this->aufriProductsBrand = $aufriProductsBrand;
    }
    public function setProductDesigner($aufriProductsDesigner) {
        return $this->aufriProductsDesigner = $aufriProductsDesigner;
    }
    public function setProductOccassion($aufriProductsOccassion) {
        return $this->aufriProductsOccassion = $aufriProductsOccassion;
    }
    public function setProductColor($aufriProductsColor) {
        return $this->aufriProductsColor = $aufriProductsColor;
    }
    public function setProductFromdate($aufriProductsFromdate) {
        return $this->aufriProductsFromdate = $aufriProductsFromdate;
    }
    public function setProductTodate($aufriProductsTodate) {
        return $this->aufriProductsTodate = $aufriProductsTodate;
    }
    public function setProductOrdercount($aufriProductsOrdercount) {
        return $this->aufriProductsOrdercount = $aufriProductsOrdercount;
    }
    public function setProductSeotags($aufriProductsSeotags) {
        return $this->aufriProductsSeotags = $aufriProductsSeotags;
    }
}
