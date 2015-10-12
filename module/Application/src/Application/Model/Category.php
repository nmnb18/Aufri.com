<?php

namespace Application\Model;

use Application\Model\AbstractDbModel;

class Category extends AbstractDbModel {

    protected $id;
    protected $category;

    public function getId() {
        return $this->id;
    }

    public function getCategory() {
        return $this->category;
    }

    public function setId($id) {
        return $this->id = $id;
    }

    public function setCategory($category) {
        return $this->category = $category;
    }
}
