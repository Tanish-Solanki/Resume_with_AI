<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>About Us</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="icon" href="./assets/images/logo.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
   
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: rgb(255, 255, 255);
            background: radial-gradient(circle, rgba(255, 255, 255, 1) 0%, rgba(240, 240, 240, 1) 49%, rgba(246, 246, 246, 1) 100%);
        }
        .header h1, .section-title h2 {
            font-weight: 600;
        }
        .headerr {
            margin-top: 40px;
            margin-bottom: 30px;
        }
        blockquote {
            border-left: 4px solid #ddd;
            padding-left: 1rem;
            margin: 1rem 0;
            font-style: italic;
        }
        .footer {
            padding: 1rem;

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
                <a onclick="history.back()" class="btn btn-sm btn-dark"><i class="bi bi-arrow-bar-left"></i> Back</a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container content">
        <!-- Header -->
        <div class="headerr text-center mt-5 mb-5">
            <h1>About Resumify</h1>
        </div>

        <!-- Mission Section -->
        <div class="section">
            <div class="section-title mb-4">
                <h2>Our Mission</h2>
            </div>
            <p>At Resumify, our mission is to empower job seekers with the tools and guidance needed to create exceptional resumes. We believe that a strong resume is the key to unlocking career opportunities and achieving professional success. Our goal is to simplify the resume creation process and help you stand out in the competitive job market.</p>
        </div>

        <!-- Company Overview Section -->
        <div class="section">
            <div class="section-title mb-4">
                <h2>Who We Are</h2>
            </div>
            <p>Resumify was founded with a vision to make resume building accessible and straightforward. We understand that crafting a resume can be overwhelming, especially with the evolving demands of the job market. To address this, we've developed a platform that merges expert advice with intuitive tools, enabling you to create a resume that effectively showcases your skills and experiences.</p>
            <p>Our platform provides a range of features including customizable resume templates, actionable tips from industry professionals, and guided steps to ensure your resume is both impactful and tailored to your career goals. Whether you are embarking on your first job search, seeking advancement in your current career, or transitioning to a new field, Resumify offers the resources you need to succeed.</p>
        </div>

        <!-- Testimonials Section -->
        <div class="section">
            <div class="section-title mb-4">
                <h2>What Our Users Say</h2>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <blockquote class="blockquote">
                        <p>"Resumify made it so easy to create a professional resume that helped me land my dream job!"</p>
                        <footer class="blockquote-footer">Alex Johnson</footer>
                    </blockquote>
                </div>
                <div class="col-md-6">
                    <blockquote class="blockquote">
                        <p>"The step-by-step guidance and templates were incredibly helpful in tailoring my resume for specific roles."</p>
                        <footer class="blockquote-footer">Sarah Lee</footer>
                    </blockquote>
                </div>
            </div>
        </div>

        <!-- Contact Information Section -->
        <div class="section">
            <div class="section-title mb-4">
                <h2>Contact Us</h2>
            </div>
            <p>If you have any questions or need support, feel free to reach out to us:</p>
            <ul>
                <li>Email: <a href="mailto:breezebeamteam@gmail.com" style="color:#000; text-decoration: none;">breezebeamteam@gmail.com</a></li>
                <li>Phone: <a href="tel:+919409249951" style="color: #000; text-decoration: none;">+91 9409249951</a></li>
                
                
            </ul>
        </div>

        <!-- FAQ Section -->
        <div class="section">
            <div class="section-title mb-4">
                <h2>Frequently Asked Questions (FAQs)</h2>
            </div>
            <div class="accordion" id="faqAccordion">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            What is Resumify?
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Resumify is an online platform designed to help job seekers create professional resumes with ease. It offers customizable templates and expert tips to make your resume stand out.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            How can I get started with Resumify?
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                        To get started with Resumify, first, sign up for an account on our website and create your profile. Once you’re logged in, you can add your resume details. After entering your information, you can select a resume template and customize it as needed. Finally, you can print or download your completed resume using our user-friendly tools.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            Is there a cost to use Resumify?
                        </button>
                    </h2>
                    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                        Resumify is completely free to use. All features and tools available on the platform are accessible at no cost, so you can create and customize your resume without any charges.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- Footer -->
<div class="footer text-center mt-5 mb-5">
    <p>&copy; 2024 Resumify. All rights reserved.</p>
</div>


    <?php
    require './assets/includes/footer.php';
    ?>

