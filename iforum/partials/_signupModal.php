<!-- Bootstrap 5.3 and Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- Flatpickr CSS and JS for DOB Picker -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<!-- Google Font -->
<link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;500;600&display=swap" rel="stylesheet">

<!-- Modal -->
<div class="modal fade" id="signupModal" tabindex="-1" aria-labelledby="signupModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content rounded-4 shadow-lg">

            <!-- Modal Header -->
            <div class="modal-header border-0 pb-0">
                <h2 class="modal-title fs-4" id="signupModalLabel">Create Your Account</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body py-4">
                <form class="px-3" action="partials/_signupHandler.php" method="post">

                    <!-- Full Name -->
                    <div class="mb-3">
                        <label for="fullName" class="form-label">Full Name</label>
                        <input type="text" class="form-control rounded-3" name="fullname" id="fullName" placeholder="John Doe" required>
                    </div>

                    <!-- Username -->
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control rounded-3" name="username" id="username" placeholder="john_doe123"
                            required>
                    </div>

                    <!-- Email -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" class="form-control rounded-3" name="email" id="email" placeholder="example@email.com"
                            required>
                    </div>

                    <!-- Mobile Number -->
                    <div class="mb-3">
                        <label for="mobile" class="form-label">Mobile Number</label>
                        <input type="tel" class="form-control rounded-3" name="mobile" id="mobile" placeholder="9876543210" required>
                    </div>

                    <!-- Date of Birth (Flatpickr) -->
                    <div class="mb-3">
                        <label for="dob" class="form-label">Date of Birth</label>
                        <input type="text" class="form-control rounded-3" name="dob" id="dob"
                            placeholder="Select your date of birth" required>
                    </div>

                    <!-- Gender -->
                    <div class="mb-3">
                        <label class="form-label d-block">Gender</label>
                        <div class="d-flex gap-4">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="gender" id="male" value="Male"
                                    required>
                                <label class="form-check-label" for="male">Male</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="gender" id="female" value="Female"
                                    required>
                                <label class="form-check-label" for="female">Female</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="gender" id="other" value="Other"
                                    required>
                                <label class="form-check-label" for="other">Other</label>
                            </div>
                        </div>
                    </div>

                    <!-- Address -->
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <textarea class="form-control rounded-3" name="address" id="address" rows="2"
                            placeholder="Your full address here..." required></textarea>
                    </div>

                    <!-- Password -->
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <div class="input-group">
                            <input type="password" class="form-control rounded-start-3" name="password" id="password"
                                placeholder="Create a strong password" required>
                            <button class="btn btn-outline-secondary rounded-end-3" type="button"
                                onclick="togglePassword('password', 'iconPassword')">
                                <i id="iconPassword" class="bi bi-eye"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Confirm Password -->
                    <div class="mb-3">
                        <label for="confirmPassword" class="form-label">Confirm Password</label>
                        <div class="input-group">
                            <input type="password" class="form-control rounded-start-3" name="cpassword" id="confirmPassword"
                                placeholder="Re-enter password" required>
                            <button class="btn btn-outline-secondary rounded-end-3" type="button"
                                onclick="togglePassword('confirmPassword', 'iconConfirmPassword')">
                                <i id="iconConfirmPassword" class="bi bi-eye"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Terms and Conditions -->
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="terms" required>
                        <label class="form-check-label" for="terms">
                            I agree to the <a href="#">Terms and Conditions</a>
                        </label>
                    </div>

                    <!-- Submit Button -->
                    <div class="d-flex gap-3 mt-4">
                        <button type="submit" class="btn btn-success btn-lg rounded-3 flex-fill">Sign Up</button>
                        <button type="reset" class="btn btn-secondary btn-lg rounded-3 flex-fill">Clear</button>
                    </div>


                    <!-- Login Link -->
                    <p class="text-center mt-4 small">
                        Already have an account?
                        <a href="#" data-bs-toggle="modal" data-bs-target="#loginModal" data-bs-dismiss="modal"
                            class="text-decoration-none">Login Here</a>
                    </p>

                </form>
            </div>

            <!-- Modal Footer -->
            <div class="modal-footer border-0 pt-0">
                <small class="text-muted">iForum © 2025. All rights reserved.</small>
            </div>

        </div>
    </div>
</div>

<!-- Password Toggle and Flatpickr Initialization
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
</script>-->

<script>
// Initialize Flatpickr on Date of Birth field
document.addEventListener("DOMContentLoaded", function() {
  flatpickr("#dob", {
    dateFormat: "Y-m-d",
    maxDate: new Date().fp_incr(-6570), // 6570 days = 18 years
    altInput: true,
    altFormat: "F j, Y",
    allowInput: true,
    defaultDate: "2000-01-01"
  });
});
</script>

<style>
  .modal-content {
    font-family: 'Raleway', sans-serif;
    }
</style>