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
        $productModel = new Application_Model_Productendb();
        $params = array(
            'titel' => $titel,
            'omschrijving' => $omschrijving,
            'prijs' => $prijs,
        );
        $productId = $productModel->toevoegenProduct($params);
        $product = $productModel->getOne($productId);
        return $product;
    }
    
    /**
     * Delete the prodct by ID
     * @param int $id
     * @return boolean
     */
    public function deleteProducts ($id)
    {
        $productModel = new Application_Model_Productendb();
        $productModel->verwijderProduct($id);
        
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
        $productModel = new Application_Model_Productendb();
        $params = array(
            'titel' => $titel,
            'omschrijving' => $omschrijving,
            'prijs' => $prijs,
        );
        $productModel->wijzigenProduct($params, $id);
        return $product;
    }

}

