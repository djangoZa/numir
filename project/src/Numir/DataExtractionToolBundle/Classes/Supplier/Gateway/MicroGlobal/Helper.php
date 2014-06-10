<?php
namespace Numir\DataExtractionToolBundle\Classes\Supplier\Gateway\MicroGlobal;

use WebDriverCapabilityType;
use RemoteWebDriver;
use WebDriverBy;
use WebDriverExpectedCondition;
use WebDriverSelect;

class Helper
{
    private $_webDriver;
    private $_loginUrl = 'http://www.microglobal.com.ar/section/view/22';
    private $_supplierName = 'MicroGlobal';
    private $_username = '304';
    private $_password = '2014';

    public function __construct(\RemoteWebDriver $webDriver)
    {
        $this->_webDriver = $webDriver;
    }

    public function login()
    {
        //go to the log in page
        $this->_webDriver->get($this->_loginUrl);

        //enter the username
        $this->_webDriver->findElement(WebDriverBy::id('nrocliente'))->sendKeys($this->_username);

        //enter the password
        $this->_webDriver->findElement(WebDriverBy::id('pass'))->sendKeys($this->_password);

        //click the login button
        $this->_webDriver->findElement(WebDriverBy::xpath('//button[@value="login"]'))->click();
    }

    public function clickOnTheShoppingCart()
    {
        $this->_webDriver->findElement(WebDriverBy::xpath('//div[@class="block-cart-header"]/a'))->click();
    }

    public function goToProductCatalogueIndex()
    {
        $this->_webDriver->get("http://ecommerce.microglobal.com.ar/catalogo.aspx?busqueda=productos");
    }

    public function getBrandIds()
    {
        $brandIds = array();

        $this->goToProductCatalogueIndex();

        $selectBoxElement = $this->_webDriver->findElement(WebDriverBy::xpath('//select[@id="cboMarca"]'));
        $selectBoxClient = new WebDriverSelect($selectBoxElement);
        $options = $selectBoxClient->getOptions();
        
        foreach ($options as $option) {
            $value = $option->getAttribute('value');
            if (!empty($value)) {
                $brandIds[] = $value;
            }
        }
        
        return $brandIds;
    }

    public function selectBrand($brandId)
    {
        $this->goToProductCatalogueIndex();

        //select the brand from the drop down
        $selectBoxElement = $this->_webDriver->findElement(WebDriverBy::xpath('//select[@id="cboMarca"]'));
        $selectBoxClient = new WebDriverSelect($selectBoxElement);
        $selectBoxClient->selectByValue($brandId);

        //wait for the page to reload
        sleep(1);

        //click the ok button
        $this->_webDriver->findElement(WebDriverBy::xpath('//input[@type="button" and @name="ok"]'))->click();
    }

    public function getProducts()
    {
        $out = array();
        $rows = $this->_webDriver->findElements(WebDriverBy::xpath('//table[3]/tbody/tr'));

        foreach ($rows as $rowIndex => $row) {
            //skip the header row
            if ($rowIndex > 0) {
                $columns = $row->findElements(WebDriverBy::xpath('td'));
                foreach ($columns as $columnIndex => $column) {
                    $out[$rowIndex]['supplier'] = $this->_supplierName;
                    $text = trim($column->getText());
                    switch($columnIndex) {
                        case 0:
                            $out[$rowIndex]['manufacturer'] = $text;
                            break;
                        case 1:
                            $out[$rowIndex]['brand'] = $text;
                            break;
                        case 2:
                            $out[$rowIndex]['category'] = $text;
                            break;
                        case 3:
                            $out[$rowIndex]['code'] = $text;
                            break;
                        case 4:
                            $out[$rowIndex]['name'] = $text;
                            break;
                        case 5:
                            $out[$rowIndex]['partNumber'] = $text;
                            break;
                        case 6:
                            $out[$rowIndex]['tax'] = $text;
                            break;
                        case 9:
                            $out[$rowIndex]['price'] = trim(str_replace('U$S','',$text));
                            break;
                        case 10:
                            $out[$rowIndex]['stock'] = $text;
                            break;
                    }
                }
            }
        }

        return $out;
    }

    public function takeAScreenshot()
    {
        $this->_webDriver->takeScreenshot("/vagrant/screen.jpg");
    }

    public function endSession()
    {
        $this->_webDriver->quit();
    }
}