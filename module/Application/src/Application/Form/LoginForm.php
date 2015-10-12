<?php

namespace Application\Form;

use Application\Form\AbstractForm;
use Application\Validators\LogInInputFilter;

class LoginForm extends AbstractForm {

    public function __construct() {
        // we want to ignore the name passed
        parent::__construct('login');


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
            'name' => 'password',
            'type' => 'Password',
            'attributes' => array(
                'id' => 'password',
                'class' => 'form-control',
                'Placeholder' => 'Enter Password'
            ),
        ));

        $this->add(array(
            'name' => 'submit',
            'type' => 'Submit',
            'attributes' => array(
                'value' => 'Login',
                'id' => 'btn-login',
                'class' => 'btn btn-success mr5'
            ),
        ));
        $this->setInputFilter(new LogInInputFilter());
    }

}
