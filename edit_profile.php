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
            <p class="gebruikersnaam"><?php echo $_SESSION['ID']; ?></p>
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
        $sql = "SELECT * FROM jukebox" ;
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
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Username</th>
                                <th>Firstname</th>
                                <th>Lastname</th>
                                <th>Email</th>
                                <th>Updaten</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td><?php echo $person->ID; ?></td>
                                <td><?php echo $person->username; ?></td>

                                <td><?php echo $person->firstname; ?></td>

                                <td><?php echo $person->lastname; ?></td>

                                <td><?php echo $person->email; ?></td>
                                <td><a class="btn btn-info" data-toggle="modal" data-target="#myModal">Edit</a></td>
                            </tr>
                            </tbody>
                        <?php endforeach; ?>
                    </table>
                </div>
            </div>
        </div><!-- Hier eindigd het form-->

        <!-- Modal -->
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">

                <?php
                //require 'action/db.php';
                //$id = $_GET['id'];
                $sql = "SELECT * FROM jukebox WHERE email = '".$_SESSION['email']."'";
                $statement = $conn->prepare($sql);
                $statement->execute();
                $person = $statement->fetch(PDO::FETCH_OBJ);
                if (isset ($_POST['username'])  && isset($_POST['firstname'])  && isset($_POST['lastname'])  && isset($_POST['email']) ) {
                    $username = $_POST['username'];
                    $firstname = $_POST['firstname'];
                    $lastname = $_POST['lastname'];
                    $email = $_POST['email'];
                    $sql = 'UPDATE jukebox SET username=:username, firstname=:firstname, lastname=:lastname, email=:email WHERE ID=:id';
                    $statement = $conn->prepare($sql);
                    if ($statement->execute([':username' => $username, ':firstname' => $firstname, ':lastname' => $lastname, ':email' => $email, ':id' => $id])) {
                        header("Location: edit_profile.php");
                    }
                }
                ?>

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Update Account</h4>
                    </div>
                    <div class="modal-body">
                        <form method="post">
                            <div class="form-group">

                                <input value="<?= $person->id; ?>" type="hidden" name="id" id="id" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="name">Username</label>
                                <input value="<?= $person->username; ?>" type="text" name="username" id="username"
                                       class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="name">Firstname</label>
                                <input value="<?= $person->firstname; ?>" type="text" name="firstname" id="firstname"
                                       class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="name">Lastname</label>
                                <input value="<?= $person->lastname; ?>" type="text" name="lastname" id="lastname"
                                       class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" value="<?= $person->email; ?>" name="email" id="email"
                                       class="form-control">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-info">Update person</button>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div><!--end modal content-->
            </div><!--end modal dialog-->
        </div><!--eind modal-->

    </div><!-- Page Content Holder -->


</div><!--end wrapper-->


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

