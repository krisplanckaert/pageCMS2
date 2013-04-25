<?php

class Syntra_Controller_Plugin_Navigation extends Zend_Controller_Plugin_Abstract 
{
    public function preDispatch(\Zend_Controller_Request_Abstract $request) 
    {
        /*cache aanmaken */
        $frontendOptions = array(
            'lifetime' => 3600, // 1 uur in de cache
            'automatic_serialization' => true,
        );
        
        //var_dump(realpath(APPLICATION_PATH.'/../cache'));exit;
        
        $backendOptions = array(
            'cache_dir' => APPLICATION_PATH.'/../cache'
        );
        
        $cache = Zend_Cache::factory('Core',
                                     'File',
                                     $frontendOptions,
                                     $backendOptions
                                     );
        
        // bestaat de cache met naam navigation
        if(($result = $cache->load('navigation'))===false) {
            //Deze bestaat niet
            $locale = Zend_Registry::get('Zend_Locale');
            $model = new Application_Model_Page();
            $pages = $model->getMenu($locale);

            $container = new Zend_Navigation();

            //Zend_Debug::dump($pages);exit;
            foreach($pages as $page) {
                $menu = new Zend_Navigation_Page_Mvc(
                            array(
                                'label' =>$page['title'],
                                //'controller' => 'index',
                                'route' => 'page',
                                'params' => array('slug' => $page['slug'],
                                                  'lang' => $locale)
                            )
                        );
                $container->addPage($menu);
            }
            //Zend_Debug::dump($container);exit;
            $cache->save($container, 'navigation');
        } else {
            $container = $result;
            //echo 'we zitten in de cache!';
        }
        Zend_Registry::set('Zend_Navigation', $container);
    }
}

?>
