<?php
namespace Numir\DataExtractionToolBundle\Classes\Product;

class Repository
{
    public $_gateway;

    public function __construct(Gateway $gateway)
    {
        $this->_gateway = $gateway;
    }

    public function saveProducts(Array $products)
    {
        foreach ($products as $product) {
            
            $row = $this->_gateway->getProductBySupplierAndCode($product->getSupplier(),$product->getCode());
            $options = array(
                'supplier' => $product->getSupplier(),
                'code' => $product->getCode(),
                'partNumber' => $product->getPartNumber(),
                'name' => $product->getName(),
                'price' => $product->getPrice(),
                'tax' => $product->getTax(),
                'stock' => $product->getStock(),
                'category' => $product->getCategory(),
                'brand' => $product->getBrand(),
                'manufacturer' => $product->getManufacturer()
            );

            if(!empty($row)) {
                $this->_gateway->updateProduct($row['id'], $options);
            } else {
                $this->_gateway->insertProduct($options);
            }
        }
        
    }

    public function getProductsBySupplier($supplier)
    {
        $products = array();
        $rows = $this->_gateway->getRowsBySupplier($supplier);

        foreach ($rows as $row) {
            $products[] = new \Numir\DataExtractionToolBundle\Classes\Product\Entity($row);
        }

        return $products;
    }
}