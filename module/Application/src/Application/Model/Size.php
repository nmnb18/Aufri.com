<?php

namespace Application\Model;

use Application\Model\AbstractDbModel;

class Size extends AbstractDbModel {

    protected $id;
    protected $itemId;
    protected $itemSize;
    protected $categoryId;

    public function getId() {
        return $this->id;
    }

    public function getItemId() {
        return $this->itemId;
    }
    public function getItemSize() {
        return $this->itemSize;
    }
    public function setId($id) {
        return $this->id = $id;
    }

    public function setItemId($itemId) {
        return $this->itemId = $itemId;
    }
    public function setItemSize($itemSize) {
        return $this->itemSize = $itemSize;
    }
    public function setCategoryId($categoryId) {
        return $this->categoryId = $categoryId;
    }
}
