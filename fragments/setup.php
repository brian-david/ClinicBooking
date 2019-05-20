<?php require_once __DIR__.'/../classes/DatabaseHandler.php'; ?>

<?php    
    $db = new DatabaseHandler('mysql','localhost:8889','clinic','root','root');
    $self = htmlspecialchars($_SERVER['PHP_SELF']);

    //function to determine if a from was submitted
    $formSubmitted = $_SERVER['REQUEST_METHOD'] === 'POST';
?>