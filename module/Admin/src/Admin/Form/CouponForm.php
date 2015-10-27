<?php

namespace Admin\Form;

use Zend\Form\Form;
use Zend\Form\Element;
use Application\Model\Coupon;

class CouponForm extends Form {

    public function __construct(Coupon $coupon) {
        // we want to ignore the name passed
        parent::__construct('coupon');
        $this->add(array(
            'name' => 'id',
            'type' => 'hidden',
            'attributes' => array(
                'class' => 'form-control',
                'value' => $coupon->getCouponId(),
                'required' => 'required'
            ),
        ));

        $this->add(array(
            'name' => 'name',
            'type' => 'Text',
            'attributes' => array(
                'class' => 'form-control',
                'Placeholder' => 'Enter Coupon Name',
                'maxlength' => 100,
                'value' => $coupon->getCouponName(),
                'required' => 'required'
            ),
        ));
        $this->add(array(
            'name' => 'code',
            'type' => 'Text',
            'attributes' => array(
                'class' => 'form-control',
                'Placeholder' => 'Enter Coupon Code',
                'maxlength' => 100,
                'value' => $coupon->getCouponCode(),
                'required' => 'required'
            ),
        ));

        $this->add(array(
            'name' => 'startdate',
            'type' => 'date',
            'attributes' => array(
                'class' => 'form-control',
                'Placeholder' => 'Start date',
                'maxlength' => 100,
                'value' => $coupon->getCouponStartdate(),
                'required' => 'required'
            ),
        ));
        $this->add(array(
            'name' => 'enddate',
            'type' => 'date',
            'attributes' => array(
                'class' => 'form-control',
                'Placeholder' => 'End date',
                'maxlength' => 100,
                'value' => $coupon->getCouponEnddate(),
                'required' => 'required'
            ),
        ));
        $this->add(array(
            'name' => 'discount',
            'type' => 'Text',
            'attributes' => array(
                'class' => 'form-control',
                'Placeholder' => 'Enter Discount',
                'maxlength' => 100,
                'value' => $coupon->getCouponDiscount(),
                'required' => 'required'
            ),
        ));
        $this->add(array(
            'name' => 'availfor',
            'type' => 'Text',
            'attributes' => array(
                'class' => 'form-control',
                'Placeholder' => 'Coupon avail for',
                'maxlength' => 100,
                'value' => $coupon->getCouponAvailFor(),
                'required' => 'required'
            ),
        ));
        $this->add(array(
            'name' => 'minorder',
            'type' => 'Text',
            'attributes' => array(
                'class' => 'form-control',
                'Placeholder' => 'Enter Min order',
                'maxlength' => 100,
                'value' => $coupon->getCouponMinorder(),
                'required' => 'required'
            ),
        ));
        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'type',
            'options' => array(
                'empty_option' => 'Please choose type',
                'value_options' => array(
                    'Flat' => 'Flat',
                    'Percentage' => 'Percentage',
                ),
            ),
            'attributes' => array(
                'class' => 'form-control country-select',
                'value' => $coupon->getCouponType(),
                'required' => 'required'
            )
        ));
        $this->add(array(
            'name' => 'anycount',
            'type' => 'number',
            'attributes' => array(
                'class' => 'form-control',
                'maxlength' => 100,
                'value' => $coupon->getCouponCountForAnyCustomer(),
                'required' => 'required'
            ),
        ));
        $this->add(array(
            'name' => 'singlecount',
            'type' => 'number',
            'attributes' => array(
                'class' => 'form-control',
                'maxlength' => 100,
                'value' => $coupon->getCouponForSingleCustomer(),
                'required' => 'required'
            ),
        ));

        $this->add(array(
            'name' => 'submit',
            'type' => 'Submit',
            'attributes' => array(
                'value' => 'Submit',
                'class' => 'btn btn-success'
            ),
        ));
        //$this->setInputFilter(new ProductsInputFilter());
    }

}
