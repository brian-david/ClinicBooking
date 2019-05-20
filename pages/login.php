<?php require_once __DIR__.'/../fragments/setup.php'; ?>
<?php
    session_start();
    if(!empty($_POST)){
        if (isset($_POST['email']) && !empty($_POST['password'])){
            $userID = $_POST['email'];
            $db->connect();
            $sql = 'SELECT * FROM users WHERE email = ?';
            $statement = $db->pdo->prepare($sql);
            $statement->execute([$userID]);
            $userInfo = $statement->fetch(PDO::FETCH_ASSOC);
            if ($userInfo != false){
                if ($_POST['password'] === $userInfo['password']){
                    $_SESSION['userLoggedIn'] = true;
                    foreach ($userInfo as $key => $value){
                        $_SESSION[$key] = $value;
                    }

                    header("location:appointments.php");
                    exit;
                }else{
                    $message = "Incorrect Username or Password";
                    echo "<script type='text/javascript'>alert('$message');</script>";;
                }
            }
            else{
                echo "<script type='text/javascript'>alert('$message');</script>";;
            }
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        
        <title>Clinic Admin | Login</title>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link type="text/css" rel="stylesheet" href="../materialize/css/materialize.min.css"  media="screen,projection"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
       
       <style>
            html, body, .login-box {
                height: 100%;
            }
            html { 
                background: url(../images/misc/hospitalHall.jpeg) no-repeat center fixed; 
                background-size: cover;
            }
        </style>
    
    </head>

    <body>
        <div class="valign-wrapper row login-box">
            <div class="col card hoverable s10 pull-s1 m6 pull-m3 l4 pull-l4">
                
                <form name="login-form" method="post" action="<?= $self ?>">
                    <div class="card-content">
                        <span class="card-title">Please login</span>
                        <div class="row">
                            <div class="input-field col s12">
                                <label for="email" name="email">Email address</label>
                                <input type="email" class="validate" name="email" id="email" />
                            </div>
                            <div class="input-field col s12">
                                <label for="password">Password </label>
                                <input type="password" class="validate" name="password" id="password" />
                            </div>
                        </div>
                    </div>
                    <div class="card-action center-align">
                        <input name="login-submit" type="submit" class="btn green waves-effect waves-light" value="Login">
                    </div>
                </form>

            </div>
        </div>
        <!--JavaScript at end of body for optimized loading-->
        

        <script type="text/javascript" src="../materialize/js/materialize.min.js"></script>
    </body>
</html>