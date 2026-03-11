<?php
$title = 'Update Resume';
require './assets/includes/header.php';
require './assets/includes/navbar.php';
$fn->authpage();
$slug = $_GET['resume'] ?? '';
$resumes = $db->query("SELECT * FROM resumes WHERE (slug='$slug' AND user_id =" . $fn->Auth()['usr_id'] . ")");
$resume = $resumes->fetch_assoc();
if (!$resume) {
  $fn->redirect('myresumes.php');
}

$exps = $db->query("SELECT * FROM experiences WHERE (resume_id=" . $resume['id'] . ")");
$exps = $exps->fetch_all(1);

$edus = $db->query("SELECT * FROM education WHERE (resume_id=" . $resume['id'] . ")");
$edus = $edus->fetch_all(1);

$skills = $db->query("SELECT * FROM skills WHERE (resume_id=" . $resume['id'] . ")");
$skills = $skills->fetch_all(1);

$ache = $db->query("SELECT * FROM achivements WHERE (resume_id=" . $resume['id'] . ")");
$ache = $ache->fetch_all(1);

$proj = $db->query("SELECT * FROM projects WHERE (resume_id=" . $resume['id'] . ")");
$proj = $proj->fetch_all(1);

?>

<h1 class="lg-title mb-4 text-center mt-5"
  style="color: #007bff; font-family: 'Poppins', sans-serif; font-weight: 700;">
  Revamp Your Resume: Step Into Your Dream Job!
</h1>


