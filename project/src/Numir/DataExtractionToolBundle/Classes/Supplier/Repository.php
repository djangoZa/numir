<?php
namespace Numir\DataExtractionToolBundle\Classes\Supplier;

class Repository
{
    private $_airComputersGateway;
    private $_microGlobalGateway;

    public function __construct(
        Gateway\AirComputers $airComputersGateway,
        Gateway\MicroGlobal $microGlobalGateway
    )
    {
        $this->_airComputersGateway = $airComputersGateway;
        $this->_microGlobalGateway = $microGlobalGateway;
    }

    public function getProductsBySupplier($supplierName)
    {
        $out = array();
        $products = array();

        switch ($supplierName) {
            case 'airComputers':
                $products = $this->_airComputersGateway->getProducts();
                break;
            case 'microGlobal':
                $products = $this->_microGlobalGateway->getProducts();
            default;
                break;
        }
        if (!empty($products)) {
            foreach ($products as $product) {
                $out[] = new \Numir\DataExtractionToolBundle\Classes\Product\Entity($product);
            }    
        }

        return $out;
    }
}