<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">iForum</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <!-- Navigation Links -->
        <li class="nav-item"><a class="nav-link active" href="index.php">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Categories</a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Python</a></li>
            <li><a class="dropdown-item" href="#">Java</a></li>
            <li><a class="dropdown-item" href="#">C++/C</a></li>
            <li><a class="dropdown-item" href="#">R Programming</a></li>
            <li><a class="dropdown-item" href="#">Version Control</a></li>
          </ul>
        </li>
        <li class="nav-item"><a class="nav-link" href="#">Services</a></li>
        <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
      </ul>

      <!-- Search Bar -->
      <form class="d-flex" role="search" action="searchresults.php">
        <input class="form-control me-2" type="search" name="search" placeholder="Search" required>
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>

      <!-- Conditional Buttons -->
      <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true): ?>
        <!-- Show user icon and logout -->
        <div class="d-flex align-items-center mx-3 text-white">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-person-circle me-2" viewBox="0 0 16 16">
            <path d="M11 10a2 2 0 1 0-4 0 2 2 0 0 0 4 0z"/>
            <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 1 0 0 14A7 7 0 0 0 8 1z"/>
          </svg>
          <?php echo htmlspecialchars($_SESSION['username']); ?>
        </div>
        <a href="partials/_logoutHandler.php" class="btn btn-outline-danger mx-2">Logout</a>
      <?php else: ?>
        <!-- Show login/signup buttons -->
        <button class="btn btn-success mx-2" data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#signupModal">Signup</button>
      <?php endif; ?>
    </div>
  </div>
</nav>

<!-- Modals -->
<?php include "partials/_loginModal.php" ?>
<?php include "partials/_signupModal.php" ?>
