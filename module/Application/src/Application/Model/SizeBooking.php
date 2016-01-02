<?php

namespace Application\Model;

use Application\Model\AbstractDbModel;

class SizeBooking extends AbstractDbModel {

    protected $aufriProductSizeBookingId;
    protected $aufriProductSizeProductid;
    protected $aufriProductSizeBookingSize;
    protected $aufriProductSizeBookingDates;

    public function getProductSizeBookingId() {
        return $this->aufriProductSizeBookingId;
    }
    public function getProductSizeProductId() {
        return $this->aufriProductSizeProductid;
    }
    public function getProductSizeBookingSize() {
        return $this->aufriProductSizeBookingSize;
    }
    public function getProductSizeBookingDates() {
        return $this->aufriProductSizeBookingDates;
    }

    public function setProductSizeBookingId($aufriProductSizeBookingId) {
        return $this->aufriProductSizeBookingId = $aufriProductSizeBookingId;
    }
    public function setProductSizeProductId($aufriProductSizeProductid) {
        return $this->aufriProductSizeProductid = $aufriProductSizeProductid;
    }
    public function setProductSizeBookingSize($aufriProductSizeBookingSize) {
        return $this->aufriProductSizeBookingSize = $aufriProductSizeBookingSize;
    }
    public function setProductSizeBookingDates($aufriProductSizeBookingDates) {
        return $this->aufriProductSizeBookingDates = $aufriProductSizeBookingDates;
    }
}
