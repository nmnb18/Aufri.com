<?php
namespace Application\View\Helper;
use Zend\View\Helper\AbstractHelper;

class DateFormat extends AbstractHelper{
 
	public function __invoke($date=''){
		
        $internalDate = null;
        if ($date instanceof DateAttribute)
        {
            $internalDate = $date->getValue();
        }
        else
        {
            $internalDate = $date;
        }

        if ($internalDate == null)
        {
            return "--/--/--";
        }
        return date_format($internalDate, "d/m/y");
    }
}