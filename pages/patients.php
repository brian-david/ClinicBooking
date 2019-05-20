<?php require_once __DIR__.'/../fragments/loginCheck.php';?>
<?php require_once __DIR__.'/../fragments/setup.php'; ?>

<!---------------------------------------------------------------------------------------------------------- HANDLING SELF SUBS -->
<?php
    if (isset($_POST['passed'])){
        echo "<script type='text/javascript'>alert('$message');</script>";
    }


    if (!empty($_POST)){
        if (!empty($_POST['p-name']) && !empty($_POST['pmedical-aid']) && !empty($_POST['phone-no'])){
            if (isset($_POST['p-name'])){
                $db->addPatient($_POST['p-name'], $_POST['medical-aid'], $_POST['phone-no']);
        
            }
        }
    }
    
?>

<!---------------------------------------------------------------------------------------------------------- END -->

<!DOCTYPE html>
<html>
    <head>
        <title>Clinic Admin | Patients</title>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link type="text/css" rel="stylesheet" href="../materialize/css/materialize.min.css"  media="screen,projection"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/> 

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script type="text/javascript" src="../materialize/js/materialize.min.js"></script>

        <script>
            $(function(){
                load_patients();
                
                function load_patients(med_aids){
                    $.ajax({
                        type: "POST",
                        url: "../fragments/search.php",
                        data: {passed: med_aids},
                        success: function(data){
                            $("#customers").html(data);
                        }
                    });
                }
                
                $('#search').keyup(function(){
                    var medical_aid = $(this).val();
                    if (medical_aid != ''){
                        load_patients(medical_aid);
                    }else{
                        load_patients(null);
                    }
                })
            });
        </script>

    </head>
    
    <body class="cyan lighten-5">
        <?php include __DIR__.'/../fragments/navigation.php'; ?>
        
<!----------------------------------------------------------------------------------------------------------- new patient form -->
        <div id="newPatientForm" class="modal">
            
            <div class="modal-content">
                <h5 class="center-align">New Patient</h5>
                <br/>
                <div class="row">
                    <div class="col s12 m12">
                        <form class="col m12 s12" name="newPatient" method="POST" action="<?= $self ?>">
                            <div class="row">
                                <div class="row modal-form-row">
                                    <div class="input-field col m12 s12">
                                        <input id="pname" name="p-name" type="text" class="validate">
                                        <label for="pname">Patient Name</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col m12 s12">
                                        <input id="man" name="medical-aid" type="text" class="validate">
                                        <label for="man">Medical Aid Num.</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col m12 s12">
                                        <input id="phone" name="phone-no" type="text" class="validate">
                                        <label for="phone">Phone Number</label>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <input class="modal-action modal-close btn-flat" type="submit" value="addPatient" name="patientSubmit">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <!------------------------------------------------------------------------------------------------ END of NEW PATIENT FORM -->
        
        <div class="container">
            <div class="row">
                <div class="section">
                    <!-- THE SEARCH -->
                    <div class="nav-wrapper">
                        <form>
                            <div class="input-field">
                                <input placeholder="Search Patient by Medical Aid Number" id="search" type="search" name="search" required>
                                <label class="label-icon" for="search"><i class="material-icons">search</i></label></label>
                                <i class="material-icons">close</i>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="divider"></div>
                <div class="section">
                    <!-- THE PATIENTS -->
                    <table class="highlight white z-depth-1">
                        <thead>
                            <tr>
                                <th style="padding: 25px;">Medical Aid No.</th>
                                <th style="padding: 25px;">Patient Name</th>
                                <th style="padding: 25px;">Phone No.</th>
                            </tr>
                        </thead>
                        <tbody id="customers">
       
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="fixed-action-btn">
            <!-- new patient modal form trigger -->
            <a href="#newPatientForm" class="btn-floating btn-large red modal-trigger">
                <i class="large material-icons">add</i>
            </a>
        </div>

        
    </body>
</html>