<div class="container">

  <div class="bg-white rounded shadow p-2 mt-4" style="min-height:80vh">
    <div class="d-flex justify-content-between border-bottom">
      <h5>Update Resume</h5>
      <div>
        <a href="myresumes.php" class="text-decoration-none"><i class="bi bi-arrow-left-circle"></i> Back</a>
      </div>
    </div>

    <div>

      <form class="row g-3 p-3" action="actions/updateresume.action.php" method="post">
        <input type="hidden" name="id" value="<?= $resume['id'] ?>" />
        <input type="hidden" name="slug" value="<?= $resume['slug'] ?>" />

        <div class="col-md-6">
          <label class="form-label">Resume Title</label>
          <input type="text" name="resume_title" placeholder="Title of resume" value="<?= @$resume['resume_title'] ?>"
            class="form-control" required>
        </div>
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
        <div class="col-12">
          <label for="inputAddress" class="form-label"> Objective</label>
          <textarea class="form-control" name="objective" id="obj2" required><?= @$resume['objective'] ?></textarea>
          <div class="d-flex justify-content-between mt-2">
            <button type="button" class="btn btn-primary"
              onclick="generateResponse('obj2',', for objective field.')">Improve</button>
            <button type="button" class="btn btn-success"
              onclick="realgenerateResponse('obj2',', for objective field.')">Generate</button>
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
          <input type="text" class="form-control" id="inputAddress" name="linkedin" value="<?= @$resume['linkedin'] ?>"
            placeholder="Ex. https://www.linkedin.com/ex/" required>
        </div>

        <div class="col-12">
          <label for="inputAddress" class="form-label"> Address</label>
          <input type="text" class="form-control" id="inputAddress" value="<?= @$resume['address'] ?>" name="address"
            placeholder="Your address" required>
        </div>

        <div class="col-md-6">
          <label for="inputcode" class="form-label"> CountryCode</label>
          <input type="number" class="form-control" id="countrycode" value="<?= @$resume['country_code'] ?>"
            name="country_code" placeholder="Your CountryCode" required>
        </div>
        <div class="col-md-6">
          <label class="form-label">Web Site</label>
          <input type="text" name="web_url" placeholder="Your Website URL" value="<?= @$resume['web_url'] ?>"
            class="form-control">
        </div>
        <div class="col-12">
          <label class="form-label">About Me</label>
          <textarea class="form-control" name="about_me" id="abt2" placeholder="About You...."
            required><?= @$resume['about_me'] ?></textarea>
          <div class="d-flex justify-content-between mt-2">
            <button type="button" class="btn btn-primary"
              onclick="generateResponse('abt2',', for about me field.')">Improve</button>
            <button type="button" class="btn btn-success"
              onclick="realgenerateResponse('abt2',', for about me field.')">Generate</button>
          </div>
        </div>



        <hr>
        <div class="d-flex justify-content-between" id="experience">
          <h5 class="text-secondary"><i class="bi bi-briefcase"></i> Experience</h5>
          <div>
            <a class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#addxp"><i
                class="bi bi-file-earmark-plus"></i> Add New</a>
          </div>
        </div>
        <!-- Modal  -->
        <!-- Model Completed -->
        <div class="d-flex flex-wrap">
          <?php
          if ($exps) {
            foreach ($exps as $exp) {
              ?>
              <div class="col-12 col-md-6 p-2">
                <div class="p-2 border rounded">
                  <div class="d-flex justify-content-between">
                    <h6><?= $exp['position'] ?></h6>
                    <a href="#"
                      onclick="confirmDelete('exp', <?= $exp['exp_id'] ?>, <?= $resume['id'] ?>, '<?= $resume['slug'] ?>'); return false;">
                      <i class="bi bi-x-lg"></i>
                    </a>
                  </div>
                  <p class="small text-secondary m-0" style="font-size:12px">
                    <i class="bi bi-clock-history"></i> Added On : <?= date('d F, Y h:i A', $exp['created_at']) ?>
                  </p>
                  <p class="small text-secondary m-0">
                    <i class="bi bi-buildings"></i> <?= $exp['company'] ?> (<?= $exp['started'] . '-' . $exp['ended'] ?>)
                  </p>
                  <p class="small text-secondary m-0">
                    <?= $exp['job_desc'] ?>
                  </p>
                </div>
              </div>
              <?php
            }
          } else {
            ?>
            <div class="col-12 col-md-6 p-2">
              <div class="p-2 border rounded">
                <div class="d-flex justify-content-between">
                  <h6>I'm fresher</h6>
                </div>
                <p class="small text-secondary m-0">
                  If you have experience, you can add it !!
                </p>
              </div>
            </div>
            <?php
          }
          ?>
        </div>

        <hr>
        <div class="d-flex justify-content-between" id="education">
          <h5 class="text-secondary"><i class="bi bi-journal-bookmark"></i> Education</h5>
          <div>
            <a class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#addedu"><i
                class="bi bi-file-earmark-plus"></i> Add New</a>
          </div>
        </div>
        <div class="d-flex flex-wrap">
          <?php
          if ($edus) {
            foreach ($edus as $edu) {
              ?>
              <div class="col-12 col-md-6 p-2">
                <div class="p-2 border rounded">
                  <div class="d-flex justify-content-between">
                    <h6><?= $edu['course'] ?></h6>
                    <a href="#"
                      onclick="confirmDelete('edu', <?= $edu['edu_id'] ?>, <?= $resume['id'] ?>, '<?= $resume['slug'] ?>'); return false;">
                      <i class="bi bi-x-lg"></i>
                    </a>
                  </div>
                  <p class="small text-secondary m-0" style="font-size:12px">
                    <i class="bi bi-clock-history"></i> Added On : <?= date('d F, Y h:i A', $edu['created_at']) ?>
                  </p>
                  <p class="small text-secondary m-0">
                    <i class="bi bi-book"></i> <?= $edu['institute'] ?>
                  </p>
                  <p class="small text-secondary m-0">
                    <?= $edu['started'] . '-' . $edu['ended'] ?>
                  </p>
                </div>
              </div>
              <?php
            }
          } else {
            ?>
            <div class="col-12 col-md-6 p-2">
              <div class="p-2 border rounded">
                <div class="d-flex justify-content-between">
                  <h6>I have no Education</h6>
                </div>
                <p class="small text-secondary m-0">
                  If you have Education, you can add it !!
                </p>
              </div>
            </div>
            <?php
          }
          ?>
        </div>

        <hr>
        <div class="d-flex justify-content-between" id="achievement">
          <h5 class="text-secondary"><i class="bi bi-trophy"></i> Achievements</h5>
          <div>
            <a class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#addach"><i
                class="bi bi-file-earmark-plus"></i> Add New</a>
          </div>
        </div>
        <div class="d-flex flex-wrap">
          <?php
          if ($ache) {
            foreach ($ache as $ach) {
              ?>
              <div class="col-12 col-md-6 p-2">
                <div class="p-2 border rounded">
                  <div class="d-flex justify-content-between">
                    <h6><?= $ach['ach_title'] ?></h6>
                    <a href="#"
                      onclick="confirmDelete('ach', <?= $ach['ach_id'] ?>, <?= $resume['id'] ?>, '<?= $resume['slug'] ?>'); return false;">
                      <i class="bi bi-x-lg"></i>
                    </a>
                  </div>
                  <p class="small text-secondary m-0" style="font-size:12px">
                    <i class="bi bi-clock-history"></i> Added On : <?= date('d F, Y h:i A', $ach['created_at']) ?>
                  </p>
                  <p class="small text-secondary m-0">
                    <i class="bi bi-book"></i> <?= $ach['organization'] ?>
                  </p>
                </div>
              </div>
              <?php
            }
          } else {
            ?>
            <div class="col-12 col-md-6 p-2">
              <div class="p-2 border rounded">
                <div class="d-flex justify-content-between">
                  <h6>I have no Achievements</h6>
                </div>
                <p class="small text-secondary m-0">
                  If you have Achievements, you can add them !!
                </p>
              </div>
            </div>
            <?php
          }
          ?>
        </div>

        <hr>
        <div class="d-flex justify-content-between" id="project">
          <h5 class="text-secondary"><i class="bi bi-projector"></i> Projects</h5>
          <div>
            <a class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#addprj"><i
                class="bi bi-file-earmark-plus"></i> Add New</a>
          </div>
        </div>
        <div class="d-flex flex-wrap">
          <?php
          if ($proj) {
            foreach ($proj as $prj) {
              ?>
              <div class="col-12 col-md-6 p-2">
                <div class="p-2 border rounded">
                  <div class="d-flex justify-content-between">
                    <h6><?= $prj['prj_title'] ?></h6>
                    <a href="#"
                      onclick="confirmDelete('prj', <?= $prj['prj_id'] ?>, <?= $resume['id'] ?>, '<?= $resume['slug'] ?>'); return false;">
                      <i class="bi bi-x-lg"></i>
                    </a>
                  </div>
                  <p class="small text-secondary m-0" style="font-size:12px">
                    <i class="bi bi-clock-history"></i> Added On : <?= date('d F, Y h:i A', $prj['created_at']) ?>
                  </p>
                  <p class="small text-secondary m-0">
                    <i class="bi bi-link-45deg"></i> <a href="<?= $prj['prj_url'] ?>"><?= $prj['prj_url'] ?></a>
                  </p>
                  <p class="small text-secondary m-0">
                    <i class="bi bi-book"></i> <?= $prj['prj_role'] ?>
                  </p>
                </div>
              </div>
              <?php
            }
          } else {
            ?>
            <div class="col-12 col-md-6 p-2">
              <div class="p-2 border rounded">
                <div class="d-flex justify-content-between">
                  <h6>I have no Projects</h6>
                </div>
                <p class="small text-secondary m-0">
                  If you have Projects, you can add them !!
                </p>
              </div>
            </div>
            <?php
          }
          ?>
        </div>

        <hr>
        <div class="d-flex justify-content-between" id="skill">
          <h5 class="text-secondary"><i class="bi bi-boxes"></i> Skills</h5>
          <div>
            <a class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#addskill"><i
                class="bi bi-file-earmark-plus"></i> Add New</a>
          </div>
        </div>
        <div class="d-flex flex-wrap">
          <?php
          if ($skills) {
            foreach ($skills as $skill) {
              ?>
              <div class="col-12 p-2">
                <div class="p-2 border rounded">
                  <div class="d-flex justify-content-between align-items-center">
                    <h6><i class="bi bi-caret-right"></i> <?= $skill['skill'] ?></h6>
                    <a href="#"
                      onclick="confirmDelete('skill', <?= $skill['skill_id'] ?>, <?= $resume['id'] ?>, '<?= $resume['slug'] ?>'); return false;">
                      <i class="bi bi-x-lg"></i>
                    </a>
                  </div>
                  <label><i class="bi bi-person-check"></i> <?= $skill['percentage'] ?> <i
                      class="bi bi-percent"></i></label>
                  <p class="small text-secondary m-0" style="font-size:12px">
                    <i class="bi bi-clock-history"></i> Added On : <?= date('d F, Y h:i A', $skill['created_at']) ?>
                  </p>
                </div>
              </div>
              <?php
            }
          } else {
            ?>
            <div class="col-12 p-2">
              <div class="p-2 border rounded">
                <div class="d-flex justify-content-between align-items-center">
                  <h6><i class="bi bi-caret-right"></i> I have no skills</h6>
                </div>
              </div>
            </div>
            <?php
          }
          ?>
        </div>

        <div class="col-12 text-end">
          <button type="submit" class="btn btn-primary"><i class="bi bi-floppy"></i> Update Resume</button>
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
<!-- modal exp-->
<div class="modal fade" id="addxp" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Add Experience</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <form class="row g-3" method="post" action="actions/addexperience.action.php">
          <input type="hidden" name="resume_id" value="<?= $resume['id'] ?>" />
          <input type="hidden" name="slug" value="<?= $resume['slug'] ?>" />
          <div class="col-12">
            <label for="inputEmail4" class="form-label">Position / Job Role</label>
            <input type="text" name="position" placeholder="Web Developer Consultant (2+ Years)" class="form-control"
              id="inputEmail4" required>
          </div>
          <div class="col-12">
            <label for="inputPassword4" class="form-label">Company</label>
            <input type="text" name='company' placeholder="Dominos,New Delhi" class="form-control" id="inputPassword4"
              required>
          </div>
          <div class="col-md-6">
            <label for="inputPassword4" class="form-label">Joined</label>
            <input type="text" name="started" placeholder="October 2021" class="form-control" id="inputPassword4"
              required>
          </div>
          <div class="col-md-6">
            <label for="inputPassword4" class="form-label">Resigned</label>
            <input type="text" name="ended" class="form-control" placeholder="Currently Pursuing" id="inputPassword4"
              required>
          </div>
          <div class="col-12">
            <label for="inputPassword4" class="form-label">Job Description</label>
            <textarea class="form-control" name="job_desc" id="exp1" required></textarea>
            <div class="d-flex justify-content-between mt-2">
              <button type="button" class="btn btn-primary"
                onclick="generateResponse('exp1',', for job description field.')">Improve</button>
              <button type="button" class="btn btn-success"
                onclick="realgenerateResponse('exp1',', for job description field.')">Generate</button>
            </div>
          </div>

          <div class="col-12 text-end">
            <button type="submit" class="btn btn-primary">Add Experience</button>
          </div>
        </form>

      </div>

    </div>
  </div>
