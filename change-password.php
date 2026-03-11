<?php 
$title='Change Password';
require './assets/includes/header.php';
$fn->nonAuthpage();
?>

    <style>
        .form-signin {
            max-width: 600px;
            padding: 1rem;
        }
    </style>

<nav class="navbar bg-body-tertiary shadow">
        <div class="container">
            <a class="navbar-brand" href="index.php" style="color:#000;">
                <img src="./assets/images/logo.png" alt="Logo" height="24" class="d-inline-block align-text-top">
                Resumify
            </a>
            <div>
                <a onclick="history.back()" class="btn btn-sm btn-dark"><i class="bi bi-arrow-bar-left"></i> 
                Back  
                </a>
            </div>
        </div>
    </nav>

<div class="d-flex align-items-center p-3 log-reg">

    <div class="w-100">
        <main class="form-signin w-100 m-auto bg-white shadow rounded">
            <form action="actions/changepassword.action.php" method="post">
                <div class="d-flex gap-2 justify-content-center">
                    <img class="mb-4" src="./assets/live_assets/images/logo3.png" alt="" height="70">

                    <div>
                        <h1 class="h3 fw-normal my-1"><b>Resumify</b></h1>
                        <p class="m-0">Change Password</p>

                    </div>
                </div>


                <div class="mb-3">
                    <span class="mb-3 fw-bold"><?=$fn->getSession('email')==''?$fn->redirect('forgot-password.php'):$fn->getSession('email');?></span>
                </div>
                <div class="form-floating mb-4">
                    <input type="text" class="form-control" name="password" id="floatingEmail" placeholder="name@example.com" required>
                    <label for="floatingInput"><i class="bi bi-key"></i> Enter new password</label>
                </div>



                <button class="btn btn-primary w-100 py-2" type="submit"> Change Password

                </button>
                <div class="d-flex justify-content-between my-3">

                    
                    <a href="login.php" class="text-decoration-none">Login</a>

                </div>

            </form>
        </main>

    </div>

</div>

<?php 
require './assets/includes/footer.php';
?>