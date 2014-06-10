<?php
namespace Numir\DataExtractionToolBundle\Classes\Supplier\Gateway\AirComputers;

use WebDriverCapabilityType;
use RemoteWebDriver;
use WebDriverBy;
use WebDriverExpectedCondition;
use WebDriverSelect;

class Helper
{
    private $_webDriver;

    public function __construct(\RemoteWebDriver $webDriver)
    {
        $this->_webDriver = $webDriver;
    }
}