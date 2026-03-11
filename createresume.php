<?php
$title = 'Create Profile';
require './assets/includes/header.php';
require './assets/includes/navbar.php';
$fn->authpage();
$user = $db->query("SELECT full_name,email_id FROM users WHERE usr_id='" . $fn->Auth()['usr_id'] . "'");
$user = $user->fetch_assoc();
?>
<style>
    #imageUploadStatus {
        font-size: 1rem;
    }

    #imageUploadStatus .text-success {
        color: green;
    }

    #imageUploadStatus .bi-check-circle {
        font-size: 1.2rem;
        margin-right: 0.5rem;
    }
</style>
<h1 class="lg-title mb-4 text-center mt-5"
    style="color: #007bff; font-family: 'Poppins', sans-serif; font-weight: 600;">
    Create Your Profile: Step into the Spotlight
</h1>
<div class="container">
    <div class="bg-white rounded shadow p-2 mt-4" style="min-height:80vh">
        <div class="d-flex justify-content-between border-bottom">
            <h5>Create Profile</h5>
            <div>
                <a class="text-decoration-none" onclick="history.back()"><i class="bi bi-arrow-left-circle"></i>
                    Back</a>
            </div>
        </div>

        <div>
            <form class="row g-3 p-3" action="actions/createresume.action.php" method="post"
                enctype="multipart/form-data">
                <!-- <div class="col-md-6">
                    <label class="form-label">Resume Title</label>
                    <input type="text" name="resume_title" placeholder="Title of resume" value="resume<?= time() ?>"
                        class="form-control" required>
                </div> -->

                <h5 class="mt-3 text-secondary"><i class="bi bi-person-badge"></i> Personal Information</h5>
                <div class="col-md-6">
                    <label class="form-label">Full Name</label>
                    <input type="text" name="full_name" placeholder="Your Name" value="<?= @$user['full_name'] ?>"
                        class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Email</label>
                    <input type="email" name="email_id" placeholder="xyz@abc.com" value="<?= @$user['email_id'] ?>"
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
                    <textarea class="form-control" id="obj4" name="objective" required></textarea>
                    <div class="d-flex justify-content-between mt-2">
                        <button type="button" class="btn btn-primary"
                            onclick="generateResponse('obj4',', for objective field.')">Improve</button>
                        <button type="button" class="btn btn-success"
                            onclick="realgenerateResponse('obj4',', for objective field.')">Generate</button>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Mobile No</label>
                    <input type="number" name="mobile_no" min="1111111111" placeholder="9569569569" max="9999999999"
                        class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Date Of Birth</label>
                    <input type="date" class="form-control" name="dob" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Gender</label>
                    <select class="form-select" name="gender" required>
                        <option>Male</option>
                        <option>Female</option>
                        <option>Transgender</option>
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Religion</label>
                    <select class="form-select" name="religion" required>
                        <option>Hindu</option>
                        <option>Muslim</option>
                        <option>Sikh</option>
                        <option>Christian</option>
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Nationality</label>
                    <select class="form-select" name="nationality" required>
                        <option>Indian</option>
                        <option>Non Indian</option>
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Marital Status</label>
                    <select class="form-select" name="marital_status">
                        <option>Married</option>
                        <option>Single</option>
                        <option>Divorced</option>
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Hobbies</label>
                    <input type="text" name="hobbies" placeholder="Reading Books, Watching Movies" class="form-control"
                        required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Languages Known</label>
                    <input type="text" placeholder="Languages" name="languages" class="form-control" required>
                </div>

                <div class="col-md-6">
                    <label for="inputAddress" class="form-label">Profession</label>
                    <input type="text" class="form-control" id="inputAddress" name="profession"
                        placeholder="Ex. Computer Scientist" required>
                </div>
                <div class="col-md-6">
                    <label for="inputAddress" class="form-label">LinkedIn Profile Link</label>
                    <input type="text" class="form-control" id="inputAddress" name="linkedin"
                        placeholder="Ex. https://www.linkedin.com/ex/" required>
                </div>

                <div class="col-12">
                    <label for="inputAddress" class="form-label"> Address</label>
                    <textarea class="form-control" id="inputAddress" name="address" placeholder="Your address"
                        required></textarea>
                </div>

                <div class="col-md-6">
                    <label for="inputAddress" class="form-label"> Country Code</label>
                    <input type="number" class="form-control" id="inputAddress" name="country_code"
                        placeholder="Country Code" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Web Site</label>
                    <input type="text" name="web_url" placeholder="Your Website URL" class="form-control">
                </div>
                <div class="col-12">
                    <label class="form-label">About Me</label>
                    <textarea class="form-control" name="about_me" id="abt4" placeholder="About You...."
                        required></textarea>
                    <div class="d-flex justify-content-between mt-2">
                        <button type="button" class="btn btn-primary"
                            onclick="generateResponse('abt4',', for about me field,')">Improve</button>
                        <button type="button" class="btn btn-success"
                            onclick="realgenerateResponse('abt4',', for about me field,')">Generate</button>
                    </div>
                </div>

                <div class="col-12 text-end">
                    <button type="submit" class="btn btn-primary"><i class="bi bi-floppy"></i> Create Profile</button>
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

<div class="profile-tips-container my-5">
    <h1 class="lg-title mb-4 text-center" style="color: #007bff; font-family: 'Poppins', sans-serif; font-weight: 600;">
        Craft Your Perfect Profile
    </h1>
    <p class="text-muted mb-4 text-center">Welcome to <b>Resumify!</b> <br>Our platform is here to help you build a
        standout profile. <br> Here are some tips to ensure your profile shines:</p>
    <ul class="list-unstyled text-muted mx-auto" style="max-width: 600px;">
        <li class="mb-3 px-3 px-sm-4 px-md-5">
            <strong class="d-block">Highlight Key Achievements:</strong> Focus on showcasing your most significant
            accomplishments and experiences that set you apart.
        </li>
        <li class="mb-3 px-3 px-sm-4 px-md-5">
            <strong class="d-block">Use a Professional Photo:</strong> Choose a clear and professional photo that
            reflects your image in the best light.
        </li>
        <li class="mb-3 px-3 px-sm-4 px-md-5">
            <strong class="d-block">Update Your Skills:</strong> Ensure your skills section reflects your current
            capabilities and any recent advancements in your field.
        </li>
        <li class="mb-3 px-3 px-sm-4 px-md-5">
            <strong class="d-block">Include Relevant Keywords:</strong> Use industry-specific keywords to make your
            profile more searchable and relevant to potential opportunities.
        </li>
        <li class="mb-3 px-3 px-sm-4 px-md-5">
            <strong class="d-block">Keep It Current:</strong> Regularly update your profile to reflect any new
            experiences, skills, or accomplishments.
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

<?php
require './assets/includes/footer.php';
?>