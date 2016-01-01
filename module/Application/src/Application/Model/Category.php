<?php

namespace Application\Model;

use Application\Model\AbstractDbModel;

class Subcategory extends AbstractDbModel {

    protected $aufriProductCategoryId;
    protected $aufriProductCategoryName;

    const WESTERN = 1;
    const ETHNIC = 2;

    public function getProductCategoryId() {
        return $this->aufriProductCategoryId;
    }
}
