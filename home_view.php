<?php include 'view/header.php'; 
    $doc_root = filter_input(INPUT_SERVER, 'DOCUMENT_ROOT', FILTER_SANITIZE_STRING);
    $leagueID1 = $_SESSION['user']['league_id1'];
    $players_list = get_league_players($leagueID1);
?>
<main>
    <section class="main_page">
        <div id="message_board">
            <h4> Message Board </h4>
        </div>
        <div id="team_board">
            <p> STANDINGS </p>
                <table class="table table-sm table-hover table-dark">
                  <thead>
                    <tr>
                      <th scope="col"><a href="#" data-toggle="tooltip" title="Division Rank (League Rank)">Rank</a></th>
                      <th scope="col">Team</th>
                      <th scope="col">W</th>
                      <th scope="col">L</th>
                      <th scope="col">T</th>
                      <th scope="col">TPF</th>
                      <th scope="col">TPA</th>
                      <th scope="col">Streak</th>
                      <th scope="col">Waiver</th>
                      <th scope="col">Moves</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php print_league_rankings($leagueID1, $players_list); ?>
                  </tbody>
                </table>
        </div>
        <div id="transaction_board">
            <h4> Transactions </h4>
        </div>
    </section>
    <section class="main_page">
        <div id="nfl_board">
            <h4> This Weeks Games </h4>
        </div>
        <div id="matchups_board">
            <h4> This Weeks Matchups </h4>
        </div>
        <div id="free_agents_board">
            <h4> Free Agents </h4>
        </div>
    </section>

</main>
</body>
</html>