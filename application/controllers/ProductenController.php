<?php

class ProductenController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
    }

    public function clientAction()
    {
        // action body
    }

    public function serverAction()
    {
        $this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        // create a wsdl file on the Application_Model_Porducten
        
        $wsdl = $this->_getParam('wsdl');
        if(isset($wsdl)) {
            $server = new Zend_Soap_AutoDiscover();
            $server->setClass('Application_Model_Producten');
            $server->handle();
        } else {
            $server = new Zend_Soap_Server();
            $server->setClass('Application_Model_Producten');
            $server->setObject(new Application_Model_Producten());
            $server->handle();
        }
        
    }


}





