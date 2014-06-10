<?php
namespace Numir\DataExtractionToolBundle\Classes\Supplier\Gateway;

class AirComputers extends AbstractGateway
{
    private $_helper;

    public function __construct(AirComputers\Helper $helper)
    {
        $this->_helper = $helper;
    }

    public function getProducts()
    {

    }
}