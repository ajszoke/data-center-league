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
                <!--<section class="division">-->
                <!--    <h4> DIVISION A </h4>-->
                <!--    <h4> W-L-T   %  PF PA   </h4>-->
                <!--    <ol>-->
                <!--        <a href="/team/"><li> <?php echo get_team($players_list[0])['team_name']; ?> </li></a>-->
                <!--        <a href="/team/"><li> <?php echo get_team($players_list[1])['team_name']; ?> </li></a>-->
                <!--        <a href="/team/"><li> <?php echo get_team($players_list[2])['team_name']; ?> </li></a>-->
                <!--        <a href="/team/"><li> <?php echo get_team($players_list[3])['team_name']; ?> </li></a>-->
                <!--    </ol>-->
                <!--</section>-->
                <!--<section class="division">-->
                <!--    <h4> DIVISION B </h4>-->
                <!--    <h4> W-L-T   %  PF PA   </h4>-->
                <!--    <ol>-->
                <!--        <a href="/team/"><li> <?php echo get_team($players_list[4])['team_name']; ?> </li></a>-->
                <!--        <a href="/team/"><li> <?php echo get_team($players_list[5])['team_name']; ?> </li></a>-->
                <!--        <a href="/team/"><li> <?php echo get_team($players_list[6])['team_name']; ?> </li></a>-->
                <!--        <a href="/team/"><li> <?php echo get_team($players_list[7])['team_name']; ?> </li></a>-->
                <!--    </ol>-->
                <!--</section>-->
                <!--<section class="division">-->
                <!--    <h4> DIVISION C </h4>-->
                <!--    <h4> W-L-T   %  PF PA   </h4>-->
                <!--    <ol>-->
                <!--        <a href="/team/"><li> <?php echo get_team($players_list[8])['team_name']; ?> </li></a>-->
                <!--        <a href="/team/"><li> <?php echo get_team($players_list[9])['team_name']; ?> </li></a>-->
                <!--        <a href="/team/"><li> <?php echo get_team($players_list[10])['team_name']; ?> </li></a>-->
                <!--        <a href="/team/"><li> <?php echo get_team($players_list[11])['team_name']; ?> </li></a>-->
                <!--    </ol>-->
                <!--</section>-->
                <table class="table table-sm table-hover table-dark">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
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
                    <tr class="table-active">
                      <td colspan="10">Division A</td>
                    </tr>
                    <tr>
                      <th scope="row">T-1</th>
                      <td><a href="/team/"><?php echo get_team($players_list[0])['team_name']; ?></a></td>
                      <td>0</td>
                      <td>0</td>
                      <td>0</td>
                      <td>0</td>
                      <td>0</td>
                      <td>-</td>
                      <td>-</td>
                      <td>0</td>
                    </tr>
                    <tr>
                      <th scope="row">T-1</th>
                      <td><a href="/team/"><?php echo get_team($players_list[1])['team_name']; ?></a></td>
                      <td>0</td>
                      <td>0</td>
                      <td>0</td>
                      <td>0</td>
                      <td>0</td>
                      <td>-</td>
                      <td>-</td>
                      <td>0</td>
                    </tr>
                    <tr>
                      <th scope="row">T-1</th>
                      <td><a href="/team/"><?php echo get_team($players_list[2])['team_name']; ?></a></td>
                      <td>0</td>
                      <td>0</td>
                      <td>0</td>
                      <td>0</td>
                      <td>0</td>
                      <td>-</td>
                      <td>-</td>
                      <td>0</td>
                    </tr>
                    <tr>
                      <th scope="row">T-1</th>
                      <td><a href="/team/"><?php echo get_team($players_list[3])['team_name']; ?></a></td>
                      <td>0</td>
                      <td>0</td>
                      <td>0</td>
                      <td>0</td>
                      <td>0</td>
                      <td>-</td>
                      <td>-</td>
                      <td>0</td>
                    </tr>
                    <tr class="table-active">
                      <td colspan="10">Division B</td>
                    </tr>
                    <tr>
                      <th scope="row">T-1</th>
                      <td><a href="/team/"><?php echo get_team($players_list[4])['team_name']; ?></a></td>
                      <td>0</td>
                      <td>0</td>
                      <td>0</td>
                      <td>0</td>
                      <td>0</td>
                      <td>-</td>
                      <td>-</td>
                      <td>0</td>
                    </tr>
                    <tr>
                      <th scope="row">T-1</th>
                      <td><a href="/team/"><?php echo get_team($players_list[5])['team_name']; ?></a></td>
                      <td>0</td>
                      <td>0</td>
                      <td>0</td>
                      <td>0</td>
                      <td>0</td>
                      <td>-</td>
                      <td>-</td>
                      <td>0</td>
                    </tr>
                    <tr>
                      <th scope="row">T-1</th>
                      <td><a href="/team/"><?php echo get_team($players_list[6])['team_name']; ?></a></td>
                      <td>0</td>
                      <td>0</td>
                      <td>0</td>
                      <td>0</td>
                      <td>0</td>
                      <td>-</td>
                      <td>-</td>
                      <td>0</td>
                    </tr>
                    <tr>
                      <th scope="row">T-1</th>
                      <td><a href="/team/"><?php echo get_team($players_list[7])['team_name']; ?></a></td>
                      <td>0</td>
                      <td>0</td>
                      <td>0</td>
                      <td>0</td>
                      <td>0</td>
                      <td>-</td>
                      <td>-</td>
                      <td>0</td>
                    </tr>
                    <tr class="table-active">
                      <td colspan="10">Division C</td>
                    </tr>
                    <tr>
                      <th scope="row">T-1</th>
                      <td><a href="/team/"><?php echo get_team($players_list[8])['team_name']; ?></a></td>
                      <td>0</td>
                      <td>0</td>
                      <td>0</td>
                      <td>0</td>
                      <td>0</td>
                      <td>-</td>
                      <td>-</td>
                      <td>0</td>
                    </tr>
                    <tr>
                      <th scope="row">T-1</th>
                      <td><a href="/team/"><?php echo get_team($players_list[9])['team_name']; ?></a></td>
                      <td>0</td>
                      <td>0</td>
                      <td>0</td>
                      <td>0</td>
                      <td>0</td>
                      <td>-</td>
                      <td>-</td>
                      <td>0</td>
                    </tr>
                    <tr>
                      <th scope="row">T-1</th>
                      <td><a href="/team/"><?php echo get_team($players_list[10])['team_name']; ?></a></td>
                      <td>0</td>
                      <td>0</td>
                      <td>0</td>
                      <td>0</td>
                      <td>0</td>
                      <td>-</td>
                      <td>-</td>
                      <td>0</td>
                    </tr>
                    <tr>
                      <th scope="row">T-1</th>
                      <td><a href="/team/"><?php echo get_team($players_list[11])['team_name']; ?></a></td>
                      <td>0</td>
                      <td>0</td>
                      <td>0</td>
                      <td>0</td>
                      <td>0</td>
                      <td>-</td>
                      <td>-</td>
                      <td>0</td>
                    </tr>
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