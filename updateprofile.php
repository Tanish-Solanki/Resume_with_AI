<?php
$title = 'Update Profile';
require './assets/includes/header.php';
require './assets/includes/navbar.php';
$fn->authpage();
$slug = $_GET['resume'] ?? '';
$resumes = $db->query("SELECT * FROM profiles WHERE (user_id =" . $fn->Auth()['usr_id'] . " AND status = 0 )");
$resume = $resumes->fetch_assoc();
if (!$resume) {
    $fn->redirect('myresumes.php');
}

?>

<h1 class="lg-title mb-4 text-center mt-5"
    style="color: #007bff; font-family: 'Poppins', sans-serif; font-weight: 600;">
    Update Your Profile: Shine Your Best Self
</h1>

<div class="container">

    <div class="bg-white rounded shadow p-2 mt-4" style="min-height:80vh">
        <div class="d-flex justify-content-between border-bottom">
            <h5>Update Profile</h5>
            <div>
                <a href="myresumes.php" class="text-decoration-none"><i class="bi bi-arrow-left-circle"></i> Back</a>
            </div>
        </div>

        <div>

            <form class="row g-3 p-3" action="actions/updtprof.action.php" method="post">
                <input type="hidden" name="prf_id" value="<?= $resume['prf_id'] ?>" />
                <input type="hidden" name="slug" value="<?= $resume['slug'] ?>" />

                <h5 class="mt-3 text-secondary"><i class="bi bi-person-badge"></i> Personal Information</h5>
                <div class="col-md-6">
                    <label class="form-label">Full Name</label>
                    <input type="text" name="full_name" placeholder="Your Name" value="<?= @$resume['full_name'] ?>"
                        class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Email</label>
                    <input type="email" name="email_id" placeholder="xyz@abc.com" value="<?= @$resume['email_id'] ?>"
                        class="form-control" required>
                </div>
                <div class="col-md-12">
                    <label class="form-label">Profile Image</label>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#imageModal">Upload Image</button>
                    <div id="imageUploadStatus" class="mt-2"></div> <!-- Status display element -->
                </div>
                <div class="col-12">
                    <label for="inputAddress" class="form-label"> Objective</label>
                    <textarea class="form-control" name="objective" id="obj3"
                        required><?= @$resume['objective'] ?></textarea>
                    <div class="d-flex justify-content-between mt-2">
                        <button type="button" class="btn btn-primary"
                            onclick="generateResponse('obj3',', for objective field.')">Improve</button>
                        <button type="button" class="btn btn-success"
                            onclick="realgenerateResponse('obj3',', for objective field.')">Generate</button>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Mobile No</label>
                    <input type="number" name="mobile_no" min="1111111111" value="<?= @$resume['mobile_no'] ?>"
                        placeholder="9569569569" max="9999999999" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Date Of Birth</label>
                    <input type="date" class="form-control" name="dob" value="<?= $resume['dob']; ?>" required>
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
                    <input type="text" name="hobbies" value="<?= @$resume['hobbies'] ?>"
                        placeholder="Reading Books, Watching Movies" class="form-control" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Languages Known</label>
                    <input type="text" placeholder="Languages" value="<?= @$resume['languages'] ?>" name="languages"
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
                    <input type="text" class="form-control" id="inputAddress" value="<?= @$resume['address'] ?>"
                        name="address" placeholder="Your address" required>
                </div>

                <div class="col-md-6">
                    <label for="inputAddress" class="form-label"> Country Code</label>
                    <input type="text" class="form-control" id="countrycode" value="<?= @$resume['country_code'] ?>"
                        name="country_code" placeholder="Your CountryCode" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Web Site</label>
                    <input type="text" name="web_url" placeholder="Your Website URL" value="<?= $resume['web_url'] ?>"
                        class="form-control">
                </div>
                <div class="col-12">
                    <label class="form-label">About Me</label>
                    <textarea class="form-control" name="about_me" id="abt3" placeholder="About You...."
                        required><?= @$resume['about_me'] ?></textarea>
                    <div class="d-flex justify-content-between mt-2">
                        <button type="button" class="btn btn-primary"
                            onclick="generateResponse('abt3',', for about me field.')">Improve</button>
                        <button type="button" class="btn btn-success"
                            onclick="realgenerateResponse('abt3',', for about me field.')">Generate</button>
                    </div>
                </div>
                <hr>

                <div class="col-12 text-end">
                    <button type="submit" class="btn btn-primary"><i class="bi bi-floppy"></i> Add Profile
                    </button>

                    <!-- <a href="actions/deleteprofile.action.php?prf_id=<?= @$resume['prf_id'] ?>&slug=<?= @$resume['slug'] ?>" class="btn btn-danger"><i class="bi bi-floppy"></i> Remove Profile
                            </a> -->
                    <a href="#"
                        onclick="confirmDelete(event, 'actions/deleteprofile.action.php?prf_id=<?= @$resume['prf_id'] ?>&slug=<?= @$resume['slug'] ?>')"
                        class="btn btn-danger"><i class="bi bi-trash2"></i> Remove Profile</a>
                </div>
            </form>
            <div class="container mt-4">
                <div class="alert alert-warning text-center">
                    <strong>Note:</strong> AI can make mistakes. Please verify important information independently.
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Image Upload Modal -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imageModalLabel">Upload Image</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="imageUploadForm" action="actions/imageupload.action.php" method="post"
                    enctype="multipart/form-data">
                    <div class="mb-3">
                        <input type="file" name="profile_image" id="uploadImage" accept="image/*" class="form-control">
                    </div>
                    <div id="imagePreview"
                        style="width: 100%; height: 400px; background: #f0f0f0; text-align: center; line-height: 400px;">
                        <span>Upload an image to preview</span>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="cropAndUpload">Crop and Upload</button>
            </div>
        </div>
    </div>
