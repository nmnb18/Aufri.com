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
                'value' => $products->getProductId(),
                'required' => 'required'
            ),
        ));

        $this->add(array(
            'name' => 'name',
            'type' => 'Text',
            'attributes' => array(
                'class' => 'form-control',
                'Placeholder' => 'Enter Product Name',
                'maxlength' => 100,
                'value' => $products->getProductName(),
                'required' => 'required'
            ),
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'gender',
            'options' => array(
                'empty_option' => 'Please choose gender',
                'value_options' => array(
                    'Male' => 'Male',
                    'Female' => 'Female',

                ),
            ),
            'attributes' => array(
                'class' => 'form-control country-select',
                'value' => $products->getProductGender(),
                'required' => 'required'
            )
        ));
        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'size',
            'options' => array(
                'empty_option' => 'Please choose Size',
                'value_options' => array(
                    'S' => 'S',
                    'M' => 'M',
                    'L' => 'L',
                    'XL' => 'XL',
                    'XS' => 'XS'
                ),
            ),
            'attributes' => array(
                'class' => 'form-control',
                'value' => $products->getProductSize(),
                'required' => 'required'
            )
        ));
        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'waist',
            'options' => array(
                'empty_option' => 'Please choose Waist',
                'value_options' => array(
                    '28' => '28',
                    '30' => '30'
                ),
            ),
            'attributes' => array(
                'class' => 'form-control country-select',
                'value' => $products->getProductWaist(),
                'required' => 'required'
            )
        ));
        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'category',
            'options' => array(
                'empty_option' => 'Please choose Category',
                'value_options' => array(
                    'test' => 'test',
                    'test1' => 'Test 1'
                ),
            ),
            'attributes' => array(
                'class' => 'form-control country-select',
                'value' => $products->getProductCategory(),
                'required' => 'required'
            )
        ));
        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'color',
            'options' => array(
                'empty_option' => 'Please choose Color',
                'value_options' => array(
                    'Multi color' => 'Multi color',
                    'Red' => 'Red'
                ),
            ),
            'attributes' => array(
                'class' => 'form-control country-select',
                'value' => $products->getProductColor(),
                'required' => 'required'
            )
        ));
        $this->add(array(
            'name' => 'rent',
            'type' => 'Text',
            'attributes' => array(
                'class' => 'form-control',
                'Placeholder' => 'Enter Rent',
                'maxlength' => 100,
                'value' => $products->getProductRent()
            ),
        ));
        $this->add(array(
            'name' => 'security',
            'type' => 'Text',
            'attributes' => array(
                'class' => 'form-control',
                'Placeholder' => 'Enter Security Amount',
                'maxlength' => 100,
                'value' => $products->getProductSecurity(),
                'required' => 'required'
            ),
        ));
        $this->add(array(
            'name' => 'stock',
            'type' => 'Text',
            'attributes' => array(
                'class' => 'form-control',
                'Placeholder' => 'Enter Product Stock',
                'maxlength' => 100,
                'value' => $products->getProductStock(),
                'required' => 'required'
            ),
        ));

        $this->add(array(
            'name' => 'description',
            'type' => 'Zend\Form\Element\Textarea',
            'attributes' => array(
                'class' => 'form-control textareaMargin template tinyMCE',
                'maxlength' => 5000,
                'rows' => 7, // THIS CHANGES THE NUMBER OF ROWS
                'value' => $products->getProductDescription(),
                'required' => 'required'
            ),
        ));

        $this->add(array(
            'name' => 'seotags',
            'type' => 'Zend\Form\Element\Textarea',
            'attributes' => array(
                'class' => 'form-control textareaMargin template tinyMCE',
                'maxlength' => 5000,
                'rows' => 7, // THIS CHANGES THE NUMBER OF ROWS
                'value' => $products->getProductSeotags(),
                'required' => 'required'
            ),
        ));

        $this->add(array(
            'name' => 'actualcost',
            'type' => 'Text',
            'attributes' => array(
                'class' => 'form-control',
                'value' => $products->getProductActualcost(),
                'required' => 'required'
            ),
        ));

        $this->add(array(
            'name' => 'brand',
            'type' => 'Text',
            'attributes' => array(
                'class' => 'form-control',
                'value' => $products->getProductBrand(),
                'required' => 'required'
            ),
        ));

        $this->add(array(
            'name' => 'designer',
            'type' => 'Text',
            'attributes' => array(
                'class' => 'form-control',
                'value' => $products->getProductDesigner(),
                'required' => 'required'
            ),
        ));

        $this->add(array(
            'name' => 'occassion',
            'type' => 'Text',
            'attributes' => array(
                'class' => 'form-control',
                'value' => $products->getProductOccassion(),
                'required' => 'required'
            ),
        ));

        $this->add(array(
            'name' => 'fromdate',
            'type' => 'date',
            'attributes' => array(
                'class' => 'form-control',
                'value' => $products->getProductFromdate(),
                'required' => 'required'
            ),
        ));

        $this->add(array(
            'name' => 'todate',
            'type' => 'date',
            'attributes' => array(
                'class' => 'form-control',
                'value' => $products->getProductTodate(),
                'required' => 'required'
            ),
        ));
        $this->add(array(
            'name' => 'image',
            'type' => 'File',
            'attributes' => array(
                'class' => '',
                'value' => $products->getProductImage(),
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
