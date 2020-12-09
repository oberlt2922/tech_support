<?php

function get_products()
{
    try
    {
        global $db;
        $query = 'SELECT * FROM products';
        $statement = $db->prepare($query);
        $statement->execute();
        $products = $statement->fetchAll();
        $statement->closeCursor();
        return $products;
    }
    catch(PDOException $e)
    {
        $error_message = $e->getMessage();
        include('../errors/database_error.php');
        exit();
    }
}

function get_products_in_order()
{
    try
    {
        global $db;
        $query = 'SELECT * FROM products ORDER BY name';
        $statement = $db->prepare($query);
        $statement->execute();
        $products = $statement->fetchAll();
        $statement->closeCursor();
        return $products;
    }
    catch(PDOException $e)
    {
        $error_message = $e->getMessage();
        include('../errors/database_error.php');
        exit();
    }
}

function delete_product($product_code)
{
    try
    {
        global $db;
        $query = 'DELETE FROM products WHERE productCode = :product_code';
        $statement = $db->prepare($query);
        $statement->bindValue(':product_code', $product_code);
        $statement->execute();
        $statement->closeCursor();
    }
    catch(PDOException $e)
    {
        $error_message = $e->getMessage();
        include('../errors/database_error.php');
        exit();
    }
}

function add_product($product_code, $name, $version, $release_date)
{
    try
    {
        global $db;
        $query = 'INSERT INTO products (productCode, name, version, releaseDate) VALUES (:product_code, :name, :version, :release_date)';
        $statement = $db->prepare($query);
        $statement->bindValue(':product_code', $product_code);
        $statement->bindValue(':name', $name);
        $statement->bindValue(':version', $version);
        $statement->bindValue(':release_date', $release_date);
        $statement->execute();
        $statement->closeCursor();
    }
    catch(PDOException $e)
    {
        $error_message = $e->getMessage();
        include('../errors/database_error.php');
        exit();
    }
}

?>
