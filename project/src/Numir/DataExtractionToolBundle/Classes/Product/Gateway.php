<?php
namespace Numir\DataExtractionToolBundle\Classes\Product;

use Zend\Db\Sql\Sql;

class Gateway
{
    public $_dbAdapter;

    public function __construct(\Zend\Db\Adapter\Adapter $dbAdapter)
    {
        $this->_dbAdapter = $dbAdapter;
    }

    public function getRowsBySupplier($supplier)
    {
        $out = array();

        $sql = new Sql($this->_dbAdapter);
        $select = $sql->select();
        $select->from('products');
        $select->where(array(
            'supplier' => $supplier
        ));

        $statement = $sql->prepareStatementForSqlObject($select);
        $results = $statement->execute();
        
        foreach ($results as $row) {
            $out[] = $row;
        }

        return $out;
    }

    public function getProductBySupplierAndCode($supplier, $code)
    {
        $sql = new Sql($this->_dbAdapter);
        $select = $sql->select();
        $select->from('products');
        $select->where(array(
            'supplier' => $supplier,
            'code' => $code
        ));

        $statement = $sql->prepareStatementForSqlObject($select);
        $results = $statement->execute();
        $row = $results->current();

        return $row;
    }

    public function updateProduct($id, $options)
    {
        $sql = new Sql($this->_dbAdapter);
        $update = $sql->update();
        $update->table('products');
        $update->set($options);
        $update->where(array('id' => $id));

        $statement = $sql->prepareStatementForSqlObject($update);
        $statement->execute();

        return;
    }

    public function insertProduct(Array $options)
    {
        $sql = new Sql($this->_dbAdapter);
        $insert = $sql->insert('products');
        $insert->values($options);
        $statement = $sql->prepareStatementForSqlObject($insert);
        $statement->execute();
        return;
    }
}