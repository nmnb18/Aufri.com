<?php

namespace Admin\Form;

use Zend\Form\Form as Form;

abstract class AbstractForm extends Form
{

    public function __construct()
    {
        parent::__construct();
        $this->setAttributes(array(
            'enctype' => 'application/x-www-form-urlencoded',
          
        ));
      
    }

}
