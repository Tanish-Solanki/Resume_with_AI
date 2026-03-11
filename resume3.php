<?php
require 'assets/class/database.class.php';
require 'assets/class/function.class.php';
// $fn->authpage();
$slug = $_GET['resume'] ?? '';
$resumes = $db->query("SELECT * FROM resumes WHERE (slug='$slug')");
$authid = $fn->auth()['usr_id'];
$profile = $db->query("SELECT * FROM profiles WHERE user_id=$authid");
$resume = $resumes->fetch_assoc();
$profile = $profile->fetch_assoc();
$profile_image_path = str_replace("../", "./", $profile['profile_image']);
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

<!DOCTYPE html>
<html lang="en">

<head>
    <!DOCTYPE html>
    <html lang="en">

    <head>

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Font -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link
            href="https://fonts.googleapis.com/css2?family=Akaya+Kanadaka&family=Comfortaa:wght@300..700&family=Concert+One&family=Dongle&family=Dosis:wght@200..800&family=Edu+AU+VIC+WA+NT+Hand:wght@400..700&family=Exo+2:ital,wght@0,100..900;1,100..900&family=Fira+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Josefin+Sans:ital,wght@0,100..700;1,100..700&family=Jost:ital,wght@0,100..900;1,100..900&family=Kalam:wght@300;400;700&family=Kaushan+Script&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&family=Playpen+Sans:wght@100..800&family=Playwrite+AU+NSW:wght@100..400&family=Playwrite+DE+Grund:wght@100..400&family=Raleway:ital,wght@0,100..900;1,100..900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Titillium+Web:ital,wght@0,200;0,300;0,400;0,600;0,700;0,900;1,200;1,300;1,400;1,600;1,700&family=Varela+Round&display=swap"
            rel="stylesheet">
        <!-- FTC -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;400&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
        <link rel="icon" href="./assets/images/logo.png">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css"
            integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />
        <title><?= $resume['full_name'] . ' : ' . $resume['resume_title'] ?></title>
        <style>
            @import url('https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800,900&display=swap');

            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
                font-family: 'Poppins', sans-serif;
                transition: all .2s;
            }

            body {
                background-color: #FAFAFA;
                font-size: 12pt;
                background: radial-gradient(circle, rgba(255, 255, 255, 1) 0%, rgba(240, 240, 240, 1) 49%, rgba(246, 246, 246, 1) 100%);
                background-image: url(./assets/images/tiles/<?= $resume['background'] ?>);
                background-attachment: fixed;
                display: flex;
                flex-direction: column;
                min-height: 100vh;
            }

            .navbar {
                width: 100%;
                background: #003147;
                padding: 20px;
                color: #fff;
                text-align: center;
                font-size: 1.2em;
                font-weight: 600;
            }

            .page {
                width: 90%;
                max-width: 35cm;
                /* Increased from 30cm to 35cm */
                min-height: 29.7cm;
                padding: 0.5cm;
                margin: 0.5cm auto;
                border: 1px #D3D3D3 solid;
                border-radius: 5px;
                background: white;
                box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            }

            .subpage {
                /* height: 256mm; */
            }

            @page {
                size: A4;
                margin: 0;
            }

            @media print {
                .page {
                    margin: 0;
                    border: initial;
                    border-radius: initial;
                    width: initial;
                    min-height: initial;
                    box-shadow: initial;
                    background: initial;
                    page-break-after: always;
                }

                body.print-mode {
                    background-image: none !important;
                }
            }

            @media screen {
                .print-mode {
                    background-image: url(./assets/images/tiles/<?= $resume['background'] ?>);
                }
            }

            .container {
                width: 100%;
                /* Changed to 100% */
                max-width: 35cm;
                /* Increased from 30cm to 35cm */
                min-height: 29.7cm;
                margin: 0 auto;
                /* Center the container horizontally */
                display: grid;
                grid-template-columns: 1fr 2fr;
                gap: 20px;
                padding-left: 0;
                /* Remove left padding */
            }

            .container .left_Side {
                background: #003147;
                padding: 20px;
                width: 100%;
            }

            .profileText {
                display: flex;
                flex-direction: column;
                align-items: center;
                padding-bottom: 20px;
                border-bottom: 1px solid rgba(179, 46, 46, 0.2);
            }

            .profileText .imgBx {
                width: 200px;
                height: 200px;
                border-radius: 50%;
                overflow: hidden;
            }

            .profileText .imgBx img {
                width: 100%;
                height: 100%;
                object-fit: cover;
            }

            .profileText h2 {
                color: #fff;
                font-size: 1.5em;
                margin-top: 20px;
                text-transform: uppercase;
                text-align: center;
                font-weight: 600;
                line-height: 1.4em;
            }

            .profileText h2 span {
                font-size: 0.8em;
                font-weight: 300;
            }

            .contactInfo {
                padding-top: 20px;
            }

            .contactInfo .title {
                color: #fff;
                text-transform: uppercase;
                font-weight: 600;
                letter-spacing: 1px;
                margin-bottom: 10px;
            }

            .contactInfo ul {
                position: relative;
            }

            .contactInfo ul li {
                list-style: none;
                margin: 10px 0;
                cursor: pointer;
            }

            .contactInfo ul li .icon {
                display: inline-block;
                width: 30px;
                font-size: 18px;
                color: #e37b7d;
            }

            .contactInfo ul li span {
                color: #fff;
                font-weight: 300;
            }

            .contactInfo.education li {
                margin-bottom: 15px;
            }

            .contactInfo.education h5 {
                color: rgb(241, 141, 141);
                font-weight: 500;
            }

            .contactInfo.education h4 {
                color: rgb(252, 248, 248);
                font-weight: 500;
            }

            .contactInfo.education h4:nth-child(2) {
                color: #fff;
                font-weight: 300;
            }

            .contactInfo.language .percent {
                width: 100%;
                height: 6px;
                background: #e37b7d;
                margin-top: 5px;
            }

            .contactInfo.language .percent div {
                height: 100%;
                background: #620304;
            }

            .container .right_Side {
                background: #fff;
                padding: 20px;
                width: 100%;
            }

            .about {
                margin-bottom: 50px;
            }

            .about:last-child {
                margin-bottom: 0;
            }

            .about .title2 {
                color: #003147;
                text-transform: uppercase;
                letter-spacing: 1px;
                margin-bottom: 10px;
            }

            .about .box {
                display: flex;
                flex-direction: row;
                margin: 20px 0;
            }

            .about .box .year_company {
                min-width: 150px;
            }

            .about .box .year_company h5 {
                text-transform: uppercase;
                color: #848c90;
                font-weight: 600;
            }

            .about .box .text h4 {
                text-transform: uppercase;
                color: rgb(148, 8, 8);
                font-size: 16px;
            }

            .experience-container {
                display: flex;
                flex-wrap: wrap;
                gap: 20px;
                /* Adjust the gap as needed */
            }

            .experience-box {
                flex: 1 1 calc(50% - 20px);
                /* Adjusts width to 50% minus the gap */
                box-sizing: border-box;

                border: 1px solid #ccc;
                /* Customize the border color */
                padding: 15px;
                /* Add padding inside the border */
                margin-bottom: 10px;
                /* Space between experience boxes */
                border-radius: 5px;
                /* Optional: rounded corners */
                margin-left: 5px;
                box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
                /* Optional: box shadow for better appearance */
            }

            .year_company,
            .text {
                margin-bottom: 10px;
            }


            .skills .box {
                width: 100%;
                display: grid;
                grid-template-columns: 150px 1fr;
                justify-content: center;
                align-items: center;
            }

            .skills .box h4 {
                text-transform: uppercase;
                color: #848c99;
                font-weight: 500;
            }

            .skills .box .percent {
                width: 100%;
                height: 10px;
                background: #c1baba;
            }

            .skills .box .percent div {
                height: 100%;
                background: #003147;
            }

            .interest ul {
                display: grid;
                grid-template-columns: repeat(4, 1fr);
            }

            .interest ul li {
                list-style: none;
                color: #333;
                font-weight: 500;
                margin: 10px 0;
            }

            .interest ul li .fa {
                color: #003147;
                font-size: 18px;
                width: 20px;
            }

            @media (max-width: 1200px) {
                .container {
                    grid-template-columns: 1fr;
                }

                .container .left_Side,
                .container .right_Side {
                    width: 100%;
                    padding: 20px;
                }
            }

            @media (max-width: 768px) {
                body {
                    font-size: 10pt;
                }

                .navbar {
                    font-size: 1em;
                }

                .profileText h2 {
                    font-size: 1.2em;
                }

                .profileText h2 span {
                    font-size: 0.7em;
                }
            }

            @media (max-width: 480px) {
                .container {
                    width: 100%;
                    padding: 10px;
                    grid-template-columns: 1fr;
                    /* Single column on small screens */
                }

                .page {
                    width: 100%;
                    padding: 0.5cm;
                    margin: 0.5cm auto;
                }

                .navbar {
                    padding: 15px;
                    font-size: 0.9em;
                }

                .profileText .imgBx {
                    width: 150px;
                    height: 150px;
                }

                .profileText h2 {
                    font-size: 1em;
                }

                .profileText h2 span {
                    font-size: 0.6em;
                }
            }
        </style>
    </head>