</div>
<!-- Completed -->


<!-- modal edu -->
<div class="modal fade" id="addedu" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Add Education</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="row g-3" method="post" action="actions/addeducation.action.php">
          <input type="hidden" name="resume_id" value="<?= $resume['id'] ?>" />
          <input type="hidden" name="slug" value="<?= $resume['slug'] ?>" />
          <div class="col-12">
            <label for="inputEmail4" class="form-label">Course / Degree</label>
            <input type="text" name="course" placeholder="Completed 12th Class (Science Stream)" class="form-control"
              id="inputEmail4" required>
          </div>
          <div class="col-12">
            <label for="inputPassword4" class="form-label">Institute / Board</label>
            <input type="text" name='institute' placeholder="Central Board Of Secondary Education, New Delhi"
              class="form-control" id="inputPassword4" required>
          </div>
          <div class="col-md-6">
            <label for="inputPassword4" class="form-label">Started</label>
            <input type="text" name="started" placeholder="October 2021" class="form-control" id="inputPassword4"
              required>
          </div>
          <div class="col-md-6">
            <label for="inputPassword4" class="form-label">Ended</label>
            <input type="text" name="ended" class="form-control" placeholder="Currently Pursuing" id="inputPassword4"
              required>
          </div>

          <div class="col-12 text-end">
            <button type="submit" class="btn btn-primary">Add Education</button>
          </div>
        </form>
      </div>

    </div>
  </div>
