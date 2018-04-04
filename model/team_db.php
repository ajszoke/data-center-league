<?php
function get_team($teamID) {
    global $db;
    $query = 'SELECT * FROM teams WHERE team_id = :teamID';
    $statement = $db->prepare($query);
    $statement->bindValue(':teamID', $teamID);
    $statement->execute();
    $team = $statement->fetch();
    $statement->closeCursor();
    return $team;
}
?>