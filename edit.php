<?php
require 'action/db.php';
$id = $_GET['id'];
$sql = 'SELECT * FROM jukebox WHERE id=:id';
$statement = $conn->prepare($sql);
$statement->execute([':id' => $id ]);
$person = $statement->fetch(PDO::FETCH_OBJ);
if (isset ($_POST['username'])  && isset($_POST['firstname'])  && isset($_POST['lastname'])  && isset($_POST['email']) ) {
    $username = $_POST['username'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $sql = 'UPDATE jukebox SET username=:username, firstname=:firstname, lastname=:lastname, email=:email WHERE id=:id';
    $statement = $conn->prepare($sql);
    if ($statement->execute([':username' => $username, ':firstname' => $firstname, ':lastname' => $lastname, ':email' => $email, ':id' => $id])) {
        header("Location: edit_profile.php");
    }
}
?>

    <div class="container">
        <div class="card mt-5">
            <div class="card-header">
                <h2>Update person</h2>
            </div>
            <div class="card-body">
                <?php if(!empty($message)): ?>
                    <div class="alert alert-success">
                        <?= $message; ?>
                    </div>
                <?php endif; ?>
                <form method="post">
                    <div class="form-group">
                        <label for="name">Username</label>
                        <input value="<?= $person->username; ?>" type="text" name="name" id="name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="name">Firstname</label>
                        <input value="<?= $person->firstname; ?>" type="text" name="name" id="name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="name">Lastname</label>
                        <input value="<?= $person->lastname; ?>" type="text" name="name" id="name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" value="<?= $person->email; ?>" name="email" id="email" class="form-control">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-info">Update person</button>
                    </div>
                </form>
            </div>
        </div>
    </div>