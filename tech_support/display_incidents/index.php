<?php
session_start();
require_once('../util/secure_conn.php');
require_once('../model/database.php');
require_once('../model/incident_db.php');

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        $action = 'display_unassigned';
    }
}

switch($action)
{
    case 'display_unassigned':
    {
        $incidents = get_unassigned_incidents_for_display();
        include('display_incidents.php');
        break;
    }
    case 'display_assigned':
    {
        $incidents = get_assigned_incidents_for_display();
        include('display_incidents.php');
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