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
                <a href="main.php"><i class="fa fa-home"></i> Home</a>
            </li>

            <li>
                <a href="youtube/youtube.php"><i class="fa fa-youtube-play"></i> Youtube</a>
            </li>
        </ul>

        <ul class="list-unstyled CTAs">
            <li><a href="action/logout.php" class="download"><i class="fa fa-lock"></i> Uitloggen</a></li>
        </ul>
    </nav>

    <!-- Page Content Holder -->
    <div style="width: 100%;" id="content">

        <?php
        require 'action/db.php';
        $sql = "SELECT * FROM `jukebox` WHERE email = '" . $_SESSION['email'] . "'";
        $statement = $conn->prepare($sql);
        $statement->execute();
        $people = $statement->fetchAll(PDO::FETCH_OBJ);
        ?>

        <!--Hier begint het formulier voor het updaten van het ingelogde account-->
        <div class="container">
            <div class="card mt-5">
                <div class="card-header">
                    <h2>My Account</h2>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <?php foreach ($people as $person): ?>

                            <tr>
                                <th>Username</th>
                                <td><?php echo $person->username; ?></td>
                            </tr>
                            <tr>
                                <th>Firstname</th>
                                <td><?php echo $person->firstname; ?></td>
                            </tr>
                            <tr>
                                <th>Lastname</th>
                                <td><?php echo $person->lastname; ?></td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td><?php echo $person->email; ?></td>
                            </tr>
                            <tr>
                                <th>Update</th>
                                <td><a class="btn btn-primary btn-block" data-toggle="modal"
                                       data-target="#myModal">Edit</a></td>
                            </tr>

                        <?php endforeach; ?>
                    </table>
                </div>
            </div>
        </div><!-- Hier eindigd het form-->
        <?php
        if (isset($_POST['submit'])) {
            $data = [
                'id' => $_POST['ID'],
                'username' => $_POST['username'],
                'firstname' => $_POST['firstname'],
                'lastname' => $_POST['lastname'],
                'email' => $_POST['email'],
            ];
            $sql = "UPDATE jukebox SET username = :username, firstname = :firstname, lastname = :lastname, email = :email WHERE id = :id";
            $conn->prepare($sql)->execute($data);

            if ($sql) {
                $_SESSION['email'] = $_POST['email'];
                header("Refresh:0");
            }
        }
        ?>
        <!-- Modal -->
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Update Account</h4>
                    </div>
                    <div class="modal-body">
                        <form method="POST" id="edit_profile" enctype="multipart/form-data">

                            <div class="form-group">
                                <input value="<?php echo $person->ID; ?>" type="hidden" name="ID" id="id"
                                       class="form-control"/>
                            </div>

                            <div class="form-group">
                                <label for="username">Username</label>
                                <input value="<?php echo $person->username; ?>" type="text" name="username"
                                       id="username"
                                       class="form-control"/>
                            </div>
                            <div class="form-group">
                                <label for="firstname">Firstname</label>
                                <input value="<?php echo $person->firstname; ?>" type="text" name="firstname"
                                       id="firstname"
                                       class="form-control"/>
                            </div>
                            <div class="form-group">
                                <label for="lastname">Lastname</label>
                                <input value="<?php echo $person->lastname; ?>" type="text" name="lastname"
                                       id="lastname"
                                       class="form-control"/>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" value="<?php echo $person->email; ?>" name="email" id="email"
                                       class="form-control"/>
                            </div>
                            <input type="submit" id="submit" name="submit" class="btn btn-info" value="Update"/>
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

</body>
</html>

