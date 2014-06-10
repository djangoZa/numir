<?php
namespace Numir\DataExtractionToolBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\ContainerAware;
use WebDriverCapabilityType;
use RemoteWebDriver;
use WebDriverBy;
use WebDriverExpectedCondition;
use WebDriverSelect;

class ProductController extends Controller
{
    public function indexAction($supplier)
    {   
        $productService = $this->container->get('product.service');
        $products = $productService->getProductsBySupplier($supplier);

        return $this->render('NumirDataExtractionToolBundle:Product:index.html.php', array(
            'supplier' => $supplier,
            'products' => $products
        ));
    }

    public function updateProductsAction($supplier)
    {
        $supplierService = $this->container->get('supplier.service');
        $productService = $this->container->get('product.service');

        $products = $supplierService->getProductsBySupplier($supplier);
        $productService->saveProducts($products);

        echo 'done';
        exit(0);
    }
}