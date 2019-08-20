<?php
session_start();
// print_r( $_SESSION );
if (!isset($_SESSION['ID'])) {
    header("Location:index.php");
}
?>

<?php
require_once("action/db.php");

if (isset($_POST['submit'])) {

    $username = $_POST['username'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $id = $_SESSION['ID'];

    $sql = "UPDATE jukebox SET username=:username, firstname=:firstname, lastname=:lastname, email=:email WHERE ID=:id";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(":username", $username, PDO::PARAM_STR);
    $stmt->bindValue(":firstname", $firstname, PDO::PARAM_STR);
    $stmt->bindValue(":lastname", $lastname, PDO::PARAM_STR);
    $stmt->bindValue(":email", $email, PDO::PARAM_STR);
    $stmt->bindValue(":id", $_SESSION['ID'], PDO::PARAM_STR);
    $stmt->execute();

}
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>FinnyBox</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>

<div class="wrapper">
    <!-- Sidebar Holder -->
    <nav id="sidebar">
        <div class="sidebar-header">
            <!-- Profielfoto Als geupload -->
            <img src="images/male.png"
                 class="img-responsive profielfoto">
            <!-- Gebruikersnaam -->
            <p class="gebruikersnaam"><?php echo $_SESSION['email']; ?></p>
            <br>
            <br>
            <br>
            <br>

            <a class="sublink" href="edit_profile.php">Profiel bewerken</a>

        </div>

        <br>
        <br>
        <br>
        <ul class="list-unstyled components">
            <li class="active">
                <a href="main.php"><i class="fa fa-archive"></i> Home</a>
            </li>

            <li>
                <a href="youtube/youtube.php"><i class="fa fa-youtube-play"></i> Youtube</a>
            </li>
            <li>
                <a href="#"><i class="fa fa-user-circle"></i> Radio</a>
            </li>
        </ul>

        <ul class="list-unstyled CTAs">
            <li><a href="action/logout.php" class="download"><i class="fa fa-lock"></i> Uitloggen</a></li>
        </ul>
    </nav>

    <!-- Page Content Holder -->
    <div style="width: 100%;" id="content">

        <nav class="navbar navbar-default">
            <div class="container-fluid">

                <div class="navbar-header">
                    <button type="button" id="sidebarCollapse" class="btn btn-info navbar-btn">
                        <i class="glyphicon glyphicon-align-left"></i>
                        <span>Navigatie verbergen</span>
                    </button>
                </div>
            </div>
        </nav>
<!--Hier begint het formulier voor het updaten van het ingelogde account-->
        <div class="container">
            <div class="col-md-12">
                <div class="content">
                    <form role="form" method="POST" action="">
                        <table class='table table-hover table-responsive table-bordered'>

                            <input type="hidden" name="id" id="id" value=" "/>
                            <tr>
                                <td>Username</td>
                                <td><input type="text" name="username" value=" "
                                           class='form-control'/>

                                </td>
                            </tr>

                            <tr>
                                <td>Firstname</td>
                                <td><input type="text" name="firstname" value=" "
                                           class='form-control'/></td>
                            </tr>

                            <tr>
                                <td>Lastname</td>
                                <td><input type="text" name="lastname" value=" "
                                           class='form-control'/>
                                </td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td><input type="text" name="email" value=" "
                                           class='form-control'/>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <input type="submit" name="submit" class="btn btn-primary btn-block" value="Update">
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>
<!-- Hier eindigd het form-->

    </div>
</div>


<script>
    $('#collapseOne').on('show.bs.collapse', function () {
        $('.panel-heading').animate({
            backgroundColor: "#515151"
        }, 500);
    })

    $('#collapseOne').on('hide.bs.collapse', function () {
        $('.panel-heading').animate({
            backgroundColor: "#00B4FF"
        }, 500);
    })
</script>


<!-- jQuery CDN -->
<script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
<!-- Bootstrap Js CDN -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script type="text/javascript">
    $(document).ready(function () {
        $('#sidebarCollapse').on('click', function () {
            $('#sidebar').toggleClass('active');
        });
    });
</script>
</body>
</html>

