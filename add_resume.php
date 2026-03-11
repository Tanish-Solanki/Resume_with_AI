<?php
$title = 'Create Resume';
require './assets/includes/header.php';
require './assets/includes/navbar.php';

$fn->authpage();
$resumes = $db->query("SELECT * FROM profiles WHERE (user_id =" . $fn->Auth()['usr_id'] . " AND status = 0)");
$resume = $resumes->fetch_assoc();
if (!$resume) {
    $fn->setMessage('Redirected to Create a Profile...!!!');
    $fn->redirect('createresume.php');
}
?>

<h1 class="lg-title mb-4 text-center mt-5"
    style="color: #007bff; font-family: 'Poppins', sans-serif; font-weight: 600;">
    Design Your Ideal Resume with Confidence
</h1>


<div class="container">

    <div class="bg-white rounded shadow p-2 mt-4" style="min-height:80vh">
        <div class="d-flex justify-content-between border-bottom">
            <h5>Add Resume</h5>
            <div>
                <a class="text-decoration-none" href="myresumes.php"><i class="bi bi-arrow-left-circle"></i>
                    Back</a>
            </div>
        </div>

        <div>

            <form class="row g-3 p-3" action="actions/addresume.action.php" method="post">
                <div class="col-md-6">
                    <label class="form-label">Resume Title</label>
                    <input type="text" name="resume_title" placeholder="Title of resume" value="resume<?= time() ?>"
                        class="form-control" required>
                </div>
                <h5 class="mt-3 text-secondary"><i class="bi bi-person-badge"></i> Personal Information</h5>
                <div class="col-md-6">
                    <label class="form-label">Full Name</label>
                    <input type="text" name="full_name" placeholder="Your Name" value="<?= $resume['full_name'] ?>"
                        class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Email</label>
                    <input type="email" name="email_id" placeholder="xyz@abc.com" value="<?= $resume['email_id'] ?>"
                        class="form-control" required>
                </div>
                <div class="col-12 position-relative">
                    <label for="inputAddress" class="form-label">Objective</label>
                    <textarea class="form-control" name="objective" id="obj1"
                        required><?= @$resume['objective'] ?></textarea>
                    <div class="d-flex justify-content-between mt-2">
                        <button type="button" class="btn btn-primary"
                            onclick="generateResponse('obj1',', for objective field.')">Improve</button>
                        <button type="button" class="btn btn-success"
                            onclick="realgenerateResponse('obj1',', for objective field,')">Generate</button>
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Mobile No</label>
                    <input type="number" name="mobile_no" min="1111111111" placeholder="9569569569"
                        value="<?= $resume['mobile_no'] ?>" max="9999999999" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Date Of Birth</label>
                    <input type="date" class="form-control" name="dob" value="<?= $resume['dob'] ?>" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Gender</label>
                    <select class="form-select" name="gender" required>
                        <option <?= ($resume['gender'] == 'Male') ? 'selected' : '' ?>>Male</option>
                        <option <?= ($resume['gender'] == 'Female') ? 'selected' : '' ?>>Female</option>
                        <option <?= ($resume['gender'] == 'Transgender') ? 'selected' : '' ?>>Transgender</option>


                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Religion</label>
                    <select class="form-select" name="religion" required>
                        <option <?= ($resume['religion'] == 'Hindu') ? 'selected' : '' ?>>Hindu</option>
                        <option <?= ($resume['religion'] == 'Muslim') ? 'selected' : '' ?>>Muslim</option>
                        <option <?= ($resume['religion'] == 'Sikh') ? 'selected' : '' ?>>Sikh</option>
                        <option <?= ($resume['religion'] == 'Christian') ? 'selected' : '' ?>>Christian</option>



                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Nationality</label>
                    <select class="form-select" name="nationality" required>
                        <option <?= ($resume['nationality'] == 'Indian') ? 'selected' : '' ?>>Indian</option>
                        <option <?= ($resume['nationality'] == 'Non Indian') ? 'selected' : '' ?>>Non Indian</option>


                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Marital Status</label>
                    <select class="form-select" name="marital_status">
                        <option <?= ($resume['marital_status'] == 'Married') ? 'selected' : '' ?>>Married</option>
                        <option <?= ($resume['marital_status'] == 'Single') ? 'selected' : '' ?>>Single</option>
                        <option <?= ($resume['marital_status'] == 'Divorced') ? 'selected' : '' ?>>Divorced</option>


                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Hobbies</label>
                    <input type="text" name="hobbies" value="<?= $resume['hobbies'] ?>"
                        placeholder="Reading Books, Watching Movies" class="form-control" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Languages Known</label>
                    <input type="text" placeholder="Languages" name="languages" value="<?= $resume['languages'] ?>"
                        class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label for="inputAddress" class="form-label">Profession</label>
                    <input type="text" class="form-control" id="inputAddress" name="profession"
                        value="<?= @$resume['profession'] ?>" placeholder="Ex. Computer Scientist" required>
                </div>
                <div class="col-md-6">
                    <label for="inputAddress" class="form-label">LinkedIn Profile Link</label>
                    <input type="text" class="form-control" id="inputAddress" name="linkedin"
                        value="<?= @$resume['linkedin'] ?>" placeholder="Ex. https://www.linkedin.com/ex/" required>
                </div>

                <div class="col-12">
                    <label for="inputAddress" class="form-label"> Address</label>
                    <input type="text" class="form-control" id="inputAddress" name="address"
                        value="<?= $resume['address'] ?>" placeholder="Your address" required>
                </div>

                <div class="col-md-6">
                    <label for="inputAddress" class="form-label"> Country code</label>
                    <input type="text" class="form-control" id="countrycode" name="country_code"
                        value="<?= $resume['country_code'] ?>" placeholder="Your countryCode" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Web Site</label>
                    <input type="text" name="web_url" placeholder="Your Website URL" value="<?= $resume['web_url'] ?>"
                        class="form-control">
                </div>
                <div class="col-12">
                    <label class="form-label">About Me</label>
                    <textarea class="form-control" name="about_me" placeholder="About You...." id="abt1"
                        required><?= @$resume['about_me'] ?></textarea>
                    <div class="d-flex justify-content-between mt-2">
                        <button type="button" class="btn btn-primary"
                            onclick="generateResponse('abt1',', for about me field.')">Improve</button>
                        <button type="button" class="btn btn-success"
                            onclick="realgenerateResponse('abt1',', for about me field,')">Generate</button>
                    </div>
                </div>


                <div class="col-12 text-end">
                    <button type="submit" class="btn btn-primary"><i class="bi bi-floppy"></i> Add
                        Resume</button>
                </div>
            </form>
            <div class="container mt-4">
                <div class="alert alert-warning text-center">
                    <strong>Note:</strong> AI can make mistakes. Please verify important information independently.
                </div>
            </div>
        </div>

    </div>

    <div class="resume-tips-container my-5">
        <h1 class="lg-title mb-4 text-center"
            style="color: #007bff; font-family: 'Poppins', sans-serif; font-weight: 600;">
            Craft Your Perfect Resume
        </h1>
        <p class="text-muted mb-4 text-center">Welcome to <b>Resumify!</b> <br>Our platform is designed to help you
            create and manage your resumes with ease.<br> Here are a few tips to make your resume stand out:</p>
        <ul class="list-unstyled text-muted mx-auto" style="max-width: 600px;">
            <li class="mb-3 px-3 px-sm-4 px-md-5">
                <strong class="d-block">Tailor Your Resume:</strong> Customize your resume for each job application to
                highlight the most relevant skills and experiences.
            </li>
            <li class="mb-3 px-3 px-sm-4 px-md-5">
                <strong class="d-block">Keep It Concise:</strong> Aim for a resume length of one to two pages to ensure
                it's easily readable.
            </li>
            <li class="mb-3 px-3 px-sm-4 px-md-5">
                <strong class="d-block">Use Action Verbs:</strong> Start bullet points with strong action verbs to
                convey your achievements more effectively.
            </li>
            <li class="mb-3 px-3 px-sm-4 px-md-5">
                <strong class="d-block">Quantify Achievements:</strong> Include numbers and metrics to demonstrate the
                impact of your contributions.
            </li>
            <li class="mb-3 px-3 px-sm-4 px-md-5">
                <strong class="d-block">Proofread Carefully:</strong> Ensure your resume is free of spelling and
                grammatical errors to present a professional image.
            </li>
        </ul>
    </div>


</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>



<?php
require './assets/includes/footer.php';
?>