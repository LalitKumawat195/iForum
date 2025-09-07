<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>iForum - Coding Forum</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
    .container {
        min-height: 89vh;
    }

    .searchheading {
        text-align: center;
    }
    </style>

</head>

<body>
    <?php include "partials/_dbconnect.php"; ?>
    <?php include "partials/_header.php"; ?>
    <div class="container my-3">
        <h3 class="searchheading">Search results for <em>"<?php echo $_GET['search']?>"</em></h3>
        <?php
            $search = $_GET['search'];
            $threadSql = "SELECT * FROM `threads` WHERE MATCH(thread_title, thread_desc) against('$search');";
            $threadResult = mysqli_query($conn, $threadSql);

            function timeAgo($time) {
                if (!$time) return "unknown time";
                $time_ago = strtotime($time);
                $current_time = time();
                $time_difference = $current_time - $time_ago;
                if ($time_difference < 0) $time_difference = 0;

                $seconds = $time_difference;
                $minutes = round($seconds / 60);
                $hours = round($seconds / 3600);
                $days = round($seconds / 86400);
                $weeks = round($seconds / 604800);
                $months = round($seconds / 2629440);
                $years = round($seconds / 31553280);

                if ($seconds <= 60) return "$seconds seconds ago";
                elseif ($minutes <= 60) return "$minutes minutes ago";
                elseif ($hours <= 24) return "$hours hours ago";
                elseif ($days <= 7) return "$days days ago";
                elseif ($weeks <= 4.3) return "$weeks weeks ago";
                elseif ($months <= 12) return "$months months ago";
                else return "$years years ago";
            }
            if (mysqli_num_rows($threadResult) > 0):
                while ($thread = mysqli_fetch_assoc($threadResult)):
                    $user = $thread['thread_user_id'];
                    $userSql = "SELECT * FROM `users` WHERE `user_id`='$user' ";
                    $userResult = mysqli_query($conn, $userSql);
                    $user = mysqli_fetch_assoc($userResult);
                    $timeAgo = timeAgo($thread['timestamp']);
                    echo "<div class='col-md-6'>
                <div class='thread-card d-flex align-items-start'>
                    <img src='images/blank_dp.png' class='rounded-circle flex-shrink-0 me-3' alt='User Image' width='50' height='50'>
                    <div>
                        <h5 class='thread-title mb-1'><a href='commentslist.php?threadid={$thread['thread_id']}' text=dark>{$thread['thread_title']}</a></h5>
                        <p class='thread-description mb-2'>{$thread['thread_desc']}</p>
                        <p class='thread-meta'>Posted by {$user['username']} • {$timeAgo}</p>
                    </div>
                </div>
            </div>";
        
                endwhile;
            else:
        ?>
        <div class="p-4 mb-4 bg-light rounded-3">
            <div class="container py-2">
                <h1 class="display-6">No results found</h1>
                <p class="lead">
                <ul>
                    <li>Check you Wording</li>
                    <li>Try Searching something different</li>
                    <li>We couldn’t find anything.</li>
                </ul>
                </p>
            </div>
        </div>

        <?php endif; ?>
    </div>

    <?php include "partials/_footer.php"; ?>
    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Bootstrap JS Bundle (with Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>