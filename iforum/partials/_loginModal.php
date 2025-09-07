<!-- Bootstrap 5.3 and Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- Google Font -->
<link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;500;600&display=swap" rel="stylesheet">

<!-- Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content rounded-4 shadow-lg">
            <div class="modal-header border-0 pb-0">
                <h2 class="modal-title fs-4" id="loginModalLabel">Login to Your Account</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body py-4">
                <form class="px-3" action="partials/_loginHandler.php" method="post">
                    <!-- Username -->
                    <div class="mb-3">
                        <label for="exampleInputUsername" class="form-label">Username</label>
                        <input type="text" class="form-control rounded-3" name="username" id="exampleInputUsername"
                            placeholder="Enter your username" required>
                    </div>

                    <!-- Password -->
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <div class="input-group">
                            <input type="password" class="form-control rounded-start-3" name="password" id="exampleInputPassword1"
                                placeholder="Enter your password" required>
                            <button class="btn btn-outline-secondary rounded-end-3" type="button"
                                onclick="togglePassword('exampleInputPassword1', 'iconPassword')">
                                <i id="iconPassword" class="bi bi-eye"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Remember Me -->
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">Remember Me</label>
                    </div>

                    <!-- Login Button -->
                    <div class="d-flex gap-3 mt-4">
                        <button type="submit" class="btn btn-success btn-lg rounded-3 flex-fill">Login</button>
                        <button type="reset" class="btn btn-secondary btn-lg rounded-3 flex-fill">Clear</button>
                    </div>


                    <!-- Register Link -->
                    <p class="text-center mt-4 small">
                        Not registered?
                        <a href="#" data-bs-toggle="modal" data-bs-target="#signupModal" data-bs-dismiss="modal"
                            class="text-decoration-none">Register Here</a>
                    </p>
                </form>
            </div>
            <div class="modal-footer border-0 pt-0">
                <small class="text-muted">iForum © 2025. All rights reserved.</small>
            </div>
        </div>
    </div>
</div>

<!-- Password Toggle Script -->
<script>
function togglePassword(inputId, iconId) {
    const input = document.getElementById(inputId);
    const icon = document.getElementById(iconId);
    if (input.type === "password") {
        input.type = "text";
        icon.classList.remove('bi-eye');
        icon.classList.add('bi-eye-slash');
    } else {
        input.type = "password";
        icon.classList.remove('bi-eye-slash');
        icon.classList.add('bi-eye');
    }
}
</script>

<!-- Custom CSS -->

<style>
.modal-content {
    font-family: 'Raleway', sans-serif;
}
</style>