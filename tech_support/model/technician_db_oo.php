<?php
class TechnicianDB {
    public static function get_technicians()
    {
        try
        {
            global $db;
            $query = "SELECT * FROM technicians";
            $statement = $db->prepare($query);
            $statement->execute();
            $results = $statement->fetchAll();
            $statement->closeCursor();

            $technicians = array();

            foreach($results as $row)
            {
                $technician = new Technician($row["firstName"], $row["lastName"], $row["email"], $row["phone"], $row["password"], $row["techID"]);
                array_push($technicians, $technician);
            }

            return $technicians;
        }
        catch(PDOException $e)
        {
            $error_message = $e->getMessage();
            include('../errors/database_error.php');
        }
    }
    
    public static function delete_technician($technician_id)
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
        }
    }
    
    public static function add_technician(Technician $technician)
    {
        try
        {
            global $db;
            $query = "INSERT INTO technicians (firstName, lastName, email, phone, password) VALUES (:first_name, :last_name, :email, :phone, :password)";
            $statement = $db->prepare($query);
            $statement->bindValue(":first_name", $technician->getFirstName());
            $statement->bindValue(":last_name", $technician->getLastName());
            $statement->bindValue(":email", $technician->getEmail());
            $statement->bindValue(":phone", $technician->getPhone());
            $statement->bindValue(":password", $technician->getPassword());
            $statement->execute();
            $statement->closeCursor();
            unset($technician);
        }
        catch(PDOException $e)
        {
            $error_message = $e->getMessage();
            include('../errors/database_error.php');
        }
    }
}
?>