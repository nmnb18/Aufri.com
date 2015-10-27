<?php

namespace Application\Model;

use Application\Model\AbstractDbModel;

class Address extends AbstractDbModel {

    protected $aufriAddressId;
    protected $aufriAddressCity;
    protected $aufriAddressPincode;
    protected $aufriAddressAddress;
    protected $aufriAddressLandmark;
    protected $aufriAddressUserIdFk;
    protected $aufriAddressShopkeeperIdFk;

    public function getAddressId() {
        return $this->aufriAddressId;
    }
    public function getAddressCity() {
        return $this->aufriAddressCity;
    }
    public function getAddressPincode() {
        return $this->aufriAddressPincode;
    }
    public function getAddressAddress() {
        return $this->aufriAddressAddress;
    }
    public function getAddressLandmark() {
        return $this->aufriAddressLandmark;
    }
    public function getAddressUserIdFk() {
        return $this->aufriAddressUserIdFk;
    }
    public function getAddressShopkeeperIdFk() {
        return $this->aufriAddressShopkeeperIdFk;
    }

    public function setAddressId($aufriAddressId) {
        return $this->aufriAddressId = $aufriAddressId;
    }
    public function setAddressCity($aufriAddressCity) {
        return $this->aufriAddressCity = $aufriAddressCity;
    }
    public function setAddressPincode($aufriAddressPincode) {
        return $this->aufriAddressPincode = $aufriAddressPincode;
    }
    public function setAddressAddress($aufriAddressAddress) {
        return $this->aufriAddressAddress = $aufriAddressAddress;
    }
    public function setAddressLandmark($aufriAddressLandmark) {
        return $this->aufriAddressLandmark = $aufriAddressLandmark;
    }
    public function setAddressUserIdFk($aufriAddressUserIdFk) {
        return $this->aufriAddressUserIdFk = $aufriAddressUserIdFk;
    }
    public function setAddressShopkeeperIdFk($aufriAddressShopkeeperIdFk) {
        return $this->aufriAddressShopkeeperIdFk = $aufriAddressShopkeeperIdFk;
    }

}
