<?php
namespace Numir\DataExtractionToolBundle\Classes\Product;

class Service
{
    private $_repository;

    public function __construct(Repository $repository)
    {
        $this->_repository = $repository;
    }

    public function saveProducts(Array $products)
    {
        $this->_repository->saveProducts($products);
        return;
    }

    public function getProductsBySupplier($supplier)
    {
        $products = $this->_repository->getProductsBySupplier($supplier);
        return $products;
    }
}