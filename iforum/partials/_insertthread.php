<?php
session_start();
include "_dbconnect.php";
$insSuccess = false;
if($_SERVER['REQUEST_METHOD'] == "POST"){
    $title = $_POST['title'];
    $desc = $_POST['desc'];
    $thread_cat_id = $_POST['thread_cat_id'];
    $username = $_SESSION['username'];
    $usersql = "SELECT * FROM  `users` WHERE `username`='$username'";
    $userresult = mysqli_query($conn, $usersql);
    $users = mysqli_fetch_assoc($userresult);
    $user_id = $users['user_id'];

    $thread_insert_sql = "INSERT INTO `threads` (`thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`) VALUES ('$title', '$desc', '$thread_cat_id', '$user_id')";
    $thread_insert_result = mysqli_query($conn, $thread_insert_sql);
    $insSuccess = true;
}
if($insSuccess){
    header("location: /php_tut/iforum/threadslist.php?thread_cat_id=$thread_cat_id&success=true");
}
else {
    echo "<div class='container mt-5'>
            <div class='alert alert-success alert-dismissible fade show' role='alert'>
            <strong>Error!</strong> Your Question has not been added.
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
        </div>";
    }
?>