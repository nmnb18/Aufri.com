<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractAppController
{
    public function indexAction()
    {
        $loggedin = false;
        if ($loggedin)
        {
            $this->redirect()->toRoute('dashboard');
        }
        else
        {
            $this->redirect()->toRoute('auth', array('action','login'));
        }
        
    }
}