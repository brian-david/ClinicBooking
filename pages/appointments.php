<?php require_once __DIR__.'/../fragments/loginCheck.php';?>
<?php require_once __DIR__.'/../fragments/setup.php'; ?>

<!--------------------------------------------------------SELF POST HANDLE ------------------------------------------------------->
<?php
    $appointments = $db->getAppointments();

    if (!empty($_POST)){
        if (!empty($_POST['time']) && !empty($_POST['date']) && !empty($_POST['doctor']) && !empty($_POST['patients']) && !empty($_POST['room'])){
            $newAppointment = array('doc_id' => $_POST['doctor'], 'patient_id' => $_POST['patients'], 'room_id' => $_POST['room'], 'date' => $_POST['date'], 'time_id' => $_POST['time']);
            $db->addAppointment($newAppointment);
        }
    }  
?>

<!--------------------------------------------------------SELF POST END------------------------------------------------------------->

<!DOCTYPE html>
<html>
    <head>
        <title>Clinic Admin | Appointments</title>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link type="text/css" rel="stylesheet" href="../materialize/css/materialize.min.css"  media="screen,projection"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script type="text/javascript" src="../materialize/js/materialize.min.js"></script>
        <style>
            .modal { width: 75% !important };
        </style>
    </head>
    <body>
        <?php include __DIR__.'/../fragments/navigation.php'; ?>
        <div id="appointmentModalForm" class="modal">
            <div class="modal-content">
                <h5 class="center-align">New Appointment</h5>
                <br/>
                <div class="row">
                    <form class="col m12 s12" name="newPatient" method="POST" action="<?= $self ?>">              
                        
                        <!-- TIME INPUT -->
                        <div class="row">    
                            <div class="input-field col s12">
                                <select name="time">
                                    <option value="" disabled selected>Select Time Slot</option>
                                    <?php
                                    $timeSlots = $db->getTimes();
                                    foreach ($timeSlots as $slot){
                                        $id = $slot['id'];
                                        $modalName = 'modal_'.$id;
                                        $time = $slot['time']?>
                                        <option value="<?= $id ?>"><?= $time ?></option>
                                    <?php } ?>
                                </select>
                                <label>Time Slot</label>
                            </div>
                        </div>
                        
                        <!-- DATE INPUT -->
                        <div class="row"> 
                            <div class="input-field col s12">         
                                <input type="text" name="date" class="datepicker">
                                <label>Date of appointment</label>
                            </div>
                        </div>

                        <!-- DOC INPUT -->
                        <div class="row">    
                            <div class="input-field col s12">
                                <select name="doctor">
                                    <option value="" disabled selected>Select Doctor</option>
                                    <?php
                                    $doctors = $db->getDoctors();
                                    foreach ($doctors as $doc){
                                        $id = $doc['id'];
                                        $modalName = 'modal_'.$id;
                                        $name = 'Dr. '.$doc['first_name'].' '.$doc['last_name'];
                                        $speciality = $doc['specialisation'];
                                        $avatar = $doc['photo']; ?>
                                        <option value="<?= $id ?>"><?= $name ?></option>
                                    <?php } ?>
                                </select>
                                <label>Doctors</label>
                            </div>
                        </div>

                        <!-- PATIENT INPUT -->
                        <div class="row">    
                            <div class="input-field col s12">
                                <select name="patients">
                                    <option value="" disabled selected>Select Patient</option>
                                    <?php
                                    $patients = $db->getAllPatients();
                                    foreach ($patients as $patient){
                                        $id = $patient['id'];
                                        $name = $patient['name']; ?>
                                        <option value="<?= $id ?>"><?= $name ?></option>
                                    <?php } ?>
                                </select>
                                <label>Patients</label>

                            </div>
                        </div>

                        <!-- ROOM INPUT -->
                        <div class="row">    
                            <div class="input-field col s12">
                                <input id="room-num" type="text" name="room" class="validate">
                                <label for="room-num">Room Number</label>
                            </div>
                        </div>

                        <!-- SUBMIT -->
                        <div class="modal-footer">
                            <input class="modal-action modal-close btn-flat" type="submit" value="Add Appointment" name="appointmentAdd">
                        </div>

                    </form>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col s12 m12">
                    <?php
                    $appointments = $db->getAppointments();
                    foreach ($appointments as $appointment): ?>
                        <div class="card-panel">
                            <p>Time: <?= $appointment['time']['time'] ?></p>
                            <p>Date: <?= $appointment['time']['date'] ?></p>
                            <p>Patient: <?= $appointment['patient']['name'] ?></p>
                            <p>Doctor: Dr. <?= $appointment['doctor']['last_name'] ?></p>
                            <p>Room: Floor: <?= $appointment['room']['floor_num'] ?> Room: <?= $appointment['room']['room_num'] ?></p>
                        </div>
                    <?php
                    endforeach;
                    ?>
                </div>
            </div>
        </div>
        
        <!-- Fixed Action Button -->
        <div class="fixed-action-btn">
            <!-- appointmentModalForm form trigger -->
            <a href="#appointmentModalForm" class="btn-floating btn-large red modal-trigger">
                <i class="large material-icons">add</i>
            </a>
        </div>
        
    </body>
</html>