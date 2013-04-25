<?php
/*Webservice for SAP
 * 
 * @Author Kris Planckaert <kris@example.com>
 */

class Application_Model_Producten
{
    /**
     * Add product
     * @param string $titel
     * @param string $omschrijving
     * @param float $prijs
     * @return object $product
     */
    public function addProducts($titel, $omschrijving, $prijs) 
    {
        return func_get_args();
        //$product = stdClass();
        //return $product;
    }
    
    /**
     * Delete the prodct by ID
     * @param int $id
     * @return boolean
     */
    public function deleteProducts ($id)
    {
        return true;
        
    }
    
    /**
     * 
     * @param int $id
     * @param string $titel
     * @param string $omschrijving
     * @param float $prijs
     * @return object $product
     */
    public function modProducts ($id, $titel, $omschrijving, $prijs)
    {
        $product = stdClass();
        return $product;
    }

}

