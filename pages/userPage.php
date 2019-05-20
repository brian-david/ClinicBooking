<?php session_start() ?>

<?php require_once __DIR__.'/../fragments/loginCheck.php';?>
<?php require_once __DIR__.'/../fragments/setup.php'; ?>

<!DOCTYPE html>
<html>
    <head>
        <title>Clinic Admin | Doctors</title>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link type="text/css" rel="stylesheet" href="../materialize/css/materialize.min.css"  media="screen,projection"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script type="text/javascript" src="../materialize/js/materialize.min.js"></script>
    </head>
    <body class="cyan lighten-5">
        <?php include __DIR__.'/../fragments/navigation.php'; ?>

    </body>
</html>