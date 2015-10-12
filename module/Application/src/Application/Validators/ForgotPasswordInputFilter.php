<?php
/**
* ForgotPasswordInputFilter helps validate and set input fields for forgot password page 
* @author Deepika Verma <deepika.verma@optimusinfo.com>
*/
namespace Application\Validators;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Factory as InputFactory;

class ForgotPasswordInputFilter extends InputFilter
{

     public function __construct() 
     { 
       
        $factory = new InputFactory();

        $this->add(
            $factory->createInput(
                array(
                    'name' => 'email',
                    'required' => true,
                    'filters' => array(
                        array('name' => 'StripTags'),
                        array('name' => 'StringTrim'),
                    ),
                    'validators' => array(
                        array(
                            'name' => 'NotEmpty',
                            'break_chain_on_failure' => true,
                            'options' => array(
                                'messages' => array(
                                    'isEmpty' => 'Please enter Email'
                                ),
                            ),
                        ),
                        array(
                            'name' => 'EmailAddress',
                            'options' => array(
                                'useDomainCheck' => false, 
                                'messages' => array(
                                    'emailAddressInvalidFormat'
                                    => 'Please provide a valid Email'),
                            ),
                        ),
                    ),
                )
            )
        );
      
        }

}
