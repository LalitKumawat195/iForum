<?php
include "_dbconnect.php";

// Flags to control which modal to show
$showSuccessModal = false;
$showUserExistsModal = false;
$showPasswordMismatchModal = false;

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $fullname = $_POST['fullname'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];

    $existsql = "SELECT * FROM `users` WHERE `username` = '$username'";
    $result = mysqli_query($conn, $existsql);
    $numrows = mysqli_num_rows($result);

    if ($numrows > 0) {
        $showUserExistsModal = true;
        header("location: /php_tut/iforum/index.php?showUserExistsModal=true");
    } else {
        if ($password == $cpassword) {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $insertsql = "INSERT INTO `users` (`fullname`, `username`, `email`, `mobile`, `dob`, `gender`, `address`, `password`) 
                          VALUES ('$fullname', '$username', '$email', '$mobile', '$dob', '$gender', '$address', '$hash')";
            $result = mysqli_query($conn, $insertsql);
            if ($result) {
                $showSuccessModal = true;
                header("location: /php_tut/iforum/index.php?showSuccessModal=true");
            }
        } else {
            $showPasswordMismatchModal = true;
            header("location: /php_tut/iforum/index.php?showPasswordMismatchModal=true");
        }
    }
}
?>

