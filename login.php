<?php
$title = 'Authentication';
require './assets/includes/header.php';

$fn->nonAuthpage();
?>

<style>
.input-field {
    position: relative;
    margin-bottom: 20px;
}

.input-field input {
    width: 100%;
    padding: 10px 40px 10px 10px; /* Adjust padding for icon space */
    border: 1px solid #ccc;
    border-radius: 5px;
    outline: none;
}

.input-field .toggle-password {
    position: absolute;
    right: 10px;
    top: 50%;
    transform: translateY(-50%);
    cursor: pointer;
}
</style>

<div>
  <nav class="navbar bg-body-tertiary shadow dsg">
    <div class="containerr">
      <a class="navbar-brand" href="index.php">
        <img src="./assets/images/logo.png" alt="Logo" height="24" class="logo">
        Resumify
      </a>
    </div>
  </nav>
  <div>

    <link rel="stylesheet" href="./assets/css/styles.css" />
    <title>Authentication</title>
    </head>

    <body>
      <div class="container" style="border-radius: 35px;">
        <div class="forms-container">
          <div class="signin-signup">
            <form method="post" action="actions/login.action.php" class="sign-in-form">
              <h2 class="title">Sign in</h2>
              <div class="input-field">
                <i class="fas fa-user"></i>
                <input type="email" name="email_id" id="floatingEmail" placeholder="name@example.com" required />
              </div>
              <div class="input-field password-field">
                <i class="fas fa-lock"></i>
                <input type="password" name="password" id="loginPassword" placeholder="Password" required />
                <i class="fas fa-eye toggle-password" id="toggleLoginPassword"></i>
              </div>
              <input type="submit" value="Login" class="btn solid" />
              <div class="d-flex justify-content-between my-3">
                <a href="forgot-password.php" class="text-decoration-none" style="color:#000;">Forgot Password?</a>
              </div>
            </form>
            <form method="post" action="actions/register.action.php" class="sign-up-form" id="registerForm">
              <h2 class="title">Sign up</h2>
              <div class="input-field">
                <i class="fas fa-user"></i>
                <input type="text" id="floatingName" name="full_name" placeholder="Your Name" required />
              </div>
              <div class="input-field">
                <i class="fas fa-envelope"></i>
                <input type="email" id="registerEmail" name="email_id" placeholder="name@example.com" required />
              </div>
              <div class="input-field password-field">
                <i class="fas fa-lock"></i>
                <input type="password" id="registerPassword" name="password" placeholder="Password" required />
                <i class="fas fa-eye toggle-password" id="toggleRegisterPassword"></i>
              </div>
              <div class="input-field password-field">
                <i class="fas fa-lock"></i>
                <input type="password" id="confirmPassword" name="confirm_password" placeholder="Confirm Password" required />
                <i class="fas fa-eye toggle-password" id="toggleConfirmPassword"></i>
              </div>
              <input type="submit" class="btn" value="Sign up" />
            </form>
          </div>
        </div>

        <div class="panels-container">
          <div class="panel left-panel">
            <div class="content">
              <h3>New here?</h3>
              <p>
                Welcome to our community! We’re excited to have you join us. If you’re ready to get started, simply
                click the button below to sign up and begin your journey with us.
              </p>
              <button class="btn transparent" id="sign-up-btn">
                Sign up
              </button>
            </div>
            <img src="img/log.svg" class="image" alt="" />
          </div>
          <div class="panel right-panel">
            <div class="content">
              <h3>One of us?</h3>
              <p>
                It’s great to see you again! Dive back into your account and pick up right where you left off. Just hit
                the button below to sign in and get started.
              </p>
              <button class="btn transparent" id="sign-in-btn">
                Sign in
              </button>
            </div>
            <img src="img/register.svg" class="image" alt="" />
          </div>
        </div>
      </div>

      <script src="./assets/js/script.js"></script>
      <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
      <script>
        document.addEventListener('DOMContentLoaded', function () {
            const togglePassword = (toggleId, inputId) => {
                const toggleElement = document.getElementById(toggleId);
                const inputElement = document.getElementById(inputId);
                
                toggleElement.addEventListener('click', function () {
                    const type = inputElement.getAttribute('type') === 'password' ? 'text' : 'password';
                    inputElement.setAttribute('type', type);
                    this.classList.toggle('fa-eye-slash');
                });
            };

            togglePassword('toggleLoginPassword', 'loginPassword');
            togglePassword('toggleRegisterPassword', 'registerPassword');
            togglePassword('toggleConfirmPassword', 'confirmPassword');

            const registerForm = document.getElementById('registerForm');
            registerForm.addEventListener('submit', function (event) {
                const password = document.getElementById('registerPassword').value;
                const confirmPassword = document.getElementById('confirmPassword').value;
                if (password !== confirmPassword) {
                    event.preventDefault();
                    Swal.fire({
                        icon: 'error',
                        title: 'Passwords do not match',
                        text: 'Please ensure the password and confirm password fields match.',
                    });
                }
            });
        });
      </script>

      <?php
      require "./assets/includes/footer.php";
      ?>
