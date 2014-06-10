<?php
namespace Numir\DataExtractionToolBundle\Classes\Supplier;

class Service
{
    private $_repository;

    public function __construct(Repository $repository)
    {
        $this->_repository = $repository;
    }

    public function getProductsBySupplier($supplierName)
    {
        $products = $this->_repository->getProductsBySupplier($supplierName);
        return $products;
    }
}