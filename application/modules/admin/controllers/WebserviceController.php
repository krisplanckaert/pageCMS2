<?php

class Admin_WebserviceController extends Zend_Controller_Action
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
        $client = new Zend_Soap_Client('http://192.168.33.95/admin/webservice/server?wsdl');
        $client->setSoapVersion(SOAP_1_1); //normaal is het 1.2, voor Zend 1.1
        try {
            $client->addProducts('title', 'Omschrijving', 15);
        } catch (SoapFault $s) {
            Zend_Debug::dump($s->getMessage());
        } catch (Exception $e) {
            Zend_Debug::dump($e->getMessage());
        }
            
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
            $server = new Zend_Soap_Server('http://192.168.33.95/admin/webservice/server?wsdl');
            //$server = new Zend_Soap_Server();
            $server->setClass('Application_Model_Producten');
            $server->setObject(new Application_Model_Producten());
            $server->handle();
        }
    }
}

