<?php

namespace Application\Model;

use Application\Model\AbstractDbModel;

class Subcategory extends AbstractDbModel {

    protected $aufriProductSubcategoryId;
    protected $aufriProductSubcategoryName;
    protected $aufriProductSubcategoryCategoryIdFk;
    protected $aufriProductSubcategoryGender;

    const GENDER_MALE = 1;
    const GENDER_FEMALE = 2;

    public function getProductSubcategoryId() {
        return $this->aufriProductSubcategoryId;
    }
    public function getProductSubcategoryName() {
        return $this->aufriProductSubcategoryName;
    }
    public function getProductSubcategoryCategoryIdFk() {
        return $this->aufriProductSubcategoryCategoryIdFk;
    }
    public function getProductSubcategoryGender() {
        return $this->aufriProductSubcategoryGender;
    }

    public function setProductSubcategoryId($aufriProductSubcategoryId) {
        return $this->aufriProductSubcategoryId = $aufriProductSubcategoryId;
    }
    public function setProductSubcategoryName($aufriProductSubcategoryName) {
        return $this->aufriProductSubcategoryName = $aufriProductSubcategoryName;
    }
    public function setProductSubcategoryCategoryIdFk($aufriProductSubcategoryCategoryIdFk) {
        return $this->aufriProductSubcategoryCategoryIdFk = $aufriProductSubcategoryCategoryIdFk;
    }
    public function setproductSubcategoryGender($aufriProductSubcategoryGender) {
        return $this->aufriProductSubcategoryGender = $aufriProductSubcategoryGender;
    }
}