</div>


<div class="resume-tips-container my-5">
    <h1 class="lg-title mb-4 text-center" style="color: #dc3545; font-family: 'Poppins', sans-serif; font-weight: 600;">
        Avoid These Resume Mistakes
    </h1>
    <p class="text-muted mb-4 text-center">Welcome to <b>Resumify!</b> <br>Our platform is here to guide you in creating
        a standout resume. <br> Here are some things to avoid including in your resume:</p>
    <ul class="list-unstyled text-muted mx-auto" style="max-width: 600px;">
        <li class="mb-3 px-3 px-sm-4 px-md-5">
            <strong class="d-block">Irrelevant Personal Information:</strong> Avoid including personal details such as
            age, marital status, or religion that are not pertinent to the job.
        </li>
        <li class="mb-3 px-3 px-sm-4 px-md-5">
            <strong class="d-block">Excessive Length:</strong> Don’t overload your resume with unnecessary information.
            Keep it focused and relevant, ideally to one or two pages.
        </li>
        <li class="mb-3 px-3 px-sm-4 px-md-5">
            <strong class="d-block">Unrelated Job Experiences:</strong> Exclude work experiences that don’t relate to
            the position you’re applying for. Focus on relevant skills and achievements.
        </li>
        <li class="mb-3 px-3 px-sm-4 px-md-5">
            <strong class="d-block">Unprofessional Email Address:</strong> Use a professional email address rather than
            a casual or outdated one.
        </li>
        <li class="mb-3 px-3 px-sm-4 px-md-5">
            <strong class="d-block">Exaggerated Claims:</strong> Avoid making exaggerated claims about your achievements
            or skills. Be honest and accurate to maintain credibility.
        </li>
    </ul>
</div>


<!-- Add your scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function () {
        let cropper;

        const uploadImage = $('#uploadImage');
        const imagePreview = $('#imagePreview');
        const imageModal = new bootstrap.Modal($('#imageModal')[0]);

        // Initialize Cropper.js when an image is selected
        uploadImage.on('change', function (event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const img = $('<img>', {
                        src: e.target.result,
                        style: 'width: 100%; height: 400px;',
                        id: 'imageToCrop'
                    });
                    imagePreview.empty().append(img);

                    cropper = new Cropper(img[0], {
                        aspectRatio: 1,
                        viewMode: 1,
                        cropBoxResizable: true,
                        ready: function () {
                            console.log('Cropper is ready.');
                        }
                    });
                };
                reader.readAsDataURL(file);
            }
        });

        // Handle cropping and uploading the image
        $('#cropAndUpload').on('click', function () {
            if (!cropper) {
                console.error('Cropper instance is not initialized.');
                return;
            }

            const canvas = cropper.getCroppedCanvas({
                width: 200,
                height: 200,
                imageSmoothingEnabled: false,
                imageSmoothingQuality: 'high'
            });

            canvas.toBlob(function (blob) {
                const formData = new FormData();
                formData.append('profile_image', blob, 'profile.jpg');

                $.ajax({
                    url: 'actions/imageupload.action.php',
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        const data = JSON.parse(response);

                        console.log('Upload response:', data);

                        if (data.success) {
                            Swal.fire({
                                title: "Success",
                                text: "Image Uploaded Successfully!",
                                icon: "success"
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    // Update the status display with a green checkmark and file name
                                    $('#imageUploadStatus').html(`<span class="text-success"><i class="bi bi-check-circle"></i> ${data.image_name}</span>`);
                                    console.log('Status updated with image name:', data.image_name);

                                    // Add hidden input field to the main form with the image path
                                    const mainForm = $('form[action="actions/createresume.action.php"]');
                                    if (mainForm.length) {
                                        mainForm.append(`<input type="hidden" name="profile_image" value="${data.image_path}">`);
                                        console.log('Hidden input added with image path:', data.image_path);
                                    }

                                    // Close the Bootstrap modal
                                    // imageModal.hide();
                                }
                            });
                        } else {
                            Swal.fire({
                                title: "Error",
                                text: 'Image upload failed: ' + data.message,
                                icon: "error"
                            });
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error('Error:', error);
                    }
                });
            }, 'image/jpeg');
        });
    });

</script>

<script>
    function confirmDelete(event, url) {
        event.preventDefault();
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url;
            }
        });
    }
</script>

<?php
require './assets/includes/footer.php';
?>