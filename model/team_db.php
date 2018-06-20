<?php
function get_team($teamID) {
    global $db;
    $query = 'SELECT * FROM Teams_Table WHERE team_id = :teamID';
    $statement = $db->prepare($query);
    $statement->bindValue(':teamID', $teamID);
    $statement->execute();
    $team = $statement->fetch();
    $statement->closeCursor();
    return $team;
}

function parse_waiver($team) {
    if ($team['waiver'] === NULL) return "&mdash;";
    else return $team['waiver'];
}

function parse_rank($team) {
    $result = "";
    $divRank = $team['division_rank'];
    $leagueRank = $team['league_rank'];
    
    if (fmod($divRank, 1) == 0) $result = (string) ($divRank % 1000);
    else $result = "T-" . ($divRank % 1000);
    
    if (fmod($leagueRank, 1) == 0) $result = $result . " (" . (string) $leagueRank % 1000 . ")";
    else $result = $result . " (T-" . (string) ($leagueRank % 1000) . ")";
    
    return $result;
}

function parse_streak($team) {
    if ($team['waiverVal'] === NULL) return "&mdash;";
    else return $team['streak_type'] . $team['streak_val'];
}
?>