<?php
session_start();
if(!isset($_SESSION['username']) || $_SESSION['loggedin'] !== true){
    $firstLogin = true;
}
?>
<?php
    $loginSuccess = isset($_GET['loginSuccess']) && $_GET['loginSuccess'] === 'true';
    $invUser = isset($_GET['invUser']) && $_GET['invUser'] === 'true';
    $invPass = isset($_GET['invPass']) && $_GET['invPass'] === 'true';
?>
<?php
    $showSuccessModal = isset($_GET['showSuccessModal']) && $_GET['showSuccessModal'] === 'true';
    $showUserExistsModal = isset($_GET['showUserExistsModal']) && $_GET['showUserExistsModal'] === 'true';
    $showPasswordMismatchModal = isset($_GET['showPasswordMismatchModal']) && $_GET['showPasswordMismatchModal'] === 'true';
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>iForum - Coding Forum</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">


</head>

<body>
    <?php include "partials/_dbconnect.php"; ?>
    <?php include "partials/_header.php"; ?>

    <?php

    if(isset($_GET['showError'])){
        $showError = $_GET['showError'];
        echo "<div class='container mt-5'>
                <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                <strong>Error!</strong> '$showError'.
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>
            </div>";
    }
    if(isset($_GET['showAlert'])){
        $showAlert = $_GET['showAlert'];
        echo "<div class='container mt-5'>
                <div class='alert alert-success alert-dismissible fade show' role='alert'>
                <strong>Success!</strong> '$showAlert'.
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>
            </div>";
    }
    ?>

    <!-- Slider -->
    <div id="carouselExampleIndicators" class="carousel slide">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
        </div>

        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="https://plus.unsplash.com/premium_photo-1678566111483-f45ad346d50a?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1yZWxhdGVkfDEyfHx8ZW58MHx8fHx8"
                    class="d-block w-100" alt="..." height="400">
            </div>
            <div class="carousel-item">
                <img src="https://plus.unsplash.com/premium_photo-1678565879444-f87c8bd9f241?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1yZWxhdGVkfDIwfHx8ZW58MHx8fHx8"
                    class="d-block w-100" alt="..." height="400">
            </div>
            <div class="carousel-item">
                <img src="https://images.unsplash.com/photo-1627398242454-45a1465c2479?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1yZWxhdGVkfDQwfHx8ZW58MHx8fHx8"
                    class="d-block w-100" alt="..." height="400">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <h1 class="text-center mt-5">Hello, Welcome to iForum Categories!</h1>
    <p class="text-center">This is a Coding Forum where you can share your ideas and thoughts and discuss them with
        other coders.</p>

<!-- Categories Section -->
<div class="container mt-5">
    <h2 class="text-center mb-5" style="font-family: 'Poppins', sans-serif;">Explore Categories</h2>
    <div class="row">
        <?php
        $sql1 = "SELECT * FROM `categories`";
        $result = mysqli_query($conn, $sql1);
        $id = 1; // Unique id for Read More button

        while($row = mysqli_fetch_assoc($result)){
            $fullDesc = $row['category_description'];
            $shortDesc = substr($fullDesc, 0, 100); // Only show first 100 characters

            echo "
            <div class='col-md-4 mb-4'>
                <div class='card h-100 shadow-sm rounded-4 overflow-hidden'>
                    <div class='ratio ratio-4x3'>
                        <img src='".htmlspecialchars($row['category_image'])."' class='card-img-top' alt='Category Image' style='object-fit: cover;'>
                    </div>
                    <div class='card-body d-flex flex-column'>
                        <h5 class='card-title text-center'><a href='threadslist.php?thread_cat_id=".$row['category_id']."'>".htmlspecialchars($row['category_name'])."</a></h5>
                        <p class='card-text flex-grow-1'>
                            <span id='shortDesc$id'>".htmlspecialchars($shortDesc)."...</span>
                            <span id='fullDesc$id' style='display:none;'>".htmlspecialchars($fullDesc)."</span>
                            <button class='btn btn-link p-0' style='font-size: 0.9rem;' onclick='toggleDescription($id)' id='readMoreBtn$id'>Read More</button>
                        </p>
                        <a href='threadslist.php?thread_cat_id=".$row['category_id']."' class='btn btn-success mt-auto'>View Category</a>
                    </div>
                </div>
            </div>";
            $id++;
        }
        ?>
    </div>
