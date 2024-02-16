<?php 
    require_once('../../private/initialize.php');
    $page_title = 'Your Backlog';
    $u = $_GET['username'] ?? ''; 
    $data = get_moby_api('games?format=brief', 'moby_3QJYFKLb7CGCMIU3A6rwP2UiTa2');
    $data = json_decode($data, true);
?>

<?php include(SHARED_PATH . '/shared_header.php'); ?>

<body>
    <h1>Your Backlog</h1>
    <button id="addgames">Add Games to Your Backlog?</button>

    <?php 
        //check if user has a box
        //if not, create one
        //if so, display it
        //if user is not logged in, redirect to login page
        if(!isset($_SESSION['is_logged_in'])){
            $_SESSION['is_logged_in'] = false;
            redirect_to(url_for('users/login.php'));
        }
        if(check_user_box_exist($_SESSION['user_id']) !== null){
            $games = get_all_games_from_box($_SESSION['user_id']);
            //if null, echo "no games in box"
            if($games === null){
                echo '<div class="games">';
                echo '<p>No games in box</p>';
                echo '</div>';
                echo '<div class="finding-games">';
                echo '<p>Find games to add to your box</p>';
                for ($i = 0; $i < count($data['games']); $i++){
                    echo '<div class="games-add">';
                    echo '<p>' . $data['games'][$i]['title'] . '</p>';
                    echo '<p>' . $data['games'][$i]['game_id'] . '</p>';
                    echo '<button>Add to Box</button>';
                    echo '</div>';
                }
                echo '</div>';

            }
            else{
                //if not null, display games
                echo '<div class="games">';
                foreach($games as $game){
                    echo '<div class="game">';
                    echo '<img src="' . $game['image'] . '" alt="' . $game['title'] . '">';
                    echo '<p>' . $game['title'] . '</p>';
                    echo '</div>';
                }
                echo '</div>';
            }
        }
        else{
            create_box($_SESSION['user_id']);
        }
    ?>





<?php include(SHARED_PATH . '/shared_footer.php'); ?>
<script>
    //toggle div with the class finding-games on button click
    document.getElementById('addgames').addEventListener('click', function(){
        document.querySelector('.finding-games').classList.toggle('hidden');
        document.querySelector('.games').classList.toggle('hidden');
    });

</script>