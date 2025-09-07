<?php
include "_dbconnect.php";
$loginSuccess = false;
$invPass = "";
$invUser = "";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];    
    $sql = "SELECT * FROM `users` WHERE `username` = '$username'";
    $result = mysqli_query($conn, $sql);
    $numrows = mysqli_num_rows($result);
    
    if ($numrows > 0) {
        $user = mysqli_fetch_assoc($result);
        if (password_verify($password, $user['password'])) {
            session_start();
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $username;
            $loginSuccess = true;
            header("location: /php_tut/iforum/categorieslist.php?loginSuccess=true");
        } else {
            $invPass = "Invalid Password";
            header("location: /php_tut/iforum/index.php?invPass=true");
        }
    } else {
        $invUser = "Invalid Username";
        header("location: /php_tut/iforum/index.php?invUser=true");
    }
}
?>


