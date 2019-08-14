<?php include "action/db.php";
/*
 * 1. vragen om email
 * 2. controleren in db of bestaat
 * 3. zoja, dan vragen om nieuw wachtwoord
 * 4. zonee... maak een account
 */
$step = 1;
//2.
if( isset( $_POST['email'])) {
    $stmt = $conn->prepare("SELECT * FROM jukebox WHERE email = :email LIMIT 1");
    $stmt->bindParam(':email', $_POST['email']);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if( isset( $row['ID'])) {
        //dan naar stap 3
        $step = 3;
        $_SESSION['reset_userID'] = $row['ID'];
    } else {
        //naar stap 4
        $step = 4;
    }
}
if( isset( $_POST['password'])) {
    $db_query = "UPDATE  `jukebox` SET `password` = '". password_hash($_POST['password'], PASSWORD_DEFAULT) . "' WHERE ID = ". $_SESSION['reset_userID'];
    $db_result = $conn->prepare($db_query);
    $add_to_db = $db_result->execute();
    //als gelukt  klik op ==> log hier in <==
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Finny-Box</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/form-elements.css">
    <script src="assets/js/jquery.backstretch.min.js"></script>
    <script src="assets/js/scripts.js"></script>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="shortcut icon" href="assets/ico/favicon.png">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">
    <!--===============================================================================================-->
</head>
<body>

<div class="form-gap"></div>
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="text-center">
                        <h3><i class="fa fa-lock fa-4x"></i></h3>
                        <h2 class="text-center">Forgot Password?</h2>
                        <p>You can reset your password here.</p>
                        <div class="panel-body">

                            <form id="register-form" role="form" autocomplete="off" class="form" method="post">

                                <?php
                                if ($step == 1) {
                                    ?>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i
                                                        class="glyphicon glyphicon-envelope color-blue"></i></span>
                                            <input id="email" name="email" placeholder="email address"
                                                   class="form-control" type="email">
                                        </div>
                                    </div>
                                    <?php
                                } elseif ($step == 3) {
                                    ?>

                                    <div class="wrap-input100 validate-input" data-validate="Reset password">
                                        <input class="input100" type="password" name="password"
                                               placeholder=" Reset password">
                                        <span class="focus-input100"></span>
                                        <span class="symbol-input100">
                            </span>
                                    </div>
                                    <?php
                                } elseif ($step = 4) {
                                    ?>

                                    <p>We kennen je niet, maak een account.</p>
                                    <?php


                                }
                                ?>
                                <br>
                                <div class="container-login100-form-btn">
                                    <input name="recover-submit" class="btn btn-lg btn-primary btn-block"
                                           value="Reset Password" type="submit">
                                </div>
                                <br>
                                <div class="text-center p-t-136">
                                    <a class="txt2" href="index.php">
                                        Log hier in.
                                        <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
                                    </a>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>

                <!--===============================================================================================-->
                <script src="assets/jquery/jquery-3.2.1.min.js"></script>
                <!--===============================================================================================-->
                <script src="vendor/bootstrap/js/popper.js"></script>
                <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
                <!--===============================================================================================-->
                <script src="vendor/select2/select2.min.js"></script>
                <!--===============================================================================================-->
                <script src="vendor/tilt/tilt.jquery.min.js"></script>
                <script >
                    $('.js-tilt').tilt({
                        scale: 1.1
                    })
                </script>
                <!--===============================================================================================-->
                <script src="js/main.js"></script>

</body>
</html>