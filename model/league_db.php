<?php
function get_league_players($leagueID) {
    global $db;
    $query = 'SELECT league_player_ids FROM Leagues_Table WHERE league_id = :leagueID';
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

function print_league_rankings($leagueID, $players_list) {
    global $db;
    $div_query = 'SELECT * FROM Divisions_Table WHERE leagueID = :leagueID';
    $team_query = 'SELECT * FROM Teams_Table WHERE leagueID = :leagueID AND division_ID = :division_ID';
    $div_stmt = $db->prepare($div_query);
    $div_stmt->bindValue(':leagueID', $leagueID);
    
    if($div_stmt->execute()) {
        while ($div_row = $div_stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr class=\"table-active\"><td colspan=\"10\">" . $div_row['division_name'] . "</td></tr>";
            $team_stmt = $db->prepare($team_query);
            $team_stmt->bindValue(':leagueID', $leagueID);
            $team_stmt->bindValue(':division_ID', $div_row['division_ID']);
            $div_teams = array();
            
            if($team_stmt->execute()) {
                while ($team_row = $team_stmt->fetch(PDO::FETCH_ASSOC)) {
                    $div_teams[] = $team_row;
                }
                usort($div_teams, 'compare_teams');
                foreach($div_teams as $cur_team) {
                    echo "<tr>";
                    echo "<td><a href=\"/team/\">" . parse_rank($cur_team) . "</a></td>";
                    echo "<td><a href=\"/team/\">" . $cur_team['team_name'] . "</a></td>";
                    echo "<td><a href=\"/team/\">" . $cur_team['wins'] . "</a></td>";
                    echo "<td><a href=\"/team/\">" . $cur_team['losses'] . "</a></td>";
                    echo "<td><a href=\"/team/\">" . $cur_team['ties'] . "</a></td>";
                    echo "<td><a href=\"/team/\">" . $cur_team['TPF'] . "</a></td>";
                    echo "<td><a href=\"/team/\">" . $cur_team['TPA'] . "</a></td>";
                    echo "<td><a href=\"/team/\">" . parse_streak($cur_team) . "</a></td>";
                    echo "<td><a href=\"/team/\">" . parse_waiver($cur_team) . "</a></td>";
                    echo "<td><a href=\"/team/\">" . $cur_team['moves'] . "</a></td>";
                    echo "</tr>";
                }
            }
        }
    } else {
        return false;
    }
    
    $div_stmt->closeCursor();
    $team_stmt->closeCursor();
    return true;
}

function compare_teams($team_a, $team_b) {
    if ($team_a['schedule_points'] > $team_b['schedule_points']) return 1;
    elseif($team_a['schedule_points'] < $team_b['schedule_points']) return -1;
    else {
        if ($team_a['TPF'] > $team_b['TPF']) return 1;
        elseif($team_a['TPF'] < $team_b['TPF']) return -1;
        else return $team_a['team_id'] - $team_b['team_id'];
    }
}
?>