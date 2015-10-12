<?php

namespace Application\Form;

use Application\Form\AbstractForm;
use Application\Validators\ForgotPasswordInputFilter;

class ForgotPasswordForm extends AbstractForm {

    public function __construct() { 
        parent::__construct('forgotPassword');

        $this->add(array(
            'name' => 'email',
            'type' => 'Text',
            'attributes' => array(
                'id' => 'email',
                'class' => 'form-control',
                'Placeholder' => 'Enter Email'
            ), 
        ));

        $this->add(array(
            'name' => 'submit',
            'type' => 'Submit',
            'attributes' => array(
                'value' => 'Get Password',
                'id' => 'btn-signup',
                'class' => 'btn btn-success ml20'
            ),
        ));
        $this->setInputFilter(new ForgotPasswordInputFilter());
    }

}