<body>
    <nav>
        <div class="extra">
            <div class="w-100 py-2 bg-dark d-flex justify-content-center gap-3">
                <?php
                $actual_link = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                ?>
                <a href="whatsapp://send?text=<?= $actual_link ?>" class="btn btn-light btn-sm"><i
                        class="bi bi-whatsapp"></i> Share</a>
                <button class="btn btn-light btn-sm" id="print"><i class="bi bi-printer"></i> Print</button>
                <button class="btn btn-light btn-sm" data-bs-toggle="offcanvas" data-bs-target="#background"><i
                        class="bi bi-backpack4"></i> Background</button>
                <button class="btn btn-light btn-sm" data-bs-toggle="offcanvas" data-bs-target="#font"><i
                        class="bi bi-backpack4-fill"></i> Font</button>
                <button class="btn btn-light btn-sm" id="downloadpdf"><i class="bi bi-file-earmark-pdf"></i>
                    Download</button>

            </div>
        </div>
    </nav>
    <div class="page">
        <div class="subpage">
            <div class="container">
                <div class="left_Side">
                    <div class="profileText">
                        <div class="imgBx">
                            <img src="<?= $profile_image_path; ?>">
                        </div>
                        <h2 style="font-family:<?= $resume['font'] ?>">
                            <?= $resume['full_name'] ?><br><span><?= $resume['profession'] ?></span>
                        </h2>
                    </div>

                    <div class="contactInfo">
                        <h3 class="title" style="font-family:<?= $resume['font'] ?>">Objective</h3>
                        <p style="font-family:<?= $resume['font'] ?>; color:#fff;"><?= $resume['objective'] ?></p>
                    </div>

                    <div class="contactInfo">
                        <h3 class="title" style="font-family:<?= $resume['font'] ?>">Contact Info</h3>
                        <ul>
                            <li>
                                <span class="icon"><i class="fa fa-phone" aria-hidden="true"></i></span>
                                <span class="text"
                                    style="font-family:<?= $resume['font'] ?>"><?= $resume['mobile_no'] ?></span>
                            </li>
                            <li>
                                <span class="icon"><i class="fa fa-envelope" aria-hidden="true"></i></span>
                                <span class="text"
                                    style="font-family:<?= $resume['font'] ?>"><?= $resume['email_id'] ?></span>
                            </li>
                            <li>
                                <span class="icon"><i class="fa fa-globe" aria-hidden="true"></i></span>
                                <span class="text" style="font-family:<?= $resume['font'] ?>">My WebSite</span>
                            </li>
                            <li>
                                <span class="icon"><i class="fa fa-linkedin" aria-hidden="true"></i></span>
                                <span class="text" style="font-family:<?= $resume['font'] ?>">LinkedIn</span>
                            </li>
                            <li>
                                <span class="icon"><i class="fa fa-map-marker" aria-hidden="true"></i></span>
                                <span class="text"
                                    style="font-family:<?= $resume['font'] ?>"><?= $resume['address'] ?></span>
                            </li>
                        </ul>
                    </div>

                    <div class="contactInfo education">
                        <h3 class="title" style="font-family:<?= $resume['font'] ?>">EDUCATION</h3>
                        <ul>
                            <?php
                            if ($edus) {
                                foreach ($edus as $edu) {
                                    ?>
                                    <li>
                                        <h5 style="font-family:<?= $resume['font'] ?>"><?= $edu['started'] ?> –
                                            <?= $edu['ended'] ?>
                                        </h5>
                                        <h4 style="font-family:<?= $resume['font'] ?>"><?= $edu['course'] ?></h4>
                                        <h4 style="font-family:<?= $resume['font'] ?>"><?= $edu['institute'] ?></h4>
                                    </li>


                                    <?php
                                }
                                ?>

                                <?php
                            } else {
                                ?>
                                <li>
                                    <h4 style="font-family:<?= $resume['font'] ?>">I am Not Have Education</h4>
                                </li>
                                <?php
                            }
                            ?>
                        </ul>
                    </div>
                    <div class="contactInfo language">
                        <h3 style="font-family:<?= $resume['font'] ?>" class="title">LANGUAGES</h3>
                        <ul>
                            <li>
                                <span style="font-family:<?= $resume['font'] ?>"
                                    class="text"><?= $resume['languages'] ?></span>
                                <span style="font-family:<?= $resume['font'] ?>" class="percent"></span>
                                <div style="width: 90%;"></div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="right_Side">
                    <div class="about">
                        <h2 class="title2" style="font-family:<?= $resume['font'] ?>">About Me</h2>
                        <p style="font-family:<?= $resume['font'] ?>"><?= $resume['about_me'] ?></p>


                        <li>
                            <span class="icon"><i class="fa fa-globe" aria-hidden="true"></i></span>
                            <span class="text"
                                style="font-family:<?= $resume['font'] ?>"><?= $resume['web_url'] ?></span>
                        </li>

                    </div>
                    <div class="about">
                        <h2 style="font-family:<?= $resume['font'] ?>" class="title2">Experience</h2>
                        <div class="experience-container">
                            <?php if ($exps): ?>
                                <?php foreach ($exps as $exp): ?>
                                    <div class="experience-box">
                                        <div class="year_company">
                                            <h5 style="font-family:<?= $resume['font'] ?>; font-size:15px;">
                                                <?= $exp['started'] ?> – <?= $exp['ended'] ?></h5>
                                            <h5 style="font-family:<?= $resume['font'] ?>; font-size:18px;">
                                                <?= $exp['company'] ?></h5>
                                        </div>
                                        <div class="text">
                                            <h4 style="font-family:<?= $resume['font'] ?>; padding-left:10px;">
                                                <?= $exp['position'] ?></h4>
                                            <p style="font-family:<?= $resume['font'] ?>; padding-left:10px;">
                                                <?= $exp['job_desc'] ?></p>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <div class="experience-box">
                                    <div class="year_company">
                                        <h5 style="font-family:<?= $resume['font'] ?>">Present - present</h5>
                                        <h5 style="font-family:<?= $resume['font'] ?>">Not Have Job !!</h5>
                                    </div>
                                    <div class="text">
                                        <h4 style="font-family:<?= $resume['font'] ?>">Not Have Job !!!!!!</h4>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>



                    <div class="about">
                        <h2 style="font-family:<?= $resume['font'] ?>" class="title2">Achievements</h2>
                        <div class="experience-container">
                            <?php if ($ache): ?>
                                <?php foreach ($ache as $ach): ?>
                                    <div class="experience-box">
                                        <div class="year_company">
                                            <h5 style="font-family:<?= $resume['font'] ?>; font-size:15px;">
                                                <?= $ach['ach_title'] ?></h5>
                                            <h5 style="font-family:<?= $resume['font'] ?>; font-size:18px;">
                                                <?= $ach['organization'] ?></h5>
                                        </div>
                                        <div class="text">

                                            <p style="font-family:<?= $resume['font'] ?>; padding-left:10px;">
                                                <?= $ach['ach_desc'] ?></p>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <div class="experience-box">
                                    <div class="year_company">
                                        <h5 style="font-family:<?= $resume['font'] ?>">Present - present</h5>
                                        <h5 style="font-family:<?= $resume['font'] ?>">Not Have Job !!</h5>
                                    </div>
                                    <div class="text">
                                        <h4 style="font-family:<?= $resume['font'] ?>">Not Have Job !!!!!!</h4>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>


                    <div class="about">
                        <h2 style="font-family:<?= $resume['font'] ?>" class="title2">Projects</h2>
                        <div class="experience-container">
                            <?php if ($proj): ?>
                                <?php foreach ($proj as $prj): ?>
                                    <div class="experience-box">
                                        <div class="year_company">
                                            <h5 style="font-family:<?= $resume['font'] ?>; font-size:15px;">
                                                <?= $prj['prj_title'] ?></h5>
                                            <h5 style="font-family:<?= $resume['font'] ?>; font-size:18px;">
                                                <?= $prj['prj_role'] ?></h5>
                                        </div>
                                        <div class="text">
                                            <a href="<?= $prj['prj_url'] ?>"
                                                style="font-family:<?= $resume['font'] ?>; padding-left:10px;"><?= $prj['prj_url'] ?></a>
                                            <p style="font-family:<?= $resume['font'] ?>; padding-left:10px;">
                                                <?= $prj['prj_desc'] ?></p>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <div class="experience-box">
                                    <div class="year_company">
                                        <h5 style="font-family:<?= $resume['font'] ?>">Present - present</h5>
                                        <h5 style="font-family:<?= $resume['font'] ?>">Not Have Job !!</h5>
                                    </div>
                                    <div class="text">
                                        <h4 style="font-family:<?= $resume['font'] ?>">Not Have Job !!!!!!</h4>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>



                    <div class="about skills">
                        <h2 style="font-family:<?= $resume['font'] ?>" class="title2">Professional Skills</h2>

                        <?php
                        if ($skills) {
                            foreach ($skills as $skill) {
                                ?>
                                <div class="box">
                                    <h4 style="font-family:<?= $resume['font'] ?>;  font-size:18px;"><?= $skill['skill'] ?></h4>
                                    <div class="percent">
                                        <div style="width:<?= $skill['percentage'] ?>%;"></div>
                                    </div>
                                </div>
                                <?php
                            }
                        } else {
                            ?>
                            <div class="box">
                                <h4 style="font-family:<?= $resume['font'] ?>">Not Have Skills !!!</h4>
                                <div class="percent">
                                    <div style="width:100%;"></div>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                    </div>

                    <div class="About interest">
                        <h2 style="font-family:<?= $resume['font'] ?>" class="title2">Interest (Hobbies)</h2>
                        <ul>
                            <li style="font-family:<?= $resume['font'] ?>"><i class="fa fa-briefcase"
                                    aria-hidden="true"></i>
                                <?= $resume['hobbies'] ?></li>
                        </ul>

                    </div>
                    <div style="padding-top:20px;">
                        <label class="fw-bold align-top text-nowrap pr title"
                            style="font-size: 20px;">Declaration</label>
                        <div class="pb-5 declaration">
                            <br>
                            I hereby declare that above information is correct to the best of my
                            knowledge and can be supported by relevant documents as and when
                            required.
                        </div>
                    </div>

                </div>

            </div>

            <div class="d-flex justify-content-between">
                <div class="px-3">Date : <?= date('d F, Y', $resume['updated_at']) ?></div>
                <div class="px-3 name text-end"><?= $resume['full_name'] ?></div>

            </div>
        </div>

    </div>


    <div class="offcanvas offcanvas-bottom" tabindex="-1" id="font" aria-labelledby="offcanvasBottomLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasBottomLabel">Change Font</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>

        <div class="offcanvas-body">
            <select class="form-control" id="font">
                <option value="oo" <?= $resume['font'] == 'oo' ? 'selected' : '' ?>>System Font</option>
                <option value="'Poppins', sans-serif" <?= $resume['font'] == "'Poppins', sans-serif" ? 'selected' : '' ?>
                    style="font-family: 'Poppins', sans-serif;">'Poppins', sans-serif</option>
                <option value="'Playpen Sans', cursive" <?= $resume['font'] == "'Playpen Sans', cursive" ? 'selected' : '' ?> style="font-family: 'Playpen Sans', cursive;">'Playpen Sans', cursive</option>
                <option value="'Dongle', sans-serif" <?= $resume['font'] == "'Dongle', sans-serif" ? 'selected' : '' ?>
                    style="font-family: 'Dongle', sans-serif;">'Dongle', sans-serif</option>
                <option value="'Akaya Kanadaka', system-ui" <?= $resume['font'] == "'Akaya Kanadaka', system-ui" ? 'selected' : '' ?> style="font-family: 'Akaya Kanadaka', system-ui;">'Akaya Kanadaka', system-ui
                </option>
                <option value="'Playwrite DE Grund', cursive" <?= $resume['font'] == "'Playwrite DE Grund', cursive" ? 'selected' : '' ?> style="font-family: 'Playwrite DE Grund', cursive;">'Playwrite DE Grund', cursive
                </option>
                <option value="'Playwrite AU NSW', cursive" <?= $resume['font'] == "'Playwrite AU NSW', cursive" ? 'selected' : '' ?> style="font-family: 'Playwrite AU NSW', cursive;">'Playwrite AU NSW', cursive
                </option>
                <option value="'Kaushan Script', cursive" <?= $resume['font'] == "'Kaushan Script', cursive" ? 'selected' : '' ?> style="font-family: 'Kaushan Script', cursive;">'Kaushan Script', cursive
                </option>
                <option value="'Kalam', cursive" <?= $resume['font'] == "'Kalam', cursive" ? 'selected' : '' ?>
                    style="font-family: 'Kalam', cursive;">'Kalam', cursive</option>
                <option value="'Concert One', sans-serif" <?= $resume['font'] == "'Concert One', sans-serif" ? 'selected' : '' ?> style="font-family: 'Concert One', sans-serif;">'Concert One', sans-serif</option>
                <option value="'Varela Round', sans-serif" <?= $resume['font'] == "'Varela Round', sans-serif" ? 'selected' : '' ?> style="font-family: 'Varela Round', sans-serif;">'Varela Round', sans-serif
                </option>
                <option value="'Exo 2', sans-serif" <?= $resume['font'] == "'Exo 2', sans-serif" ? 'selected' : '' ?>
                    style="font-family: 'Exo 2', sans-serif;">'Exo 2', sans-serif</option>
                <option value="'Titillium Web', sans-serif" <?= $resume['font'] == "'Titillium Web', sans-serif" ? 'selected' : '' ?> style="font-family: 'Titillium Web', sans-serif;">'Titillium Web', sans-serif
                </option>
                <option value="'Nunito Sans', sans-serif" <?= $resume['font'] == "'Nunito Sans', sans-serif" ? 'selected' : '' ?> style="font-family: 'Nunito Sans', sans-serif;">'Nunito Sans', sans-serif</option>
                <option value="'Comfortaa', sans-serif" <?= $resume['font'] == "'Comfortaa', sans-serif" ? 'selected' : '' ?> style="font-family: 'Comfortaa', sans-serif;">'Comfortaa', sans-serif</option>
                <option value="'Jost', sans-serif" <?= $resume['font'] == "'Jost', sans-serif" ? 'selected' : '' ?>
                    style="font-family: 'Jost', sans-serif;">'Jost', sans-serif</option>
                <option value="'Dosis', sans-serif" <?= $resume['font'] == "'Dosis', sans-serif" ? 'selected' : '' ?>
                    style="font-family: 'Dosis', sans-serif;">'Dosis', sans-serif</option>
                <option value="'Josefin Sans', sans-serif" <?= $resume['font'] == "'Josefin Sans', sans-serif" ? 'selected' : '' ?> style="font-family: 'Josefin Sans', sans-serif;">'Josefin Sans', sans-serif
                </option>
                <option value="'Fira Sans', sans-serif" <?= $resume['font'] == "'Fira Sans', sans-serif" ? 'selected' : '' ?> style="font-family: 'Fira Sans', sans-serif;">'Fira Sans', sans-serif</option>
                <option value="'Raleway', sans-serif" <?= $resume['font'] == "'Raleway', sans-serif" ? 'selected' : '' ?>
                    style="font-family: 'Raleway', sans-serif;">'Raleway', sans-serif</option>
                <option value="'Montserrat', sans-serif" <?= $resume['font'] == "'Montserrat', sans-serif" ? 'selected' : '' ?> style="font-family: 'Montserrat', sans-serif;">'Montserrat', sans-serif</option>
                <option value="'Roboto', sans-serif" <?= $resume['font'] == "'Roboto', sans-serif" ? 'selected' : '' ?>
                    style="font-family: 'Roboto', sans-serif;">'Roboto', sans-serif</option>
                <option value="'Edu AU VIC WA NT Hand', cursive" <?= $resume['font'] == "'Edu AU VIC WA NT Hand', cursive" ? 'selected' : '' ?> style="font-family: 'Edu AU VIC WA NT Hand', cursive;">'Edu AU VIC WA NT
                    Hand', cursive</option>

            </select>
        </div>
    </div>




    <div class="offcanvas offcanvas-bottom" tabindex="-1" id="background" style="height:50vh;"
        aria-labelledby="offcanvasBottomLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasBottomLabel">Change Background</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>

        <div class="offcanvas-body">
            <style>
                .tile {
                    width: 100px;
                    height: 100px;
                    background-size: cover;
                }

                .tile:hover {
                    cursor: pointer;
                    opacity: 0.7;
                }
            </style>
            <div class="d-flex w-100 gap-2 flex-wrap justify-content-center">
                <?php
                for ($i = 1; $i < 22; $i++) {
                    ?>
                    <div class="tile rounded shadow-sm border" data-background="tile<?= $i ?>.png"
                        style="background-image:url(./assets/images/tiles/tile<?= $i ?>.png)"></div>
                    <?php
                }
                ?>
                <div class="tile rounded shadow-sm border" data-background="tile23.jpg"
                    style=" background-image:url(./assets/images/tiles/tile23.jpg)"></div>

            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
    <script src="https://unpkg.com/jspdf@latest/dist/jspdf.umd.min.js"></script>
    <script>

        $("#downloadpdf").click(function () {
            const { jsPDF } = window.jspdf;

            // Capture the full page content using html2canvas
            html2canvas(document.querySelector('.page')).then(canvas => {
                const imgData = canvas.toDataURL('image/png');
                const imgWidth = 210; // A4 width in mm
                const pageHeight = 295; // A4 height in mm
                const imgHeight = canvas.height * imgWidth / canvas.width;
                const totalPages = Math.ceil(imgHeight / pageHeight);
                const doc = new jsPDF('p', 'mm', 'a4');

                let position = 0;

                for (let i = 0; i < totalPages; i++) {
                    doc.addImage(imgData, 'PNG', 0, position, imgWidth, imgHeight);
                    if (i < totalPages - 1) {
                        doc.addPage();
                        position -= pageHeight;
                    }
                }

                // Save the PDF with a custom file name
                const fullName = '<?= $resume['full_name'] ?>';
                const resumeTitle = '<?= $resume['resume_title'] ?>';
                doc.save(`${fullName} - ${resumeTitle}.pdf`);
            });
        });


        $('#font').change(function () {
            let font = $(this).find(":selected").val();
            $(".page").css('font-family', font);

            $.ajax({
                url: 'actions/changefont.action.php',
                method: 'post',
                data: {
                    resume_id: <?= @$resume['id'] ?>,
                    font: font
                },
                success: function (res) {
                    console.log(res);
                    location.reload(); // Refresh the page after the font is updated
                },
                error: function (res) {
                    console.log(res);
                    alert('Font is not Updated !!!');
                }
            });
        });

        $('.tile').click(function () {
            let tile = $(this).data('background');
            $("body").css('background-image', 'url(./assets/images/tiles/' + tile + ')');

            $.ajax({
                url: 'actions/changeback.action.php',
                method: 'post',
                data: {
                    resume_id: <?= @$resume['id'] ?>,
                    background: tile
                },
                success: function (res) {
                    console.log(res);
                },
                error: function (res) {
                    console.log(res);
                    alert('Background is not Updated !!!')
                }
            })
        })

        $("#print").click(function () {
            // Add a class to hide the background image
            $("body").addClass("print-mode");

            // Hide elements with the 'extra' class
            $(".extra").hide();

            // Trigger the print dialog
            window.print();

            // Restore the background image and show the hidden elements after printing
            setTimeout(() => {
                $("body").removeClass("print-mode");
                $(".extra").show();
            }, 500);
        });

    </script>




</body>

</html>