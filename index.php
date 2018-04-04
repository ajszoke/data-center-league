<?php
    require_once('model/database.php');
    require_once('model/player_db.php');
    require_once('model/league_db.php');
    require_once('model/team_db.php');
    
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    
    if (isset($_SESSION['user'])) {
        $leagueID1 = $_SESSION['user']['league_id1'];
        if ($leagueID1 == NULL) {
            include('signup_view.php');
        }
        else {
            include('home_view.php');
        }
    }
    else {
        header('Location: /account');
    }
?>