<?php
function get_technicians()
{
    try 
    {
        global $db;
        $query = "SELECT * FROM technicians";
        $statement = $db->prepare($query);
        $statement->execute();
        $technicians = $statement->fetchAll();
        $statement->closeCursor();
        return $technicians;
    }
    catch(PDOException $e)
    {
        $error_message = $e->getMessage();
        include('../errors/database_error.php');
        exit();
    }
}

function get_technician_by_email($email)
{
    try
    {
        global $db;
        $query = "SELECT * FROM technicians WHERE email = :email";
        $statement = $db->prepare($query);
        $statement->bindValue(':email', $email);
        $statement->execute();
        $technician = $statement->fetch();
        $statement->closeCursor();
        return $technician;
    } 
    catch (Exception $e) 
    {
        $error_message = $e->getMessage();
        include('../errors/database_error.php');
        exit();
    }
}

function get_technicians_with_incidents()
{
    try
    {
        global $db;
        $query = "SELECT techID, firstName, lastName, email, phone, password, (SELECT COUNT(*) FROM incidents WHERE technicians.techID = incidents.techID) AS openIncidents FROM technicians";
        $statement = $db->prepare($query);
        $statement->execute();
        $technicians = $statement->fetchAll();
        $statement->closeCursor();
        return $technicians;
    } 
    catch (PDOException $e) 
    {
        $error_message = $e->getMessage();
        include('../errors/database_error.php');
        exit();
    }
}

function delete_technician($technician_id)
{
    try
    {
        global $db;
        $query = "DELETE FROM technicians WHERE techID = :technician_id";
        $statement = $db->prepare($query);
        $statement->bindValue(":technician_id", $technician_id);
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

function add_technician($first_name, $last_name, $email, $phone, $password)
{
    try
    {
        global $db;
        $query = "INSERT INTO technicians (firstName, lastName, email, password, phone) VALUES (:first_name, :last_name, :email, :phone, :password)";
        $statement = $db->prepare($query);
        $statement->bindValue(":first_name", $first_name);
        $statement->bindValue(":last_name", $last_name);
        $statement->bindValue(":email", $email);
        $statement->bindValue(":phone", $phone);
        $statement->bindValue(":password", $password);
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