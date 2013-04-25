<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
        $data = $this->getAllParams();
        var_dump($data);
    }
    
    public function noaccessAction()
    {
        $this->_helper->layout->disableLayout();
    }


}