</div>

    <?php include "partials/_footer.php"; ?>
    <!-- Bootstrap JS Bundle (with Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- JavaScript for Read More functionality -->
    <script>
    function toggleDescription(id) {
        var shortDesc = document.getElementById('shortDesc' + id);
        var fullDesc = document.getElementById('fullDesc' + id);
        var button = document.getElementById('readMoreBtn' + id);

        if (shortDesc.style.display === "none") {
            shortDesc.style.display = "inline";
            fullDesc.style.display = "none";
            button.innerText = "Read More";
        } else {
            shortDesc.style.display = "none";
            fullDesc.style.display = "inline";
            button.innerText = "Read Less";
        }
    }
    </script>
</body>
</html>
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- First login Modal -->
<div class="modal fade" id="firstLoginModal" tabindex="-1" aria-labelledby="firstLoginModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">First Login</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">Login to ask questions</div>
      <div class="modal-footer">
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#loginModal" data-bs-dismiss="modal">Login</button>
      </div>
    </div>
  </div>
</div>

<!-- Success Modal -->
<div class="modal fade" id="signupSuccessModal" tabindex="-1" aria-labelledby="signupSuccessModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Success</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">Your account has been created successfully!</div>
      <div class="modal-footer">
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#loginModal" data-bs-dismiss="modal">Login</button>
      </div>
    </div>
  </div>
</div>

<!-- Username Exists Error Modal -->
<div class="modal fade" id="userExistsModal" tabindex="-1" aria-labelledby="userExistsModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content border border-danger">
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title">Error</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">Username already exists. Please try a different one.</div>
    </div>
  </div>
</div>

<!-- Password Mismatch Modal -->
<div class="modal fade" id="passwordMismatchModal" tabindex="-1" aria-labelledby="passwordMismatchModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content border border-warning">
      <div class="modal-header bg-warning text-dark">
        <h5 class="modal-title">Error</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">Passwords do not match. Please try again.</div>
    </div>
  </div>
</div>

<!-- Success Modal -->
<div class="modal fade" id="loginSuccessModal" tabindex="-1" aria-labelledby="loginSuccessModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content border-success">
      <div class="modal-header bg-success text-white">
        <h5 class="modal-title">Login Successful</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        Welcome to the Forum</strong>!
      </div>
    </div>
  </div>
</div>

<!-- Invalid Username -->
<div class="modal fade" id="invalidUsername" tabindex="-1" aria-labelledby="invalidUsernameLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content border-danger">
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title">Login Failed</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <?php echo htmlspecialchars("Invalid Username"); ?>
      </div>
    </div>
  </div>
</div>

<!-- Invalid Password -->
<div class="modal fade" id="invalidPassword" tabindex="-1" aria-labelledby="invalidPasswordLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content border-danger">
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title">Login Failed</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <?php echo htmlspecialchars("Invalid Password"); ?>
      </div>
    </div>
  </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- Show appropriate modal -->
<script>
<?php if ($showSuccessModal): ?>
    var successModal = new bootstrap.Modal(document.getElementById("signupSuccessModal"));
    successModal.show();
<?php endif; ?>

<?php if ($showUserExistsModal): ?>
    var userExistsModal = new bootstrap.Modal(document.getElementById("userExistsModal"));
    userExistsModal.show();
<?php endif; ?>

<?php if ($showPasswordMismatchModal): ?>
    var passwordMismatchModal = new bootstrap.Modal(document.getElementById("passwordMismatchModal"));
    passwordMismatchModal.show();
<?php endif; ?>

<?php if ($firstLogin): ?>
    var firstLoginModal = new bootstrap.Modal(document.getElementById("firstLoginModal"));
    firstLoginModal.show();
<?php endif; ?>
</script>

<script>
<?php if ($loginSuccess): ?>
    var successModal = new bootstrap.Modal(document.getElementById('loginSuccessModal'));
    successModal.show();
<?php elseif (!empty($invUser)): ?>
    var errorModal = new bootstrap.Modal(document.getElementById('invalidUsername'));
    errorModal.show();
<?php elseif (!empty($invPass)): ?>
    var errorModal = new bootstrap.Modal(document.getElementById('invalidPassword'));
    errorModal.show();
<?php endif; ?>
</script>

