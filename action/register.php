<?php include "db.php"; ?>
<?php
if (isset($_POST['submit'])) {

    if (isset($_POST['username'])) {
        $username = $_POST['username'];
    }
    if (isset($_POST['firstname'])) {
        $firstname = $_POST['firstname'];
    }
    if (isset($_POST['lastname'])) {
        $lastname = $_POST['lastname'];
    }
    if (isset($_POST['email'])) {
        $email = $_POST['email'];
    }

    if (isset($_POST['password'])) {
        $password = $_POST['password'];
    }

    $information =
        $username &&
        $firstname &&
        $lastname &&
        $email &&
        $password;


    if (isset($_POST["username"])) {
        if (empty($username)) {
            echo "Vul AUB iets in <br>";
        }
    }

    if (isset($_POST["firstname"])) {
        if (empty($firstname)) {
            echo "Vul AUB iets in <br>";
        }
    }

    if (isset($_POST["lastname"])) {
        if (empty($lastname)) {
            echo "Vul AUB iets in <br>";
        }
    }

    if (isset($_POST["email"])) {
        if (empty($email)) {
            echo "Vul AUB een email in <br>";
        }
    }

    if (isset($_POST["password"])) {
        if (empty($password)) {
            echo "Vul AUB uw wachtwoord in<br>";
        }
    }


    if (!empty($information)) {

        $stmt = $conn->prepare("SELECT firstname FROM jukebox WHERE firstname = :firstname");
        $stmt->bindParam(':firstname', $firstname);
        $stmt->execute();


        $db_query = "INSERT INTO `jukebox`(
    `username`,
    `firstname`,
    `lastname`,
    `email`,
    `password`)
    
    VALUES(
    :username,
    :firstname,
    :lastname,
    :email,
    :password)";


        $db_result = $conn->prepare($db_query);
        $add_to_db = $db_result->execute(array(

            ":username" => $username,
            ":firstname" => $firstname,
            ":lastname" => $lastname,
            ":email" => $email,
            ":password" => password_hash($password, PASSWORD_DEFAULT)
        ));
    }
}

?>
<form class="login100-form validate-form" method="POST">
    <div class="form-group" data-validate=" ">
        <input class="form-username form-control" type="text" name="username" placeholder="username">
        <span class="focus-input100" data-placeholder="username"></span>
    </div>
    <div class="form-group" data-validate=" ">
        <input class="form-username form-control" type="text" name="firstname" placeholder="firstname">
        <span class="focus-input100" data-placeholder="firstname"></span>
    </div>
    <div class="form-group" data-validate="">
        <input class="form-username form-control" type="text" name="lastname" placeholder="lastname">
        <span class="focus-input100" data-placeholder="lastname"></span>
    </div>
    <div class="form-group" data-validate="Valid email is: a@b.c">
        <input class="form-username form-control" type="text" name="email" placeholder="E-mail">
        <span class="focus-input100" data-placeholder="email"></span>
    </div>
    <div class="form-group" data-validate="Wachtwoord verplicht">
        <input class="form-username form-control" type="password" name="password" placeholder="Wachtwoord">
        <span class="focus-input100" data-placeholder="password"></span>
    </div>
    <div class="container-login100-form-btn">
        <button class="login100-form-btn" name="submit">
            Register
        </button>
    </div>
    <div class="text-center p-t-4">
			<span class="txt1">
				Wachtwoord
			</span>
        <a class="txt2" href="../forgotpassword.php">
            vergeten?
        </a>
    </div>
    <div class="text-center p-t-60">
        <a id="AlAccount" class="txt2">
            Heeft u al een account?
            <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
        </a>
    </div>
</form>