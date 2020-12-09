<?php
function admin_login($username, $password)
{
    try
    {
        global $db;
        $query = 'SELECT * FROM administrators WHERE username = :username AND password = :password';
        $statement = $db->prepare($query);
        $statement->bindValue(':username', $username);
        $statement->bindValue(':password', $password);
        $statement->execute();
        $admin = $statement->fetch();
        $statement->closeCursor();
        if($admin)
        {
            return $admin;
        }
        else
        {
            return FALSE;
        }
    }
    catch(PDOException $e)
    {
        $error_message = $e->getMessage();
        include('../errors/database_error.php');
        exit();
    }
}

function technician_login($email, $password)
{
    try
    {
        global $db;
        $query = 'SELECT * FROM technicians WHERE email = :email AND password = :password';
        $statement = $db->prepare($query);
        $statement->bindValue(':email', $email);
        $statement->bindValue(':password', $password);
        $statement->execute();
        $technician = $statement->fetch();
        $statement->closeCursor();
        if($technician)
        {
            return $technician;
        }
        else
        {
            return FALSE;
        }
    }
    catch(PDOException $e)
    {
        $error_message = $e->getMessage();
        include('../errors/database_error.php');
        exit();
    }
}

function customer_login($email, $password)
{
    try
    {
        global $db;
        $query = 'SELECT * FROM customers WHERE email = :email AND password = :password';
        $statement = $db->prepare($query);
        $statement->bindValue(':email', $email);
        $statement->bindValue(':password', $password);
        $statement->execute();
        $customer = $statement->fetch();
        $statement->closeCursor();
        if($customer)
        {
            return $customer;
        }
        else
        {
            return FALSE;
        }
    }
    catch(PDOException $e)
    {
        $error_message = $e->getMessage();
        include('../errors/database_error.php');
        exit();
    }
}
?>