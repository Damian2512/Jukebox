<?php
session_start();
// print_r( $_SESSION );

if (!isset($_SESSION['ID'])) {
    header("Location:index.php");
}
?>

<?php
require_once("action/db.php");

$sql = "SELECT * FROM jukebox WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':username', $username);
$stmt->bindParam(':surname', $surname);
$stmt->bindParam(':lastname', $lastname);
$stmt->bindParam(':email', $email);

$stmt->bindValue(':username', $username);
$stmt->bindValue(':surname', $surname);
$stmt->bindValue(':lastname', $lastname);
$stmt->bindValue(':email', $email);

$stmt->execute(array($_SESSION['ID']));
$stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html>
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

<style>
    .profielfoto {
        margin-left: 37px;
        margin-top: -20px;
        width: 100px;
        height: 100px;
        float: left;
        border-radius: 5px;
    }

    .gebruikersnaam {
        color: white;
        float: left;
        margin-top: 15px;
    }

    .sublink {
        color: white;
        font-size: 11px;
        text-decoration: underline;
        margin-top: -40px;
    }

    #accordion {
        position: fixed;
        bottom: -20px !important;
        width: 100%;
    }

    .panel-default > .panel-heading {
        background: #00B4FF;
    }

    .panel-heading {
        padding: 0;
        border-top-left-radius: 0px;
        border-top-right-radius: 0px;
    }

    .panel {
        border: solid white 0px !important;
    }

    .panel-group .panel {
        border-radius: 0;
    }

    .panel-title a {
        color: #FFFFFF;
        text-align: center;
        width: 100%;
        display: block;
        padding: 10px 15px;
        font-size: 24px;
        font-family: Helvetica, Arial, sans-serif;
        outline: none;
        background-color: #7386D5;
    }

    .panel-title a:hover, .panel-title a:focus, .panel-title a:active {
        text-decoration: none;
        outline: none;
    }
</style>

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
                <a href="#"><i class="fa fa-archive"></i> Bladeren</a>
            </li>

            <li>
                <a href="#"><i class="fa fa-music"></i> Radio</a>
            </li>

            <li>
                <a href="#"><i class="fa fa-user-circle"></i> Artist</a>
            </li>

            <li>
                <a href="#"><i class="fa fa-archive"></i> Album</a>
            </li>

            <li>
                <a href="#"><i class="fa fa-clock-o"></i> Recentelijk afgespeeld</a>
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

                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="#">Page</a></li>
                        <li><a href="#">Page</a></li>
                        <li><a href="#">Page</a></li>
                        <li><a href="#">Page</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container">
            <div class="col-m-12">


                <div class="content">
                    <form name="edit" class="login-form" action="" method="post">
                        <p id="page_titel">Edit profile</p>
                        <input type="hidden" name="id" id="id" value="<?php echo $ID; ?>"/>
                        <label>Username: </label><br>
                        <input type="text" name="username" id="username"
                               value="<?php echo $username; ?>"/><br>
                        <label>Surname: </label><br>
                        <input type="text" name="surname" id="surname"
                               value="<?php echo $surname; ?>"/><br>
                        <label>Lastname: </label><br>
                        <input type="text" name="lastname" id="lastname"
                               value="<?php echo $lastname; ?>"/><br>
                        <label>Email: </label><br>
                        <input type="text" name="email" id="email" value="<?php echo $email; ?>"/>
                        <br>
                        <br>
                        <div class="icon_container">
                            <input type="submit" class="btn btn-block" id="submit" name="submit" value="Update"/>
                        </div>
                        <a href="main.php">Terug</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="panel-group" id="accordion">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                    Zoek een video!
                </a>
            </h4>
        </div>
        <div id="collapseOne" class="panel-collapse collapse">
            <div class="panel-body">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            Hier komt een zoekbalk
                        </div>
                    </div>
                </div>
            </div>
        </div>
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

