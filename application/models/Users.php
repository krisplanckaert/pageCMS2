<?php

class Application_Model_Users extends Zend_Db_Table_Abstract 
{
    protected $_name = 'users';
    protected $_primary = 'id';

    /**
     * 
     * @param Zend_Auth $identity
     * @return Zend_Db_Table_Rowset
     */
    public function getUserByIdentity($identity) 
    {
        $select = $this->select()->where('username = ?', $identity);
        $result = $this->fetchAll($select)->current();
        
        return $result;
    }
}

