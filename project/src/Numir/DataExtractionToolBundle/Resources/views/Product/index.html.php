<?php $view->extend('NumirDataExtractionToolBundle::default.html.php') ?>
<?php $view['slots']->start('body') ?>
<h1><?php echo ucfirst($supplier); ?></h1>
<table class="table table-striped">
    <thead align="left">
        <tr>
            <th>Code</th>
            <th>Part Number</th>
            <th>Name</th>
            <th>Price</th>
            <th>Tax</th>
            <th>Stock</th>
            <th>Category</th>
            <th>Brand</th>
            <th>Manufacturer</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($products as $product): ?>
            <tr>
                <td><?php echo $product->getCode(); ?></td>
                <td><?php echo $product->getPartNumber(); ?></td>
                <td><?php echo $product->getName(); ?></td>
                <td><?php echo $product->getPrice(); ?></td>
                <td><?php echo $product->getTax(); ?></td>
                <td><?php echo $product->getStock(); ?></td>
                <td><?php echo $product->getCategory(); ?></td>
                <td><?php echo $product->getBrand(); ?></td>
                <td><?php echo $product->getManufacturer(); ?></td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>
<?php $view['slots']->stop() ?>