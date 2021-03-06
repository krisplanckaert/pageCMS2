<?php

class UserController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
    }

    public function loginAction()
    {
        $loginForm = new Application_Form_Login();
        $this->view->form = $loginForm;
        
        if($this->getRequest()->getPost()) {
            $postParams = $this->getRequest()->getPost();  // $_POST
            if($this->view->form->isValid($postParams)) {
                $params = $this->view->form->getValues();
                //var_dump($params);exit;
                $auth = Zend_Auth::getInstance();
                //meegeven welke database driver we gebruiken, is optioneel omdat we er momenteel maar 1 hebben
                $authAdapter = new Zend_Auth_Adapter_DbTable(Zend_Registry::get('db'));
                $authAdapter->setTableName('users')
                            ->setIdentityColumn('username')
                            ->setCredentialColumn('password')
                            ->setIdentity($params['Login'])
                            ->setCredential($params['Password']);
                //login uitvoeren
                $result = $auth->authenticate($authAdapter);
                if($result->isValid()) {
                    echo 'U bent ingelogd!';
                } else {
                    //alle foutmeldingen weergeven op het scherm
                    foreach($result->getMessages() as $message) {
                        echo $message;
                    }
                }
            }
        }
    }

    public function logoutAction()
    {
        $auth = Zend_Auth::getInstance();
        $auth->clearIdentity();
    }

}



