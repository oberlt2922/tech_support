<?php
session_start();
//secure connections

require_once('../util/secure_conn.php');
require_once('../model/database.php');
require_once('../model/login.php');
require('../model/product_db.php');


$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        $action = 'show_select_user_type';
    }
}


switch($action)
{
    case 'show_select_user_type':
    {
        if(!isset($_SESSION['user']['signed_in']))
        {
            include('select_user_type.php');
        }
        else
        {
            if($_SESSION['user']['type'] != 'customer')
            {
                include('select_page.php');
            }
            else
            {
                $products = get_products();
                include('../product_registration/product_register.php');
            }
        }
        break;
    }
    case 'show_sign_in':
    {
        $type = filter_input(INPUT_POST, 'type');
        if($type == null)
        {
            $type = filter_input(INPUT_GET, 'type');
        }
        include('sign_in.php');
        break;
    }
    case 'login':
    {
        $type = filter_input(INPUT_POST, 'type');
        if($type == 'admin')
        {
            $username = filter_input(INPUT_POST, 'username');
        }
        else
        {
            $email = filter_input(INPUT_POST, 'email');
        }
        $password = filter_input(INPUT_POST, 'password');
        
        switch($type)
        {
            case 'admin':
            {
                $admin = admin_login($username, $password);
                if($admin != FALSE)
                {
                    $_SESSION['user'] = array();
                    $_SESSION['user']['type'] = $type;
                    $_SESSION['user']['signed_in'] = TRUE;
                    $_SESSION['user']['username'] = $admin['username'];
                    include('select_page.php');
                }
                else
                {
                    $loginFailed = TRUE;
                    include('sign_in.php');
                }
                break;
            }
            case 'tech':
            {
                $technician = technician_login($email, $password);
                if($technician != FALSE)
                {
                    $_SESSION['user'] = array();
                    $_SESSION['user']['type'] = $type;
                    $_SESSION['user']['signed_in'] = TRUE;
                    $_SESSION['user']['techID'] = $technician['techID'];
                    $_SESSION['user']['firstName'] = $technician['firstName'];
                    $_SESSION['user']['lastName'] = $technician['lastName'];
                    $_SESSION['user']['email'] = $technician['email'];
                    $_SESSION['user']['phone'] = $technician['phone'];
                    $_SESSION['user']['password'] = $technician['password'];
                    include('select_page.php');
                }
                else
                {
                    $loginFailed = TRUE;
                    include('sign_in.php');
                }
                break;
            }
            case 'customer':
            {
                $customer = customer_login($email, $password);
                if($customer != FALSE)
                {
                    $_SESSION['user'] = array();
                    $_SESSION['user']['type'] = $type;
                    $_SESSION['user']['signed_in'] = TRUE;
                    $_SESSION['user']['customerID'] = $customer['customerID'];
                    $_SESSION['user']['firstName'] = $customer['firstName'];
                    $_SESSION['user']['lastName'] = $customer['lastName'];
                    $_SESSION['user']['address'] = $customer['address'];
                    $_SESSION['user']['city'] = $customer['city'];
                    $_SESSION['user']['state'] = $customer['state'];
                    $_SESSION['user']['postalCode'] = $customer['postalCode'];
                    $_SESSION['user']['countryCode'] = $customer['countryCode'];
                    $_SESSION['user']['phone'] = $customer['phone'];
                    $_SESSION['user']['email'] = $customer['email'];
                    $_SESSION['user']['password'] = $customer['password'];
                    //$_POST["login"] = 'show_product_register';
                    $products = get_products();
                    include('../product_registration/product_register.php');
                }
                else
                {
                    $loginFailed = TRUE;
                    include('sign_in.php');
                }
                break;
            }
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