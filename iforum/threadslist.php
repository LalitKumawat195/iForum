<?php
session_start();
if(!isset($_SESSION['username']) || $_SESSION['loggedin'] !== true){
    header("location: categorieslist.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>iForum - Coding Discussions</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
    body {
        font-family: 'Raleway', sans-serif;
        background-color: #f0f2f5;
        color: #343a40;
    }

    .jumbotron-custom {
        background: linear-gradient(135deg, #e3f2fd, #ffffff);
        padding: 2rem 2.5rem;
        border-radius: 1rem;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.08);
        margin-top: 2rem;
    }

    .forum-rules ol {
        padding-left: 1.5rem;
        font-size: 0.95rem;
        margin-bottom: 0;
    }

    .thread-card {
        background: #ffffff;
        padding: 1.5rem;
        border-radius: 0.75rem;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.06);
        transition: all 0.4s ease;
        cursor: pointer;
    }

    .thread-card:hover {
        background: #e9f5ff;
        transform: translateY(-5px);
        box-shadow: 0 6px 14px rgba(0, 0, 0, 0.1);
    }

    .thread-title {
        font-weight: 600;
        font-size: 1.2rem;
        color: #212529;
    }

    .thread-description {
        font-size: 0.95rem;
        color: #6c757d;
    }

    .thread-meta {
        font-size: 0.85rem;
        color: #adb5bd;
    }

    .page-header {
        font-weight: 700;
        text-align: center;
        color: #0d6efd;
        margin-bottom: 2rem;
    }

    .ask-btn {
        position: fixed;
        bottom: 30px;
        right: 30px;
        background: #0d6efd;
        color: #fff;
        font-weight: 600;
        border: none;
        border-radius: 50px;
        padding: 12px 20px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        transition: 0.3s;
    }

    .ask-btn:hover {
        background: #0b5ed7;
        transform: scale(1.05);
    }

    .search-bar {
        max-width: 400px;
        margin: 0 auto 2rem auto;
    }

    hr.my-4 {
        border-top: 2px solid #dee2e6;
    }
    </style>
</head>

<body>

    <?php include "partials/_dbconnect.php"; ?>
    <?php include "partials/_header.php"; ?>

<?php
if(isset($_GET['success'])){
    echo "<div class='container mt-5'>
    <div class='alert alert-success alert-dismissible fade show' role='alert'>
      <strong>Success!</strong> Your Question has been added successfully.
      <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
    </div>
    </div>";
}
?>

<?php
$cat_id = $_GET['thread_cat_id'];
    $sql = "SELECT * FROM `categories` WHERE `category_id` = '$cat_id';";
    $result = mysqli_query($conn, $sql);
    $category = mysqli_fetch_assoc($result);

?>

    <?php if ($category): ?>
    <!-- Category Banner -->
    <div class="container">
        <div class="jumbotron-custom">
            <h1 class="display-6 fw-bold mb-3">Welcome to <?= htmlspecialchars($category['category_name']) ?> Forum</h1>
            <p class="lead"><?= htmlspecialchars($category['category_description']) ?></p>
            <h4 class="fw-semibold">Forum Rules</h4>
            <div class="forum-rules mb-3">
                <ol>
                    <li>Be respectful and polite to all members.</li>
                    <li>No harassment, discrimination, or hate speech.</li>
                    <li>Debate ideas, not individuals.</li>
                    <li>Stay on topic within discussions.</li>
                    <li>No spam or repeated messages.</li>
                    <li>Write clearly and avoid excessive emojis.</li>
                    <li>Protect privacy and avoid sharing personal information.</li>
                    <li>Only post authorized or original content.</li>
                    <li>Report any issues to moderators peacefully.</li>
                </ol>
            </div>
            <a href="#" class="btn btn-outline-primary btn-sm">Learn More</a>
        </div>
    </div>
    <?php endif; ?>

    <hr class="my-4">

    <!-- Browse Questions Section -->
    <div class="container mb-5">
        <h2 class="page-header">Browse Questions</h2>

        <!-- Search Bar -->
        <div class="search-bar">
            <input type="text" class="form-control mb-4" placeholder="Search questions...">
        </div>

        <!-- Sort Dropdown -->
        <div class="d-flex justify-content-end mb-4">
            <select class="form-select w-auto">
                <option selected>Sort by</option>
                <option value="1">Latest</option>
                <option value="2">Popular</option>
                <option value="3">Unanswered</option>
            </select>
        </div>

        <!-- Threads Listing -->
        <div class="row gy-4">
            <?php
            $threadSql = "SELECT * FROM `threads` WHERE `thread_cat_id` = '$cat_id';";
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
            <p class="text-center">No questions found in this category. Be the first to ask!</p>
            <?php endif; ?>
        </div>


        <!-- Floating Ask Question Button -->
        <button href="#" class="ask-btn"  data-bs-toggle="modal" data-bs-target="#threadModal">Ask Question</button>

    </div>

    <?php include "partials/_footer.php"; ?>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
<?php include "partials/_threadModal.php"; ?>