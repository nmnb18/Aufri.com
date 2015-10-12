<?php

namespace Admin\Form;

use Zend\Form\Form;
use Zend\Form\Element;
use Admin\Validators\ProductsInputFilter;
use Application\Model\Products;

class ProductsForm extends Form {

    public function __construct(Products $products) {
        // we want to ignore the name passed
        parent::__construct('products');




        $this->add(array(
            'name' => 'id',
            'type' => 'hidden',
            'attributes' => array(
                'class' => 'form-control',
                'value' => $products->getId()
            ),
        ));
        $this->add(array(
            'name' => 'name',
            'type' => 'Text',
            'attributes' => array(
                'class' => 'form-control',
                'Placeholder' => 'Enter Product Name',
                'maxlength' => 100,
                'value' => $products->getProductName()
            ),
        ));
        $this->add(array(
            'name' => 'price',
            'type' => 'Text',
            'attributes' => array(
                'class' => 'form-control',
                'Placeholder' => 'Enter Product Price',
                'maxlength' => 15,
                'value' => $products->getProductPrice()
            ),
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'category',
            'options' => array(
                'empty_option' => 'Please choose category',
                'value_options' => array(
                    '4' => 'Mumbaiya',
                    '5' => 'Hyderabadi',
                    '2' => 'Indorie',
                    '3' => 'Retro',
                    '1' => 'Bollywood',
                    '6' => 'Delhi 6',
                    '7' => 'Suit Boot'
                ),
            ),
            'attributes' => array(
                'class' => 'form-control country-select',
                'value' => $products->getProductCategory()
            )
        ));
        $this->add(array(
            'type' => 'Zend\Form\Element\MultiCheckbox',
            'name' => 'size',
            'options' => array(
                'value_options' => array(
                    'S' => 'S',
                    'M' => 'M',
                    'L' => 'L',
                    'XL' => 'XL',
                    'XS' => 'XS'
                ),
            ),
            'attributes' => array(
                'class' => 'form-control check-input',
                'value' => $products->getProductSize(),
                'multiple' => 'multiple'
            )
        ));
        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'sleeve',
            'options' => array(
                'empty_option' => 'Please choose Sleeve Length',
                'value_options' => array(
                    'Half' => 'Half',
                    'Full' => 'Full'
                ),
            ),
            'attributes' => array(
                'class' => 'form-control country-select',
                'value' => $products->getProductLength()
            )
        ));
        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'fit',
            'options' => array(
                'empty_option' => 'Please choose fit',
                'value_options' => array(
                    'Slim' => 'Slim Fit',
                    'Regular' => 'Regular Fit'
                ),
            ),
            'attributes' => array(
                'class' => 'form-control country-select',
                'value' => $products->getProductFit()
            )
        ));
        $this->add(array(
            'name' => 'description',
            'type' => 'Zend\Form\Element\Textarea',
            'attributes' => array(
                'class' => 'form-control textareaMargin template tinyMCE',
                'maxlength' => 5000,
                'rows' => 7, // THIS CHANGES THE NUMBER OF ROWS
                'value' => $products->getProductDescription()
            ),
        ));
        $this->add(array(
            'name' => 'image',
            'type' => 'File',
            'attributes' => array(
                'class' => '',
                'value' => $products->getProductImage()
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
        $this->setInputFilter(new ProductsInputFilter());
    }

}
