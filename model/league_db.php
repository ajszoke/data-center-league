<?php
function get_league_players($leagueID) {
    global $db;
    $query = 'SELECT league_player_ids FROM leagues WHERE league_id = :leagueID';
    $statement = $db->prepare($query);
    $statement->bindValue(':leagueID', $leagueID);
    $statement->execute();
    $result = $statement->fetch();
    $statement->closeCursor();
    
    if ($result['league_player_ids'] != NULL) {
        $results = explode(",", $result['league_player_ids']);
        return $results;
    }
    else {
        return false;
    }
}
?>