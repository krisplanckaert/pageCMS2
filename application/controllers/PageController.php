<?php

class PageController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $locale = Zend_Registry::get('Zend_Locale');
        //$lang = $this->_getParam('lang'); -> alternatieve manier
        
        $slug = $this->_getParam('slug');
        //var_dump($this->getAllParams());
        $pageModel = new Application_Model_Page();
        $page = $pageModel->getPage($locale, $slug);
        $this->view->page = $page;
    }

}