</div>
<!-- Completed -->


<!-- modal ach -->
<div class="modal fade" id="addach" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Add Achivement</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="row g-3" method="post" action="actions/addachivement.action.php">
          <input type="hidden" name="resume_id" value="<?= $resume['id'] ?>" />
          <input type="hidden" name="slug" value="<?= $resume['slug'] ?>" />
          <div class="col-12">
            <label for="inputEmail4" class="form-label">Achivement Title</label>
            <input type="text" name="ach_title" placeholder="Ex : GenAI Hackathon Certificate" class="form-control"
              id="inputEmail4" required>
          </div>
          <div class="col-12">
            <label for="inputPassword4" class="form-label">Organization</label>
            <input type="text" name='organization' placeholder="Ex : Google, Microsoft" class="form-control"
              id="inputPassword4" required>
          </div>
          <div class="col-12">
            <label for="inputPassword4" class="form-label">Achivement Description</label>
            <textarea class="form-control" name="ach_desc" id="ach1" required></textarea>
            <div class="d-flex justify-content-between mt-2">
              <button type="button" class="btn btn-primary"
                onclick="generateResponse('ach1',', for achievement description field.')">Improve</button>
              <button type="button" class="btn btn-success"
                onclick="realgenerateResponse('ach1',', for achievement description field.')">Generate</button>
            </div>
          </div>

          <div class="col-12 text-end">
            <button type="submit" class="btn btn-primary">Add Achivement</button>
          </div>
        </form>
      </div>

    </div>
  </div>
