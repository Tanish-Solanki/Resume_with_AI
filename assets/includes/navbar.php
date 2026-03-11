<?php
// Include necessary files
require_once './assets/class/database.class.php';
require_once './assets/class/function.class.php';

$fn->authpage();
$authid = $fn->Auth()['usr_id'];
$profileExists = false;

// Check if the user already has a profile
$results = $db->query("SELECT * FROM profiles WHERE user_id = $authid AND status = 0");
$res = $results->fetch_all(MYSQLI_ASSOC);
$query = $db->query("SELECT * FROM profiles WHERE user_id = $authid AND status = 0");
$result = $query->fetch_assoc();


// Ensure $result is not empty
// if (empty($result)) {
//     $fn->redirect('createresume.php');
// }
if($result){
// Assuming there is only one profile per user, get the profile image path
$profile_image_path = str_replace("../", "./", $result['profile_image']);
}
// Fetch user details
$stmt = $db->prepare("SELECT full_name, email_id FROM users WHERE usr_id = ?");
$stmt->bind_param('i', $authid);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();

// Filter active profiles (though it seems redundant since the initial query already filters by status = 0)
$active_profiles = array_filter($res, function($res) {
    return $res['status'] == 0;
});
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
<!-- Bootstrap Icons -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.3/font/bootstrap-icons.min.css" rel="stylesheet">

<nav class="navbar bg-body-tertiary shadow">
    <div class="container">
        <a class="navbar-brand" href="index.php">
            <img src="./assets/images/logo.png" alt="Logo" height="24" class="d-inline-block align-text-top">
            Resumify
        </a>
        <div>
            <div class="btn-group">
                <button class="btn btn-light btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                
                <?php
                if($user){ 
                echo $user['full_name'];
                }else{
                    echo "user";
                }
                ?>
                </button>
                <ul class="dropdown-menu dropdown-menu-light">
                    <li><a class="dropdown-item" data-bs-toggle="offcanvas" data-bs-target="#profileOffcanvas" aria-controls="profileOffcanvas"><i class="bi bi-person"></i> View Profile</a></li>
                    <li><a class="dropdown-item" href="<?php echo $active_profiles ? 'updateprofile.php' : 'createresume.php'; ?>"><i class="bi bi-file-earmark-plus"></i> <?php echo $active_profiles ? 'Update Profile' : 'Create Profile'; ?></a></li>
                    <li><a class="dropdown-item" data-bs-toggle="offcanvas" data-bs-target="#offcanvasProfile" aria-controls="offcanvasProfile"><i class="bi bi-person-circle"></i> Update Account</a></li>
                    <li><a class="dropdown-item" href="index.php#contact"><i class="bi bi-person-lines-fill"></i> Contact Us</a></li>
                    <li><a class="dropdown-item" href="index.php#feedback"><i class="bi bi-cup-hot"></i> Give Feedback</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a href="actions/logout.action.php" class="dropdown-item"><i class="bi bi-box-arrow-left"></i> Log Out</a></li>
                </ul>
            </div>
            <a data-bs-toggle="offcanvas" data-bs-target="#profileOffcanvas" aria-controls="profileOffcanvas" class="btn btn-sm btn-dark">
                <i class="bi bi-person-circle"></i> Account
            </a>        
        </div>
    </div>
</nav>

<!-- Offcanvas component -->
<div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="offcanvasProfile" aria-labelledby="offcanvasProfileLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasProfileLabel">Update Account</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <form class="row g-3" action="actions/updateprofile.action.php" method="post">
            <div class="col-md-6">
                <label for="full_name" class="form-label">Full Name</label>
                <input id="full_name" type="text" name="full_name" value="<?= htmlspecialchars($user['full_name'], ENT_QUOTES, 'UTF-8') ?>" placeholder="Account Name" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label for="email_id" class="form-label">Email</label>
                <input id="email_id" type="email" name="email_id" value="<?= htmlspecialchars($user['email_id'], ENT_QUOTES, 'UTF-8') ?>" placeholder="xyz@abc.com" class="form-control" required>
            </div>
            <div class="col-12">
                <label for="old_password" class="form-label">Old Password</label>
                <input id="old_password" type="password" name="old_password" class="form-control" required>
            </div>
            <div class="col-12">
                <label for="password" class="form-label">New Password</label>
                <input id="password" type="password" name="password" class="form-control">
            </div>
            <div class="col-12 text-end">
                <button type="submit" class="btn btn-dark"><i class="bi bi-floppy"></i> Update Account</button>
            </div>
        </form>
    </div>
</div>

<div class="offcanvas offcanvas-end" tabindex="-1" id="profileOffcanvas" aria-labelledby="profileOffcanvasLabel">
<?php
if($result){
    ?>
<div class="offcanvas-header">
        <h5 class="offcanvas-title" id="profileOffcanvasLabel">Profile Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div class="text-center mb-4">
            <img src="<?=$profile_image_path ?>" class="img-thumbnail" alt="Profile Image" style="width: 200px; height: 200px;">
        </div>
        <h4 class="mb-3"><?= $result['full_name'] ?></h4>
        <p><strong>Email:</strong> <?= $result['email_id'] ?></p>
        <p><strong>Objective:</strong> <?= $result['objective'] ?></p>
        <p><strong>Mobile No:</strong> <?= $result['mobile_no'] ?></p>
        <p><strong>Date of Birth:</strong> <?= $result['dob'] ?></p>
        <p><strong>Gender:</strong> <?= $result['gender'] ?></p>
        <p><strong>Religion:</strong> <?= $result['religion'] ?></p>
        <p><strong>Nationality:</strong> <?= $result['nationality'] ?></p>
        <p><strong>Marital Status:</strong> <?= $result['marital_status'] ?></p>
        <p><strong>Hobbies:</strong> <?= $result['hobbies'] ?></p>
        <p><strong>Languages Known:</strong> <?= $result['languages'] ?></p>
        <p><strong>Profession:</strong> <?= $result['profession'] ?></p>
        <p><strong>LinkedIn:</strong> <a href="<?= $result['linkedin'] ?>" target="_blank"><?= $result['linkedin'] ?></a></p>
        <p><strong>Address:</strong> <?= $result['address'] ?></p>
        <p><strong>Country Code:</strong> <?= $result['country_code'] ?></p>
        <p><strong>Website:</strong> <a href="<?= $result['web_url'] ?>" target="_blank"><?= $result['web_url'] ?></a></p>
        <p><strong>About Me:</strong> <?= $result['about_me'] ?></p>
        <div class="text-center mt-4">
            <!-- Edit Profile Button -->
            <a href="updateprofile.php" class="btn btn-warning">Edit Profile</a>
        </div>
    </div>

<?php
}else{
    ?>
    <div class="offcanvas-header">
        You Have To Create Profile First !! <br> Click Below Button To Create Profile !!!
    </div>
    <div class="offcanvas-body">
            <a href="createresume.php" class="btn btn-warning">Create Profile</a>
    </div>
    <?php
}
?>
</div>
<!-- Add your scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
