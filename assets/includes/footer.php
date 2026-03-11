<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Footer</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
  <style>
    .footer-custom {
      background-color: #fff;
      position: relative;
      width: 100%;
      min-height: 350px;
      padding: 3rem 1rem;
      margin-top: 40px; /* Added space above footer */
    }

    @media (max-width: 768px) {
      .footer-custom {
        margin-top: 30px; /* Adjusted space for tablets */
      }
    }

    @media (max-width: 480px) {
      .footer-custom {
        margin-top: 20px; /* Adjusted space for mobile devices */
      }
    }

    .container-custom {
      max-width: 1140px;
      margin: 0 auto;
      display: flex;
      justify-content: center;
      align-items: center;
      flex-direction: column;
    }

    .row-custom {
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .col-custom {
      min-width: 250px;
      color: #f2f2f2f2;
      font-family: poppins;
      padding: 0 2rem;
    }

    .col-custom .logo-custom {
      width: 100px;
      margin-bottom: 15px;
    }

    .col-custom h3 {
      color: #000;
      margin-bottom: 20px;
      position: relative;
      cursor: pointer;
    }

    .col-custom h3::after {
      content: '';
      height: 3px;
      width: 0px;
      background-color: #000;
      position: absolute;
      bottom: 0;
      left: 0;
      transition: 0.3s ease;
    }

    .col-custom h3:hover::after {
      width: 30px;
    }

    .col-custom .social-custom a i {
      color: #000;
      margin-top: 2rem;
      margin-right: 5px;
      transition: 0.3s ease;
    }

    .col-custom .social-custom a i:hover {
      transform: scale(1.5);
      filter: grayscale(25);
    }

    .col-custom .links-custom a {
      display: block;
      text-decoration: none;
      color: #000;
      margin-bottom: 5px;
      position: relative;
      transition: 0.3s ease;
    }

    .col-custom .links-custom a::before {
      content: '';
      height: 16px;
      width: 3px;
      position: absolute;
      top: 5px;
      left: -10px;
      background-color: #000;
      transition: 0.5s ease;
      opacity: 0;
    }

    .col-custom .links-custom a:hover::before {
      opacity: 1;
    }

    .col-custom .links-custom a:hover {
      transform: translateX(-8px);
      color: #000;
    }

    .contact-details-custom {
      color: #000;
    }

    .col-custom .contact-details-custom {
      display: inline-flex;
      justify-content: space-between;
    }

    .col-custom .contact-details-custom i {
      margin-right: 15px;
    }

    .col-custom .contact-details-custom p {
      color: #000;
    }

    .row-custom .form-custom {
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 2rem 0;
    }

    .row-custom .form-custom input {
      background-color: #f5f5f5;
      border: 0;
      outline: none;
      padding: 14px 20px;
      border-radius: 6px;
      /* border-top-right-radius: 0;
      border-bottom-right-radius: 0; */
    }

    .form-custom button {
      padding: 14px 20px;
      border: 0;
       /* border-radius: 6px;  */
      /* border-top-left-radius: 0;
      border-bottom-left-radius: 0; */
      background-color: #000; 
      color: #fff;
      cursor: pointer;
    }

    @media (max-width: 900px) {
      .row-custom {
        flex-direction: column;
      }

      .col-custom {
        width: 100%;
        text-align: left;
        margin-bottom: 25px;
      }
    }

    @media (max-width: 768px) {
      .row-custom {
        flex-direction: column;
      }

      .col-custom {
        width: 100%;
        text-align: left;
        margin-bottom: 20px;
      }
    }
  </style>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
</head>
<body>
  <footer class="footer-custom">
    <div class="container-custom">
      <div class="row-custom">
        <div class="col-custom" id="company">
          <a href="./index.php">
          <img src="./assets/live_assets/images/logo3.png" alt="" class="logo-custom">
          </a>
          <p style="color: #000;">
          At Resumify,<br> we specialize in crafting standout resumes that turn your professional experiences into compelling narratives. 
          </p>
          <div class="social-custom">
            <a href="https://www.instagram.com/omvaghela_?igsh=eWZkZGJ5NzJmdWhn" target="_blank"><i class="fab fa-instagram"></i></a>
            <a href="https://youtube.com/@spotofsomething?si=YbznitMuPa57Qu_j" target="_blank"><i class="fab fa-youtube"></i></a>
            <a href="https://x.com/OmVaghe92755092?t=6iJ2TbkeTaBK1eCk405uwA&s=08" target="_blank"><i class="fab fa-twitter"></i></a>
            <a href="https://www.linkedin.com/in/om-vaghela-0b818630b?utm_source=share&utm_campaign=share_via&utm_content=profile&utm_medium=android_app" target="_blank"><i class="fab fa-linkedin"></i></a>
          </div>
        </div>

        <div class="col-custom" id="services">
          <h3>Services</h3>
          <div class="links-custom">
            <a href="myresumes.php">Resume Building</a>
            <a href="myresumes.php">Resume Hosting</a>
          </div>
        </div>

        <div class="col-custom" id="useful-links">
          <h3>Links</h3>
          <div class="links-custom">
            <a href="./aboutus.php">About</a>
            <a href="./policy.php">Our Policy</a>
            <a href="./guide.php">Writing Guide</a>
          </div>
        </div>

        <div class="col-custom" id="contact">
          <h3>Contact</h3>
          <div class="contact-details-custom">
            <i class="fa-solid fa-location-crosshairs"></i>
            <p>PL-458, Shivam City Sihor<br> Bhavnagar, GJ-364240</p>
          </div>
          <div class="contact-details-custom">
            <i class="fa fa-phone"></i>
            <p><a href="tel:+919106483268" style="color: #000;">+91 9106483268</a></p>
          </div>
          <div class="contact-details-custom">
            <i class="fa-solid fa-envelope"></i>
            <p>
              <a href="mailto:breezebeamcreations@gmail.com" style="color:#000;">breezebeamcreations@gmail.com</a>,
              <a href="mailto:breezebeamcreations@yahoo.com" style="color:#000;">breezebeamcreations@yahoo.com</a>
            </p>
          </div>
        </div>
      </div>

      <div class="row-custom">
        <div class="form-custom">
        <p>&copy; 2024 Resumify from BreezeBeamCreationsTeam. All rights reserved.</p>
        </div>
      </div>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.7.1.js"
    integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
    crossorigin="anonymous"></script>
    <script src="./assets/js/scr.js"></script>
    <script src="./assets/js/generate.js"></script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/bodymovin/5.7.6/lottie.min.js"></script>

  <script>
    $(function() {
      <?php 
      $fn->error();
      $fn->alert();
      $fn->warning();
      $fn->message();
      ?>
    });
  </script>
</body>
</html>
