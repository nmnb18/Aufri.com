<?php

namespace Application\Model;

use Application\Model\AbstractDbModel;

class ProductImage extends AbstractDbModel {

    protected $aufriProductImagesId;
    protected $aufriProductImagesName;
    protected $aufriProductImagesProductid;

    public function getImageId() {
        return $this->aufriProductImagesId;
    }
    public function getImageName() {
        return $this->aufriProductImagesName;
    }
    public function getImageProductId() {
        return $this->aufriProductImagesProductid;
    }
    public function setImageId($aufriProductImagesId) {
        return $this->aufriProductImagesId = $aufriProductImagesId;
    }
    public function setImageName($aufriProductImagesName) {
        return $this->aufriProductImagesName = $aufriProductImagesName;
    }
    public function setImageProductId($aufriProductImagesProductid) {
        return $this->aufriProductImagesProductid = $aufriProductImagesProductid;
    }
}
