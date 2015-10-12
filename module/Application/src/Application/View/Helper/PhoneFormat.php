<?php
namespace Application\View\Helper;
use Zend\View\Helper\AbstractHelper;
 
class PhoneFormat extends AbstractHelper{
 
	public function __invoke($number=''){
		
    	if(  preg_match( '/^(\d{3})(\d{3})(\d{4})$/', $number,  $matches ) )
    	{
    		$result = $matches[1] . '-' .$matches[2] . '-' . $matches[3];
    		return $result;
    	}
    }
}