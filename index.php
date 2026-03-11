<?php
require_once './assets/class/database.class.php';
require_once './assets/class/function.class.php';

$auth = $fn->Auth();
if ($auth && isset($auth['usr_id'])) {
    $authid = $auth['usr_id'];
}


$stmt = $db->prepare("SELECT full_name, email_id FROM users WHERE usr_id = ?");
$stmt->bind_param("i", $authid);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    $user = 0;
}

$stmt->close();
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Home Page</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="./assets/images/logo.png">
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .navbar-brand-icon {
            width: 40px;
            height: 40px;
        }

        .header {
            padding: 100px 0;
            background: linear-gradient(to right, #6a11cb, #2575fc);
            color: white;
            font-family: 'Poppins', sans-serif;
            text-align: center;
        }

        .header img.main-image {
            margin-top: 30px;
            max-width: 40%;
            border-radius: 35px;
            height: auto;
        }

        /* .header img.small-image {
                margin-top: 20px;
                max-width: 80px;
                height: auto;
            } */
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

        .section-one,
        .section-two {
            padding: 60px 0;
            font-family: 'Poppins', sans-serif;
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

        .footer {
            padding: 30px 0;
            background-color: #333;
            color: white;
            text-align: center;
        }

        .contact-us {
            padding: 60px 0;
        }

        .contact-us .form-control,
        .contact-us .form-control:focus {
            border-radius: 0.25rem;
            box-shadow: none;
        }

        .contact-us .form-group {
            margin-bottom: 1.5rem;
        }

        .contact-us .btn-primary {
            border-radius: 30px;
            padding: 10px 20px;
            font-size: 16px;
            transition: all 0.3s ease-in-out;
        }

        .contact-us .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .map-iframe iframe {
            border-radius: 8px;
        }

        /*  */
        .modal-header {
            background-color: #343a40;
            color: white;
            border-bottom: none;
        }

        .modal-footer {
            border-top: none;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .modal-body {
            position: relative;
        }

        .modal-body img {
            width: 100%;
            height: auto;
            border-radius: 8px;
        }

        .feedback-form {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 8px;
            width: 100%;
        }

        /*  */
        @media (max-width: 768px) {

            .header,
            .section-one,
            .section-two,
            .contact-us {
                padding: 40px 0;
            }

            .header h1 {
                font-size: 1.75rem;
            }

            .header p {
                font-size: 1rem;
            }

            .btn-primary,
            .btn-secondary {
                font-size: 14px;
                padding: 8px 16px;
            }

            .section-one img,
            .section-two .section-item-icon img {
                max-width: 80%;
                margin: 0 auto;
            }

            .contact-us .form-group {
                margin-bottom: 1rem;
            }
        }
    </style>
</head>

<body>

    <nav class="navbar bg-body-tertiary shadow">
        <div class="container">
            <a class="navbar-brand" href="index.php" style="color:#000;">
                <img src="./assets/images/logo.png" alt="Logo" height="24" class="d-inline-block align-text-top">
                Resumify
            </a>
            <div>
                <a href="login.php" class="btn btn-sm btn-dark"><i class="bi bi-person-circle"></i>
                    <?php
                    if ($user) {
                        echo $user['full_name'];
                    } else {
                        echo "Sign In";
                    }
                    ?></a>
            </div>
        </div>
    </nav>

    <header class="header">
        <div class="container">
            <h6 class="text-uppercase fs-14 fw-6 ls-1">AI resume builder</h6>
            <h1 class="lg-title">Only 2% of resumes make it past the first round.<br>Be in the top 2%.</h1>

            <p class="fs-18">Use professional, field-tested resume templates that follow the exact 'resume rules'
                employers look for.<br> Easy to use and done within minutes. Try it now for free !!</p>


            <img src="./assets/images/index/tmp_index.png" class="img-fluid mt-3 main-image" alt="Resume Templates">
        </div>
        <a href="myresumes.php" style="margin-top: 1rem;" class="btn btn-primary text-uppercase">create my resume</a>
    </header>

    <section class="section-one bg-light">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <img src="./assets/live_assets/images/visual-0c7080adf17f1f207276f613447c924f667dab34b7ac415cd7ef653172defd0b.svg"
                        class="img-fluid" alt="Visual">
                </div>
                <div class="col-md-6 text-center">
                    <h2 class="lg-title">Use the best resume maker as your guide!</h2>
                    <p class="text">Getting that dream job can seem like an impossible task. We're here to change that.
                        Give yourself a real advantage with the best online resume maker: created by experts, improved
                        by data, trusted by millions of professionals.</p>
                    <div class="btn-group">
                        <a href="myresumes.php" class="btn btn-primary text-uppercase">create my resume</a>
                        <a href="guide.php" class="btn btn-secondary text-uppercase">Writing Guide</a>
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
                            <img src="./assets/live_assets/images/feature-1-edf4481d69166ac81917d1e40e6597c8d61aa970ad44367ce78049bf830fbda5.svg"
                                alt="">
                        </div>
                        <h5 class="section-item-title">Make a resume that wins interviews!</h5>
                        <p class="text">Use our resume maker with its advanced creation tools to tell a professional
                            story that engages recruiters, hiring managers, and even CEOs.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="section-item">
                        <div class="section-item-icon mb-3">
                            <img src="./assets/live_assets/images/feature-2-a7a471bd973c02a55d1b3f8aff578cd3c9a4c5ac4fc74423d94ecc04aef3492b.svg"
                                alt="">
                        </div>
                        <h5 class="section-item-title">Resume writing made easy!</h5>
                        <p class="text">Resume writing has never been this effortless. Pre-generated text, visual
                            designs, and more - all already integrated into the resume maker. Just fill in your details.
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="section-item">
                        <div class="section-item-icon mb-3">
                            <img src="./assets/live_assets/images/feature-3-4e87a82f83e260488c36f8105e26f439fdc3ee5009372bb5e12d9421f32eabdd.svg"
                                alt="">
                        </div>
                        <h5 class="section-item-title">A recruiter-tested CV maker tool</h5>
                        <p class="text">Our resume builder and its pre-generated content are tested by recruiters and IT
                            experts. We help your CV become truly competitive in the hiring process.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="contact-us bg-light" id="contact">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h2 class="text-center mb-4">Contact Us</h2>
                    <form method="POST" action="actions/contactus.action.php">
                        <div class="form-group">
                            <label for="name">Full Name</label>
                            <input type="text" name="full_name" class="form-control" id="name"
                                placeholder="Your Full Name">
                        </div>
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" name="email_id" class="form-control" id="email"
                                placeholder="Your Email">
                        </div>
                        <div class="form-group">
                            <label for="message">Message</label>
                            <textarea class="form-control" name="message" id="message" rows="4"
                                placeholder="Your Message"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Send Message</button>
                    </form>
                </div>
                <div class="col-md-6">
                    <div class="map-iframe">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d118570.43291002829!2d72.17996352104207!3d21.767639403470966!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x395f5081abb84e2f%3A0xf676d64c6e13716c!2sBhavnagar%2C%20Gujarat!5e0!3m2!1sen!2sin!4v1722961915746!5m2!1sen!2sin"
                            width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <section class="section-one bg-light" id="feedback">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <img src="./assets/live_assets/images/feedback.png" class="img-fluid" alt="Visual">
                </div>
                <div class="col-md-6 text-center">
                    <h2 class="lg-title">We’d Love to Hear from You!</h2>
                    <p class="text">If you have any questions or feedback, feel free to reach out. Our team is here to
                        help you with anything you need. Your input is valuable to us!</p>
                    <a data-bs-toggle="modal" data-bs-target="#feedbackModal"
                        class="btn btn-primary text-uppercase">Give Feedback</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal -->
    <div class="modal fade" id="feedbackModal" tabindex="-1" aria-labelledby="feedbackModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="feedbackModalLabel">Feedback Form</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="actions/feedback.action.php" method="post">
                        <div class="mb-3">
                            <label for="feedbackName" class="form-label">Full Name</label>
                            <input type="text" class="form-control" name="full_name" id="feedbackName"
                                placeholder="Your Full Name">
                        </div>
                        <div class="mb-3">
                            <label for="feedbackEmail" class="form-label">Email address</label>
                            <input type="email" class="form-control" name="email_id" id="feedbackEmail"
                                placeholder="Your Email">
                        </div>
                        <div class="mb-3">
                            <label for="feedbackMessage" class="form-label">Feedback</label>
                            <textarea class="form-control" id="feedbackMessage" name="feedback" rows="4"
                                placeholder="Your Feedback"></textarea>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Send Feedback</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>

    <?php
    require './assets/includes/footer.php';
    ?>