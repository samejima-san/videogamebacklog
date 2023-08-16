<?php 
require_once('../private/initialize.php');

$page_title = 'Home';

error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<?php 
    include(SHARED_PATH . '/shared_header.php'); 
    if(!isset($_SESSION['is_logged_in'])){
        $_SESSION['is_logged_in'] = false;
    }
?>

<?php
/*
// Specify your API key and the base URL
$apiKey = "moby_3QJYFKLb7CGCMIU3A6rwP2UiTa2";
$baseUrl = 'https://api.mobygames.com/v1/';

// Specify the endpoint and required parameters
$endpoint = 'games?format=brief';
$format = 'id'; // Desired format, e.g., 'id', 'json', 'xml', etc.

// Construct the URL with the API key and format
$url = $baseUrl . $endpoint . '&api_key=' . $apiKey;

// Make the API request and get the response
$response = file_get_contents($url);
$data = json_decode($response, true);

// Process the response
if ($data) {
    echo json_encode($data["games"]);;
   /* $games = $data['result'];
    // Handle the retrieved game information
    foreach ($games as $game) {
        $gameId = $game['game_id'];
        $gameTitle = $game['title'];
        // Process other available fields as per your requirements
        echo "Game ID: $gameId, Title: $gameTitle\n";
    }
} else {
    // Handle API errors or empty response
    echo "Failed to retrieve game information.\n";
}



*/
?>


<body>
    <h1> Home </h1>
    <?php if($_SESSION['is_logged_in']){ ?>
    <p>Welcome <?php echo $_SESSION['username']; ?></p>
    <?php }else{ ?>
        <p>Welcome Guest</p>
    <?php } ?>

<?php include(SHARED_PATH . '/shared_footer.php'); ?>