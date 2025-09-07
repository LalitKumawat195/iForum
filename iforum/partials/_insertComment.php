<?php
session_start();
include "_dbconnect.php";
$insSuccess = false;
if($_SERVER['REQUEST_METHOD'] == "POST"){
    $title = $_POST['title'];
    $desc = $_POST['desc'];
    $comment_thr_id = $_POST['comment_thr_id'];
    $username = $_SESSION['username'];
    $usersql = "SELECT * FROM  `users` WHERE `username`='$username'";
    $userresult = mysqli_query($conn, $usersql);
    $users = mysqli_fetch_assoc($userresult);
    $user_id = $users['user_id'];

    $comment_insert_sql = "INSERT INTO `comments` (`comment_title`, `comment_desc`, `comment_thr_id`, `comment_user_id`) VALUES ('$title', '$desc', '$comment_thr_id', '$user_id')";
    $comment_insert_result = mysqli_query($conn, $comment_insert_sql);
    $insSuccess = true;
}
if($insSuccess){
    header("location: /php_tut/iforum/commentslist.php?threadid=$comment_thr_id&success=true");
}
else{
    echo "<div class='container mt-5'>
    <div class='alert alert-success alert-dismissible fade show' role='alert'>
      <strong>Error!</strong> Your Comment has not been added into the thread.
      <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
    </div>
    </div>";
}

?>