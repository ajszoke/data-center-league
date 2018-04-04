<?php
require_once('../model/database.php');
require_once('../model/player_db.php');

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {        
        $action = 'view_team';
        if (isset($_SESSION['user'])) {
            $action = 'view_team';
        }
    }
}

switch ($action) {
    case 'view_team':
        
        include 'team_view.php';
        break;
    default:
        display_error("Unknown account action: " . $action);
        break;
}
?>