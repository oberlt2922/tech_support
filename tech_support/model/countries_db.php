<?php
function get_countries()
{
    try
    {
        global $db;
        $query = 'SELECT * FROM countries';
        $statement = $db->prepare($query);
        $statement->execute();
        $countries = $statement->fetchAll();
        $statement->closeCursor();
        return $countries;
    }
    catch(PDOException $e)
    {
        $error_message = $e->getMessage();
        include('../errors/database_error.php');
        exit();
    }
}
?>