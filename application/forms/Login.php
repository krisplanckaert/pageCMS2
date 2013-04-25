<?php

class Application_Form_Login extends Zend_Form 
{
    public function init() 
    {
        $locale = Zend_Registry::get('Zend_Locale');
        $url = '/'.$locale . '/login';
        
        $this->setMethod('post');
        $this->setAttrib('enctype', 'mutipart/form-data');
        
        //login
        $this->addElement(new Zend_Form_Element_Text('Login', array(
            'label' => 'login_lbl',
            'filters' => array('stringTrim'),
            'required' => true,
            
        )));
        
        //Password
        $this->addElement(new Zend_Form_Element_Password('Password', array(
            'label' => 'password_lbl',
            'filters' => array('stringTrim'),
            'required' => true,
            
        )));
        
        $btn = new Zend_Form_Element_Button('submit', array(
            'type' => 'submit',
            'value' => 'submit_lbl',
            'required' => false,
            'ignore' => true,
        ));
        
        $this->addElement($btn);
    }
}

?>
