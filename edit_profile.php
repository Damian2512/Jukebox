<?php
session_start();
//print_r( $_SESSION );
if (!isset($_SESSION['ID'])) {
    header("Location:index.php");
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

        <?php
        require 'action/db.php';
        $sql = 'SELECT * FROM jukebox';
        $statement = $conn->prepare($sql);
        $statement->execute();
        $people = $statement->fetchAll(PDO::FETCH_OBJ);
        ?>

        <!--Hier begint het formulier voor het updaten van het ingelogde account-->
        <div class="container">
            <div class="card mt-5">
                <div class="card-header">
                    <h2>All people</h2>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <?php foreach ($people as $person): ?>
                            <tr>
                                <th>ID</th>
                                <td><?= $person->ID; ?></td>
                            </tr>
                            <tr>
                                <th>Username</th>
                                <td><?= $person->username; ?></td>
                            </tr>
                            <tr>
                                <th>Firstname</th>
                                <td><?= $person->firstname; ?></td>
                            </tr>
                            <tr>
                                <th>Lastname</th>
                                <td><?= $person->lastname; ?></td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td><?= $person->email; ?></td>
                            </tr>
                            <tr>

                                <th></th>
                                <td><a href="edit.php?id=<?= $person->ID ?>" class="btn btn-info">Edit</a></td>

                            </tr>
                        <?php endforeach; ?>
                    </table>
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

