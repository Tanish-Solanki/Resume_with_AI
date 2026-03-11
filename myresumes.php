<?php
$title = 'Myresumes';
require './assets/includes/header.php';
require './assets/includes/navbar.php';
$fn->authpage();

$user_id = $fn->auth()['usr_id'];
$resumes = $db->query('SELECT * FROM resumes WHERE user_id =' . $user_id . ' ORDER BY id DESC');
$resumes = $resumes->fetch_all(MYSQLI_ASSOC);

// Filter resumes with status 0
$active_resumes = array_filter($resumes, function ($resume) {
  return $resume['status'] == 0;
});
?>

<style>
  .modal-content {
    border-radius: 15px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  }

  .card {
    border: none;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s, box-shadow 0.3s;
  }

  .card:hover {
    transform: scale(1.05);
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
  }

  .card-img-top {
    border-top-left-radius: 10px;
    border-top-right-radius: 10px;
  }

  .modal-body {
    padding: 2rem;
  }

  .modal-header {
    border-bottom: none;
  }

  .btn-primary,
  .btn-secondary {
    border-radius: 30px;
    padding: 10px 20px;
    font-size: 16px;
    transition: all 0.3s ease-in-out;
  }

  .btn-primary:hover,
  .btn-secondary:hover {
    transform: translateY(-3px);
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
  }

  .btn-group .btn {
    margin: 10px 5px;
  }

  .section-one {
    margin-top: 40px;
    /* Added space above footer */
  }

  @media (max-width: 768px) {
    .section-one {
      margin-top: 30px;
      /* Adjusted space for tablets */
    }
  }

  @media (max-width: 480px) {
    .section-one {
      margin-top: 20px;
      /* Adjusted space for mobile devices */
    }
  }

  .section-one,
  .section-two {
    font-family: 'Poppins', sans-serif;
    padding: 60px 0;
  }

  .section-one img {
    max-width: 100%;
    height: auto;
  }

  .section-two .section-item {
    padding: 20px;
    transition: transform 0.3s ease;
  }

  .section-two .section-item:hover {
    transform: translateY(-10px);
  }

  .section-two .section-item-icon {
    width: 70px;
    margin: 0 auto 20px;
  }
</style>

<div class="container">
  <div class="text-center my-5 py-4 rounded" style="font-family: 'Poppins', sans-serif;">
    <h1 class="lg-title mb-3">Hello, <b class="text-primary"><?= $user['full_name'] ?></b></h1>
    <p class="text-muted">Welcome to our resumify.<br> Create and manage your resumes effortlessly with our easy-to-use
      interface.</p>
  </div>

  <div class="bg-white rounded shadow p-2 mt-4" style="min-height:80vh">
    <div class="d-flex justify-content-between border-bottom">
      <h5>Resumes</h5>
      <div>
        <a href="<?php echo $active_profiles ? 'add_resume.php' : 'createresume.php'; ?>"
          class="text-decoration-none"><i class="bi bi-file-earmark-plus"></i> Add Resume</a>
      </div>
    </div>

    <?php
    if (!empty($active_resumes)) {
      ?>
      <div class="d-flex flex-wrap">
        <?php
        foreach ($active_resumes as $resume) {
          ?>
          <div class="col-12 col-md-6 p-2">
            <div class="p-2 border rounded">
              <h5><?= $resume['resume_title'] ?></h5>
              <p class="small text-secondary m-0" style="font-size:12px">
                <i class="bi bi-clock-history"></i> Last Updated <?= date('d F, Y h:i A', $resume['updated_at']) ?>
              </p>
              <div class="d-flex gap-2 mt-1">
                <a data-bs-toggle="modal" data-bs-target="#printmodal" class="text-decoration-none small"><i
                    class="bi bi-file-text"></i> Open</a>
                <a href="updateresume.php?resume=<?= $resume['slug'] ?>" class="text-decoration-none small"><i
                    class="bi bi-pencil-square"></i> Edit</a>
                <a href="#" onclick="confirmDelete(event, 'actions/deleteresume.action.php?id=<?= $resume['id'] ?>')"
                  class="text-decoration-none small"><i class="bi bi-trash2"></i> Delete</a>
                <a href="actions/clonecv.action.php?resume=<?= $resume['slug'] ?>" class="text-decoration-none small"><i
                    class="bi bi-copy"></i> Clone</a>
              </div>
            </div>
          </div>
          <?php
        }
        ?>
      </div>
    <?php
    } else {
      ?>
      <div class="text-center py-3 border rounded mt-3" style="background-color: rgba(236, 236, 236, 0.56);">
        <i class="bi bi-file-text"></i> No Resumes Available
      </div>
    <?php
    }
    ?>
  </div>