</div>
<!-- Completed -->


<!-- modal ach -->
<div class="modal fade" id="addprj" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Add Project</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="row g-3" method="post" action="actions/addproject.action.php">
          <input type="hidden" name="resume_id" value="<?= $resume['id'] ?>" />
          <input type="hidden" name="slug" value="<?= $resume['slug'] ?>" />
          <div class="col-12">
            <label for="inputEmail4" class="form-label">Project Title</label>
            <input type="text" name="prj_title" placeholder="Ex : Violence Detection System" class="form-control"
              id="inputEmail4" required>
          </div>
          <div class="col-12">
            <label for="inputPassword4" class="form-label">Role</label>
            <input type="text" name='prj_role' placeholder="Ex : Developer" class="form-control" id="inputPassword4"
              required>
          </div>
          <div class="col-12">
            <label for="inputPassword4" class="form-label">URL</label>
            <input type="text" name='prj_url' placeholder="Ex : https://example.com" class="form-control"
              id="inputPassword4">
          </div>
          <div class="col-12">
            <label for="inputPassword4" class="form-label">Project Description</label>
            <textarea class="form-control" name="prj_desc" id="prj1" required></textarea>
            <div class="d-flex justify-content-between mt-2">
              <button type="button" class="btn btn-primary"
                onclick="generateResponse('prj1',', for project description field.')">Improve</button>
              <button type="button" class="btn btn-success"
                onclick="realgenerateResponse('prj1',', for project description field.')">Generate</button>
            </div>
          </div>

          <div class="col-12 text-end">
            <button type="submit" class="btn btn-primary">Add Project</button>
          </div>
        </form>
      </div>

    </div>
  </div>
