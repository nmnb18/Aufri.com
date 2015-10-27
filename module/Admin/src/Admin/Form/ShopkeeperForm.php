<?php

namespace Admin\Form;

use Zend\Form\Form;
use Zend\Form\Element;
use Application\Model\Shopkeeper;
use Application\Model\Address;

class ShopkeeperForm extends Form {

    public function __construct(Shopkeeper $shopkeeper, Address $address) {
        // we want to ignore the name passed
        parent::__construct('shopkeeper');
        $this->add(array(
            'name' => 'id',
            'type' => 'hidden',
            'attributes' => array(
                'class' => 'form-control',
                'value' => $shopkeeper->getShopkeeperId(),
                'required' => 'required'
            ),
        ));

        $this->add(array(
            'name' => 'name',
            'type' => 'Text',
            'attributes' => array(
                'class' => 'form-control',
                'Placeholder' => 'Enter Shopkeeper Name',
                'maxlength' => 100,
                'value' => $shopkeeper->getShopkeeperName(),
                'required' => 'required'
            ),
        ));

        $this->add(array(
            'name' => 'email',
            'type' => 'Text',
            'attributes' => array(
                'class' => 'form-control',
                'Placeholder' => 'Enter Shopkeeper Email',
                'maxlength' => 100,
                'value' => $shopkeeper->getShopkeeperEmail(),
                'required' => 'required'
            ),
        ));
        $this->add(array(
            'name' => 'phoneno',
            'type' => 'Text',
            'attributes' => array(
                'class' => 'form-control',
                'Placeholder' => 'Enter Shopkeeper Phone No',
                'maxlength' => 100,
                'value' => $shopkeeper->getShopkeeperPhone(),
                'required' => 'required'
            ),
        ));
        $this->add(array(
            'name' => 'city',
            'type' => 'Text',
            'attributes' => array(
                'class' => 'form-control',
                'Placeholder' => 'Enter City',
                'maxlength' => 100,
                'value' => $address->getAddressCity(),
                'required' => 'required'
            ),
        ));
        $this->add(array(
            'name' => 'pincode',
            'type' => 'Text',
            'attributes' => array(
                'class' => 'form-control',
                'Placeholder' => 'Enter pincode',
                'maxlength' => 100,
                'value' => $address->getAddressPincode(),
                'required' => 'required'
            ),
        ));
        $this->add(array(
            'name' => 'address',
            'type' => 'Zend\Form\Element\Textarea',
            'attributes' => array(
                'class' => 'form-control',
                'Placeholder' => 'Enter Address',
                'rows' => 7,
                'maxlength' => 100,
                'value' => $address->getAddressAddress(),
                'required' => 'required'
            ),
        ));
        $this->add(array(
            'name' => 'landmark',
            'type' => 'Text',
            'attributes' => array(
                'class' => 'form-control',
                'Placeholder' => 'Enter LandMark',
                'maxlength' => 100,
                'value' => $address->getAddressLandmark(),
                'required' => 'required'
            ),
        ));
        $this->add(array(
            'name' => 'details',
            'type' => 'Zend\Form\Element\Textarea',
            'attributes' => array(
                'class' => 'form-control textareaMargin template tinyMCE',
                'maxlength' => 5000,
                'rows' => 7, // THIS CHANGES THE NUMBER OF ROWS
                'value' => $shopkeeper->getShopkeeperDetails(),
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
