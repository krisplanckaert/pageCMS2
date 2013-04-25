<?php

class Syntra_Auth_Auth extends Zend_Controller_Plugin_Abstract
{
    public function preDispatch(\Zend_Controller_Request_Abstract $request) 
    {
        $loginController = 'user';
        $loginAction     = 'login';   
        $locale          = Zend_Registry::get('Zend_Locale');
        $auth            = Zend_Auth::getInstance();
        
        //if user is not logged in and is not requesting the login page
        // - redirect to login page
        
        if(!$auth->hasIdentity() 
                && $request->getControllerName() != $loginController
                && $request->getActionName() != $loginAction) {
            $redirector = Zend_Controller_Action_HelperBroker::getStaticHelper('redirector');
            //$redirector->gotoUrl('/nl_BE/login');
        }
        
        if($auth->hasIdentity()) {
            //$auth->clearIdentity();
            //die('Hello user *wave*');
            $registry = Zend_Registry::getInstance();
            //die('test');
            //$acl = $registry->get('Zend_Acl');
            $acl = Zend_Registry::get('Zend_Acl');
            
            $identity = $auth->getIdentity();  //$identity = username
            
            $usersModel = new Application_Model_Users();
            $user = $usersModel->getUserByIdentity($identity);
            $role = $user->role;
            
            //role is een veld binnen onze user tabel
            if($request->getModuleName()!=='' and $request->getModuleName()!=='default' and $request->getModuleName()!==null) {
                //Zend_Debug::dump($request->getModuleName);exit;
                $isAllowed = $acl->isAllowed($role,  // -> role, moet uit Db komen
                                $request->getModuleName().'-'.$request->getControllerName(),
                                $request->getActionName());
                
            } else {
                $isAllowed = $acl->isAllowed($role,  // -> role, moet uit Db komen
                                $request->getControllerName(),
                                $request->getActionName());
            }
            if(!$isAllowed) {
                $redirector = Zend_Controller_Action_HelperBroker::getStaticHelper('redirector');
                $redirector->gotoUrl('/noaccess');
            }
        }
    }
}

?>
