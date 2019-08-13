<form action="" method="post" class="login-form">
			                    	<!-- Login form -->
                                    <div class="form-group">
			                    		<label class="sr-only" for="form-username">Email</label>
			                        	<input type="text" name="email" placeholder="Email" class="form-username form-control" id="form-username">
			                        </div>

			                        <div class="form-group">
			                        	<label class="sr-only" for="form-password">Password</label>
			                        	<input type="password" name="password" placeholder="Password" class="form-password form-control" id="form-password">
			                        </div>
			                        <input type="submit" name="submit" value="Login" class="login100-form-btn" >
                                        <!-- Code -->
                                            <div class="text-center p-t-12">
                                                <span class="txt1">
                                                    Wachtwoord
                                                </span>
                                                <a class="txt2" href="../forgotpassword.php">
                                                    vergeten?
                                                </a>
                                            </div>

                                            <div class="text-center p-t-80">
                                                <a class="txt2" id="RegisterButton">
                                                    Maak een account aan
                                                    <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
                                                </a>
                                            </div>
                                        <!-- Code -->
                                    <!-- Einde login form -->
			                    </form>

<?php
include "db.php";

if(isset($_POST['submit'])){


    $email = !empty($_POST['email']) ? trim($_POST['email']) : null;
    $passwordAttempt = !empty($_POST['password']) ? trim($_POST['password']) : null;

    $sql = "SELECT ID ,email, password FROM jukebox WHERE email = :email";

    $stmt = $conn->prepare($sql);


    $stmt->bindValue(':email', $email);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);


    if($user){
        $validPassword = password_verify($passwordAttempt, $user['password']);
        //$validPassword = ( $user['password'] == $passwordAttempt );
        if($validPassword){

            $_SESSION['ID'] = $user['email'];
            $_SESSION['logged_in'] = time();

            $_SESSION['email'] = $email;


           header("Location: ../main.php");

            exit();

        }else{
            var_dump($user['password'], $passwordAttempt);
            echo "Dit wachtwoord/E-mail is incorrect";

        }
    } else {
        die( 'Fout: user niet gevonden');
    }
}
?>
