<?php
class Application_Model_Productendb extends Zend_Db_Table_Abstract
{
    //definieren hoe de tabel eruit ziet    
    protected $_name = 'producten';
    protected $_primary = 'id';
    
    
    public function getOne($id) 
    {
        $select = $this->select()
                ->where('ID = ?', $id);
        $result = $this->fetchAll($select)->current();
        return $result;
        
    }
    
    public function getAll()
    {
        return $this->fetchAll(); // select * from nieuws                        
    }
    
    public function toevoegenProduct($params) 
    {
        $this->insert($params);        
        
    }
    
    public function wijzigenProduct($params, $id)
    {
         $where  = $this->getAdapter()->quoteInto('id= ?', $id);
         $this->update($params, $where);   
    }       
        
    public function verwijderProduct($id)
    {
         $where  = $this->getAdapter()->quoteInto('id= ?', $id);
         $this->delete($where);   
    }    
        
    
    
    
}
?>