</div>

<section class="section-one">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-md-6">
        <img
          src="./assets/live_assets/images/ai54546546548.png"
          class="img-fluid" alt="Visual">
      </div>
      <div class="col-md-6 text-center">
      <h2 class="lg-title">Use the AI as Your Guide!</h2>
<p class="text"><br>Harness the power of artificial intelligence to enhance your journey. Our AI guide offers personalized recommendations, answers to your questions, and support tailored to your needs. Experience the future of technology with an intuitive and intelligent assistant by your side.</p>

        <div class="btn-group">
          <a href="<?php echo $active_profiles ? 'add_resume.php' : 'createresume.php'; ?>" class="btn btn-primary text-uppercase">create my resume</a>
          <a href="guide.php" class="btn btn-secondary text-uppercase">writing guide</a>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="section-two bg-white">
  <div class="container">
    <div class="row text-center">
      <div class="col-md-4">
        <div class="section-item">
          <div class="section-item-icon mb-3">
            <img
              src="./assets/live_assets/images/feature-1-edf4481d69166ac81917d1e40e6597c8d61aa970ad44367ce78049bf830fbda5.svg"
              alt="">
          </div>
          <h5 class="section-item-title">Craft an Interview-Winning Resume with AI !</h5>
<p class="text"><br>Leverage our AI-powered resume builder to create a compelling professional narrative. Our advanced tools help you design a resume that captures the attention of recruiters, hiring managers, and executives, enhancing your chances of landing that dream job.</p>

        </div>
      </div>
      <div class="col-md-4">
        <div class="section-item">
          <div class="section-item-icon mb-3">
            <img
              src="./assets/live_assets/images/feature-2-a7a471bd973c02a55d1b3f8aff578cd3c9a4c5ac4fc74423d94ecc04aef3492b.svg"
              alt="">
          </div>
          <h5 class="section-item-title">Effortless Resume Creation with AI</h5>
<p class="text"><br>Streamline your resume-building process with our AI-enhanced tool. Benefit from pre-written content, sleek design options, and a user-friendly interface. Simply input your information and let our system craft a professional resume for you.</p>

        </div>
      </div>
      <div class="col-md-4">
        <div class="section-item">
          <div class="section-item-icon mb-3">
            <img
              src="./assets/live_assets/images/feature-3-4e87a82f83e260488c36f8105e26f439fdc3ee5009372bb5e12d9421f32eabdd.svg"
              alt="">
          </div>
          <h5 class="section-item-title">CV Maker Endorsed by Recruiters</h5>
<p class="text"><br>Our CV builder, featuring pre-crafted content and intuitive design, has been vetted by industry professionals and IT experts. Elevate your CV to stand out in the competitive job market and make a lasting impression on recruiters.</p>

        </div>
      </div>
    </div>
  </div>
</section>


<!-- Modal Structure -->
<div class="modal fade" id="printmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Select Template</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row g-3">
          <!-- Card 1 -->
          <div class="col-md-4">
            <a href="resume.php?resume=<?= $resume['slug'] ?>" target="_blank" class="card text-decoration-none">
              <img src="./assets/images/tmplt_selc/tmp1.png" class="card-img-top" alt="Image 1">
              <div class="card-body text-center">
                <h5 class="card-title">Template 1</h5>
                <p class="card-text">Click To Open</p>
              </div>
            </a>
          </div>
          <!-- Card 2 -->
          <div class="col-md-4">
            <a href="resume2.php?resume=<?= $resume['slug'] ?>" target="_blank" class="card text-decoration-none">
              <img src="./assets/images/tmplt_selc/tmp2.png" class="card-img-top" alt="Image 2">
              <div class="card-body text-center">
                <h5 class="card-title">Template 2</h5>
                <p class="card-text">Click To Open</p>
              </div>
            </a>
          </div>
          <!-- Card 3 -->
          <div class="col-md-4">
            <a href="resume3.php?resume=<?= $resume['slug'] ?>" target="_blank" class="card text-decoration-none">
              <img src="./assets/images/tmplt_selc/tmp3.png" class="card-img-top" alt="Image 3">
              <div class="card-body text-center">
                <h5 class="card-title">Template 3</h5>
                <p class="card-text">Click To Open</p>
              </div>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

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