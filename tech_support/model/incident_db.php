<?php
function get_incidents_by_technician($tech_id)
{
    try
    {
        global $db;
        $query = "SELECT i.incidentID, i.customerID, i.productCode, i.techID, i.dateOpened, i.title, i.description, c.firstName, c.lastName FROM incidents AS i JOIN customers AS c ON i.customerID = c.customerID WHERE techID = :tech_id AND dateClosed IS NULL";
        $statement = $db->prepare($query);
        $statement->bindValue(':tech_id', $tech_id);
        $statement->execute();
        $incidents = $statement->fetchAll();
        $statement->closeCursor();
        return $incidents;
    }
    catch(PDOException $e)
    {
        $error_message = $e->getMessage();
        include('../errors/database_error.php');
        exit();
    }
}

function add_incident($customer_id, $product_code, $date_opened, $title, $description)
{
    try
    {
        global $db;
        $query = 'INSERT INTO incidents (customerID, productCode, dateOpened, title, description) VALUE (:customer_id, :product_code, :date_opened, :title, :description)';
        $statement = $db->prepare($query);
        $statement->bindValue(':customer_id', $customer_id);
        $statement->bindValue(':product_code', $product_code);
        $statement->bindValue(':date_opened', $date_opened);
        $statement->bindValue(':title', $title);
        $statement->bindValue(':description', $description);
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

function get_unassigned_incidents_for_assign()
{
    try
    {
       global $db;
       $query = 'SELECT i.incidentID, c.firstName, c.lastName, i.productCode, i.dateOpened, i.title, i.description FROM incidents AS i JOIN customers AS c ON i.customerID = c.customerID WHERE techID IS NULL';
       $statement = $db->prepare($query);
       $statement->execute();
       $incidents = $statement->fetchAll();
       $statement->closeCursor();
       return $incidents;
    } 
    catch (PDOException $e) 
    {
        $error_message = $e->getMessage();
        include('../errors/database_error.php');
        exit();
    }
}

function get_unassigned_incidents_for_display()
{
    try
    {
        global $db;
        $query = "SELECT CONCAT(c.firstName, ' ', c.lastName) AS customerName, p.name, i.incidentID, i.dateOpened, i.title, i.description, i.techID FROM incidents AS i JOIN customers AS c ON i.customerID = c.customerID JOIN products AS p ON i.productCode = p.productCode WHERE techID IS NULL";
        $statement = $db->prepare($query);
        $statement->execute();
        $incidents = $statement->fetchAll();
        $statement->closeCursor();
        return $incidents;
    } 
    catch (Exception $e) 
    {
        $error_message = $e->getMessage();
        include('../errors/database_error.php');
        exit();
    }
}

function get_assigned_incidents_for_display()
{
    try
    {
        global $db;
        $query = "SELECT CONCAT(c.firstName, ' ', c.lastName) AS customerName, CONCAT(t.firstName, ' ', t.lastName) AS technicianName, p.name, i.incidentID, i.dateOpened, i.dateClosed, i.title, i.description, i.techID FROM incidents AS i JOIN customers AS c ON i.customerID = c.customerID JOIN products AS p ON i.productCode = p.productCode JOIN technicians AS t ON i.techID = t.techID WHERE i.techID IS NOT NULL ";
        $statement = $db->prepare($query);
        $statement->execute();
        $incidents = $statement->fetchAll();
        $statement->closeCursor();
        return $incidents;
    } 
    catch (Exception $e) 
    {
        $error_message = $e->getMessage();
        include('../errors/database_error.php');
        exit();
    }
}

function assign_incident($incident_id, $tech_id)
{
    try
    {
        global $db;
        $query = "UPDATE incidents SET techID = :tech_id WHERE incidentID = :incident_id";
        $statement = $db->prepare($query);
        $statement->bindValue(':tech_id', $tech_id);
        $statement->bindValue(':incident_id', $incident_id);
        $statement->execute();
        $statement->closeCursor();
    } 
    catch (Exception $e) 
    {
        $error_message = $e->getMessage();
        include('../errors/database_error.php');
        exit();
    }
}

function update_incident($incident_id, $date_closed, $description)
{
    try
    {
        global $db;
        if($date_closed != NULL)
        {
            $query = "UPDATE incidents SET dateClosed = :date_closed, description = :description WHERE incidentID = :incident_id";
        }
        else
        {
            $query = "UPDATE incidents SET description = :description WHERE incidentID = :incident_id";
        }
        $statement = $db->prepare($query);
        $statement->bindValue(':incident_id', $incident_id);
        if($date_closed != NULL)
        {
            $statement->bindValue(':date_closed', $date_closed);
        }
        $statement->bindValue(':description', $description);
        $statement->execute();
        $statement->closeCursor();
    } 
    catch (Exception $e) 
    {
        $error_message = $e->getMessage();
        include('../errors/database_error.php');
        exit();
    }
}
?>