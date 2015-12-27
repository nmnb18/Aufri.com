<?php

namespace Application\Model;

use Application\Model\AbstractDbModel;

class Shopkeeper extends AbstractDbModel {

    protected $aufriShopkeeperId;
    protected $aufriShopkeeperName;
    protected $aufriShopkeeperEmail;
    protected $aufriShopkeeperPassword;
    protected $aufriShopkeeperPhone;
    protected $aufriShopkeeperDetails;
    protected $aufriShopkeeperAddressIdFk;
    protected $aufriShopkeeperStatus;

    public function getShopkeeperId() {
        return $this->aufriShopkeeperId;
    }
    public function getShopkeeperName() {
        return $this->aufriShopkeeperName;
    }
    public function getShopkeeperEmail() {
        return $this->aufriShopkeeperEmail;
    }
    public function getShopkeeperPassword() {
        return $this->aufriShopkeeperPassword;
    }
    public function getShopkeeperPhone() {
        return $this->aufriShopkeeperPhone;
    }
    public function getShopkeeperDetails() {
        return $this->aufriShopkeeperDetails;
    }
    public function getShopkeeperStatus() {
        return $this->aufriShopkeeperStatus;
    }
    public function getShopkeeperAddressId() {
        return $this->aufriShopkeeperAddressIdFk;
    }

    public function setShopkeeperId($aufriShopkeeperId) {
        return $this->aufriShopkeeperId = $aufriShopkeeperId;
    }
    public function setShopkeeperName($aufriShopkeeperName) {
        return $this->aufriShopkeeperName = $aufriShopkeeperName;
    }
    public function setShopkeeperEmail($aufriShopkeeperEmail) {
        return $this->aufriShopkeeperEmail = $aufriShopkeeperEmail;
    }
    public function setShopkeeperPassword($aufriShopkeeperPassword) {
        return $this->aufriShopkeeperPassword = $aufriShopkeeperPassword;
    }
    public function setShopkeeperPhone($aufriShopkeeperPhone) {
        return $this->aufriShopkeeperPhone = $aufriShopkeeperPhone;
    }
    public function setShopkeeperDetails($aufriShopkeeperDetails) {
        return $this->aufriShopkeeperDetails = $aufriShopkeeperDetails;
    }
    public function setShopkeeperStatus($aufriShopkeeperStatus) {
        return $this->aufriShopkeeperStatus = $aufriShopkeeperStatus;
    }
    public function setShopkeeperAddressId($aufriShopkeeperAddressIdFk) {
        return $this->aufriShopkeeperAddressIdFk = $aufriShopkeeperAddressIdFk;
    }
}
