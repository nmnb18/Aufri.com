<?php

namespace Application\Model;

use Application\Model\AbstractDbModel;

class Products extends AbstractDbModel {

    protected $id;
    protected $name;
    protected $price;
    protected $description;
    protected $image;
    protected $category;
    protected $size;
    protected $fit;
    protected $length;

    public function getId() {
        return $this->id;
    }

    public function getProductName() {
        return $this->name;
    }

    public function getProductDescription() {
        return $this->description;
    }

    public function getProductImage() {
        return $this->image;
    }

    public function getProductPrice() {
        return $this->price;
    }
    public function getProductCategory() {
        return $this->category;
    }
    public function getProductSize() {
        return $this->size;
    }
    public function getProductFit() {
        return $this->fit;
    }
    public function getProductLength() {
        return $this->length;
    }

    public function setId($id) {
        return $this->id = $id;
    }

    public function setProductName($name) {
        return $this->name = $name;
    }

    public function setProductPrice($price) {
        return $this->price = $price;
    }

    public function setProductImage($image) {
        return $this->image = $image;
    }

    public function setProductDescription($description) {
        return $this->description = $description;
    }
    public function setProductCategory($category) {
        return $this->category = $category;
    }
    public function setProductSize($size) {
        return $this->size = $size;
    }
    public function setProductLength($length) {
        return $this->length = $length;
    }
    public function setProductFit($fit) {
        return $this->fit = $fit;
    }
}
