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
                    '1' => 'Male',
                    '2' => 'Female',

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
                    '1' => 'Western',
                    '2' => 'Ethnic'
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
            'name' => 'subcategory',
            'options' => array(
                'empty_option' => 'Please choose Sub-Category',
                'value_options' => array(
                    '1' => 'Jump Suits',
                    '2' => 'Maxis',
                    '3' => 'One piece',
                    '4' => 'Gowns',
                    '5' => 'Skirts',
                    '6' => 'Coat',
                    '7' => 'Sherwani',
                    '8' => 'Indo-Western',
                    '9' => 'Waist-Coat',
                    '10' => 'Kurta-Pyajama',
                    '11' => 'Lehenga',
                    '12' => 'Gowns',
                    '13' => 'Suits-Kurtis',
                    '14' => 'Sarees',
                    '15' => 'Anarkalis',
                    '16' => 'Indo-Western'
                ),
            ),
            'attributes' => array(
                'class' => 'form-control country-select',
                'value' => $products->getProductSubcategory(),
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
            'type' => 'Zend\Form\Element\Select',
            'name' => 'stock',
            'options' => array(
                'empty_option' => 'Select stock',
                'value_options' => array(
                    'In stock' => 'In stock',
                    'Out of stock' => 'Out of stock'
                ),
            ),
            'attributes' => array(
                'class' => 'form-control country-select',
                'value' => $products->getProductStock(),
                'required' => 'required'
            )
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
