<?php
namespace Numir\DataExtractionToolBundle\Classes\Product;

class Entity
{
    private $_supplier;
    private $_code;
    private $_partNumber;
    private $_name;
    private $_description;
    private $_price;
    private $_tax;
    private $_stock;
    private $_category;
    private $_brand;
    private $_manufacturer;

    public function __construct(Array $options)
    {
        $this->_supplier = $options['supplier'];
        $this->_code = $options['code'];
        $this->_partNumber = $options['partNumber'];
        $this->_name = $options['name'];
        $this->_price = $options['price'];
        $this->_tax = $options['tax'];
        $this->_stock = $options['stock'];
        $this->_category = $options['category'];
        $this->_brand = $options['brand'];
        $this->_manufacturer = $options['manufacturer'];
    }

    public function getSupplier()
    {
        return $this->_supplier;
    }

    public function getCode()
    {
        return $this->_code;
    }

    public function getPartNumber()
    {
        return $this->_partNumber;
    }

    public function getName()
    {
        return $this->_name;
    }

    public function getPrice()
    {
        return $this->_price;
    }

    public function getTax()
    {
        return $this->_tax;
    }

    public function getStock()
    {
        return $this->_stock;
    }

    public function getCategory()
    {
        return $this->_category;
    }

    public function getBrand()
    {
        return $this->_brand;
    }

    public function getManufacturer()
    {
        return $this->_manufacturer;
    }
}