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
        <div class="container">
            <div class="row">
                
                <ul class="collection">
                    <?php
                    $doctors = $db->getDoctors();
                    foreach ($doctors as $doc){
                        $id = $doc['id'];
                        $modalName = 'modal_'.$id;
                        $name = 'Dr. '.$doc['first_name'].' '.$doc['last_name'];
                        $speciality = $doc['specialisation'];
                        $avatar = $doc['photo']; ?>
                        
                        <div id="<?= $modalName ?>" class="modal">
                            <div class="modal-content">
                                <h4><?= $name ?></h4>
                                <p><?= $speciality ?></p>
                            </div>
                            <div class="modal-footer">
                                <a href="#!" class="modal-close waves-effect waves-green btn-flat">Agree</a>
                            </div>
                        </div> 

                        <li class="collection-item avatar">
                            <a href="#<?= $modalName ?>" class="collection-item modal-trigger">
                                <img src='../images/doctors/<?= $avatar ?>' alt="" class="circle">
                                <span class="title"><?= $name ?></span>
                            </a>
                        </li>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>