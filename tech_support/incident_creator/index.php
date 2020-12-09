<?php
session_start();
require_once('../util/secure_conn.php');
require('../model/database.php');
require('../model/customer_db.php');
require('../model/product_db.php');
require('../model/incident_db.php');

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        $action = 'show_login_form';
    }
}

switch($action)
{
    case 'show_login_form':
    {
        include('customer_login.php');
        break;
    }
    case 'login':
    {
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        if($email === NULL || $email === FALSE)
        {
            $error = "Input must be a valid email.";
            include('../errors/error.php');
        }
        else
        {
            $products = get_products();
            $customer = get_customer_by_email($email);
            if($customer === FALSE)
            {
                $error = "Email does not belong to an existing customer.";
                include('../errors/error.php');
            }
            else
            {
                include('incident_create.php');
            }
        }
        break;
    }
    case 'create_incident':
    {
        $customer_id = filter_input(INPUT_POST, 'customer_id', FILTER_VALIDATE_INT);
        $product_code = filter_input(INPUT_POST, 'code');
        $title = filter_input(INPUT_POST, 'title');
        $description = filter_input(INPUT_POST, 'description');
        $date_opened = date('Y-m-d');
        if($customer_id === NULL || $customer_id === FALSE || $product_code === NULL || $title === NULL ||
                $description == NULL || $date_opened == NULL)
        {
            $error = 'All fields are required';
            include('../errors/error.php');
        }
        else
        {
            add_incident($customer_id, $product_code, $date_opened, $title, $description);
            include('incident_create.php');
        }
        break;
    }
    case 'logout':
    {
        unset($_SESSION['user']);
        include('../login_and_select/select_user_type.php');
        break;
    }
}
?>