</div>
<!-- Completed -->



<!-- modal skill -->
<div class="modal fade" id="addskill" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Add Skills</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="row g-3" method="post" action="actions/addskill.action.php">
          <input type="hidden" name="resume_id" value="<?= $resume['id'] ?>" />
          <input type="hidden" name="slug" value="<?= $resume['slug'] ?>" />

          <div class="col-12">
            <label for="inputEmail4" class="form-label">Skill</label>
            <input type="text" name="skill" placeholder="Basic Knowledge in Computer & Internet" class="form-control"
              id="inputEmail4" required>
          </div>

          <div class="col-12">
            <label for="inputEmail4" class="form-label">Percentage</label>
            <input type="number" name="percentage" placeholder="70 %" class="form-control" id="inputEmail4" required>
          </div>

          <div class="col-12 text-end">
            <button type="submit" class="btn btn-primary">Add Skills</button>
          </div>
        </form>
      </div>

    </div>
  </div>
</div>
<!-- Completed -->

<div class="resume-tips-container my-5">
  <h1 class="lg-title mb-4 text-center" style="color: #007bff; font-family: 'Poppins', sans-serif; font-weight: 600;">
    Essential Tips for Updating Your Resume
  </h1>
  <p class="text-muted mb-4 text-center">Welcome to <b>Resumify!</b> <br>Our platform is here to help you refine and
    enhance your resume. <br> Here are some important tips to consider when updating your resume:</p>
  <ul class="list-unstyled text-muted mx-auto" style="max-width: 600px;">
    <li class="mb-3 px-3 px-sm-4 px-md-5">
      <strong class="d-block">Highlight Recent Achievements:</strong> Ensure that you include your most recent
      accomplishments and roles to reflect your current skillset and experience.
    </li>
    <li class="mb-3 px-3 px-sm-4 px-md-5">
      <strong class="d-block">Update Your Skills Section:</strong> Refresh your skills section to include new
      competencies and certifications you have gained.
    </li>
    <li class="mb-3 px-3 px-sm-4 px-md-5">
      <strong class="d-block">Tailor for New Roles:</strong> Customize your resume for the specific roles you’re
      targeting by emphasizing relevant experiences and skills.
    </li>
    <li class="mb-3 px-3 px-sm-4 px-md-5">
      <strong class="d-block">Verify Contact Information:</strong> Double-check that your contact details are current
      and accurate to avoid missing out on potential opportunities.
    </li>
    <li class="mb-3 px-3 px-sm-4 px-md-5">
      <strong class="d-block">Proofread for Errors:</strong> Carefully proofread your resume for any spelling or
      grammatical mistakes to ensure a professional presentation.
    </li>
  </ul>
</div>


<script>
  function confirmDelete(type, id, resume_id, slug) {
    const urls = {
      'exp': 'actions/deleteexp.action.php',
      'edu': 'actions/deleteedu.action.php',
      'ach': 'actions/deleteache.action.php',
      'prj': 'actions/deleteproject.action.php',
      'skill': 'actions/deleteskill.action.php'
    };

    Swal.fire({
      title: 'Are you sure?',
      text: 'You will not be able to recover this item!',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Yes, delete it!',
      cancelButtonText: 'No, cancel!',
      reverseButtons: true
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = `${urls[type]}?${type}_id=${id}&resume_id=${resume_id}&slug=${slug}`;
      }
    });
  }
</script>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-C6RzsynMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>



<?php
require './assets/includes/footer.php';
?>