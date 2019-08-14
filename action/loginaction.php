<?php
include "db.php";
session_start();
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