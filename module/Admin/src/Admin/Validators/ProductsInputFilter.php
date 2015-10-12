<?php

namespace Admin\Validators;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\Input;

class ProductsInputFilter extends InputFilter {

    public function __construct() {

        $factory = new InputFactory();



        $this->add($factory->createInput(array(
                    'name' => 'name',
                    'required' => true,
                    'filters' => array(
                        array('name' => 'StripTags'),
                        array('name' => 'StringTrim')
                    ),
                    'validators' => array(
                        array(
                            'name' => 'NotEmpty',
                            'options' => array(
                                'messages' => array(
                                    'isEmpty' =>
                                    'Please enter Tour Name'
                                ),
                            ),
                        ),
                        array(
                            'name' => 'StringLength',
                            'options' => array(
                                'encoding' => 'UTF-8',
                                'max' => 100,
                            ),
                        )

                    ),
        )));
        $this->add($factory->createInput(array(
                    'name' => 'price',
                    'required' => false,
                    'filters' => array(
                        array('name' => 'StripTags'),
                        array('name' => 'StringTrim')
                    ),
                    'validators' => array(
                        array(
                            'name' => 'StringLength',
                            'options' => array(
                                'encoding' => 'UTF-8',

                            ),
                        )
                    ),
        )));


        $this->add($factory->createInput(array(
                'name' => 'category',
                'required' => false,
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim')
                ),
            )));
        $this->add($factory->createInput(array(
                    'name' => 'description',
                    'required' => true,
                    'filters' => array(
                        array('name' => 'StripTags'),
                        array('name' => 'StringTrim')
                    ),
                    'validators' => array(
                        array(
                            'name' => 'NotEmpty',
                            'options' => array(
                                'messages' => array(
                                    'isEmpty' =>
                                    'Please enter Details'
                                ),
                            ),
                        ),
                        array(
                            'name' => 'StringLength',
                            'options' => array(
                                'encoding' => 'UTF-8',
                                'max' => 5000,
                            ),
                        )
                    ),
        )));
        $this->add($factory->createInput(array(
                    'name' => 'image',
                    'required' => false,
                    'filters' => array(
                        array('name' => 'StripTags'),
                        array('name' => 'StringTrim'),
                    ),
        )));
    }

}
