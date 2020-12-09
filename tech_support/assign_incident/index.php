<?php
session_start();
require_once('../util/secure_conn.php');
require_once('../model/database.php');
require_once('../model/incident_db.php');
require_once('../model/technician_db.php');

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        $action = 'list_incidents';
    }
}

switch($action)
{
    case 'list_incidents':
    {
        $incidents = get_unassigned_incidents_for_assign();
        include('select_incident.php');
        break;
    }
    case 'list_technicians':
    {
        $incident_id = filter_input(INPUT_POST, 'incident_id', FILTER_VALIDATE_INT);
        $first_name = filter_input(INPUT_POST, 'first_name');
        $last_name = filter_input(INPUT_POST, 'last_name');
        $product_code = filter_input(INPUT_POST, 'product_code');
        $_SESSION['incident'] = array();
        $_SESSION['incident']['incidentID'] = $incident_id;
        $_SESSION['incident']['customerFirstName'] = $first_name;
        $_SESSION['incident']['customerLastName'] = $last_name;
        $_SESSION['incident']['productCode'] = $product_code;
        $technicians = get_technicians_with_incidents();
        include('select_technician.php');
        break;
    }
    case 'show_assign_incident':
    {
        $assigned = false;
        $tech_id = filter_input(INPUT_POST, 'tech_id', FILTER_VALIDATE_INT);
        $first_name = filter_input(INPUT_POST, 'first_name');
        $last_name = filter_input(INPUT_POST, 'last_name');
        $_SESSION['incident']['techID'] = $tech_id;
        $_SESSION['incident']['technicianFirstName'] = $first_name;
        $_SESSION['incident']['technicianLastName'] = $last_name;
        include('assign_incident.php');
        break;
    }
    case 'assign_incident':
    {
        assign_incident($_SESSION['incident']['incidentID'], $_SESSION['incident']['techID']);
        $assigned = true;
        unset($_SESSION['incident']);
        include('assign_incident.php');
    }
    case 'logout':
    {
        unset($_SESSION['user']);
        include('../login_and_select/select_user_type.php');
        break;
    }
}
?>