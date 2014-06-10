<?php
namespace Numir\DataExtractionToolBundle\Classes\Supplier\Gateway;

class MicroGlobal extends AbstractGateway
{
    private $_helper;

    public function __construct(MicroGlobal\Helper $helper)
    {
        $this->_helper = $helper;
        $this->_initialiseSession();
    }

    public function __destruct()
    {
        $this->_endSession();
    }

    public function getProducts()
    {
        $out = array();
/*
        //get the id's of the brands available
        $brandIds = $this->_helper->getBrandIds();

        //for each brand id, get the products within
        foreach ($brandIds as $brandId) {

            //go to the calatalogue index
            $this->_helper->selectBrand($brandId);

            //get the rows in the products table
            $products = $this->_helper->getProducts();
            
            //add to the output array
            foreach ($products as $product) {
                $out[] = $product;
            }

        }

        file_put_contents('/vagrant/products', serialize($out));
*/
        $out = unserialize(file_get_contents('/vagrant/products')); 

        return $out;
    }

    private function _initialiseSession()
    {
        $this->_helper->login();
        $this->_helper->clickOnTheShoppingCart();
        return;
    }

    private function _endSession()
    {
        $this->_helper->endSession();
        return;
    }
}