<?php
session_start();
require_once('../util/secure_conn.php');
require_once('../model/database.php');
require_once('../model/customer_db.php');
require_once('../model/countries_db.php');
require_once('../model/fields.php');
require_once('../model/validate.php');


$validate = new Validate();
$fields = $validate->getFields();
$fields->addField('first_name');
$fields->addfield('last_name');
$fields->addfield('address');
$fields->addfield('city');
$fields->addfield('state');
$fields->addfield('postal_code');
$fields->addfield('phone');
$fields->addfield('email');
$fields->addfield('password');


$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        $action = 'list_customers';
    }
}

switch($action)
{
    case 'list_customers':
    {
        $last_name = filter_input(INPUT_POST, 'last_name');
        if($last_name == NULL)
        {
            $customers = get_all_customers();
        }
        else
        {
            $customers = get_customers_by_name($last_name);
        }
        include ('customer_list.php');
        break;
    }
    case 'show_add_customer_form':
    {
        $countries = get_countries();
        include ('customer_update.php');
        break;
    }
    case 'add_customer':
    {
        //get all input values
        $customer_id = filter_input(INPUT_POST, 'customer_id', FILTER_VALIDATE_INT);
        $first_name = filter_input(INPUT_POST, 'first_name');
        $last_name = filter_input(INPUT_POST, 'last_name');
        $address = filter_input(INPUT_POST, 'address');
        $city = filter_input(INPUT_POST, 'city');
        $state = filter_input(INPUT_POST, 'state');
        $postal_code = filter_input(INPUT_POST, 'postal_code');
        $country_code = filter_input(INPUT_POST, 'country_code');
        $phone = filter_input(INPUT_POST, 'phone');
        $email = filter_input(INPUT_POST, 'email');
        $password = filter_input(INPUT_POST, 'password');
        
        $countries = get_countries();
        
        $customer = array();
        
        $customer["firstName"] = $first_name;
        $customer["lastName"] = $last_name;
        $customer["address"] = $address;
        $customer["city"] = $city;
        $customer["state"] = $state;
        $customer["postalCode"] = $postal_code;
        $customer["country_code"] = $country_code;
        $customer["phone"] = $phone;
        $customer["email"] = $email;
        $customer["password"] = $password;
        
        //validate all input values
        $validate->firstName('first_name', $first_name);
        $validate->lastName('last_name', $last_name);
        $validate->address('address', $address);
        $validate->city('city', $city);
        $validate->state('state', $state);
        $validate->postalCode('postal_code', $postal_code);
        $validate->phone('phone', $phone);
        $validate->email('email', $email);
        $validate->password('password', $password);
        
        if($fields->hasErrors())
        {
            $action = 'show_add_customer_form';
            include('customer_update.php');
        }
        else
        {
            add_customer($first_name, $last_name, $address, $city, $state, $postal_code, $country_code, $phone, $email, $password);
            header("Location: .");
        }
        
        break;
    }
    case 'show_update_form':
    {
        $customer_id = filter_input(INPUT_POST, 'customer_id', FILTER_VALIDATE_INT);
        $customer = get_customer($customer_id);
        $countries = get_countries();
        include ('customer_update.php');
        break;
    }
    case 'update_customer':
    {
        //get all input values
        $customer_id = filter_input(INPUT_POST, 'customer_id', FILTER_VALIDATE_INT);
        $first_name = filter_input(INPUT_POST, 'first_name');
        $last_name = filter_input(INPUT_POST, 'last_name');
        $address = filter_input(INPUT_POST, 'address');
        $city = filter_input(INPUT_POST, 'city');
        $state = filter_input(INPUT_POST, 'state');
        $postal_code = filter_input(INPUT_POST, 'postal_code');
        $country_code = filter_input(INPUT_POST, 'country_code');
        $phone = filter_input(INPUT_POST, 'phone');
        $email = filter_input(INPUT_POST, 'email');
        $password = filter_input(INPUT_POST, 'password');
        
        //get customer and countries
        $customer = get_customer($customer_id);
        $countries = get_countries();
        
        $customer["firstName"] = $first_name;
        $customer["lastName"] = $last_name;
        $customer["address"] = $address;
        $customer["city"] = $city;
        $customer["state"] = $state;
        $customer["postalCode"] = $postal_code;
        $customer["countryCode"] = $country_code;
        $customer["phone"] = $phone;
        $customer["email"] = $email;
        $customer["password"] = $password;
        
        //validate all input values
        $validate->firstName('first_name', $first_name);
        $validate->lastName('last_name', $last_name);
        $validate->address('address', $address);
        $validate->city('city', $city);
        $validate->state('state', $state);
        $validate->postalCode('postal_code', $postal_code);
        $validate->phone('phone', $phone);
        $validate->email('email', $email);
        $validate->password('password', $password);
        
        if($fields->hasErrors())
        {
            $action = 'show_update_form';
            include('customer_update.php');
        }
        else
        {
            update_customer($customer_id, $first_name, $last_name, $address, $city, $state, $postal_code, $country_code, $phone, $email, $password);
            header("Location: .");
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