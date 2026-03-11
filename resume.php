<?php
require 'assets/class/database.class.php';
require 'assets/class/function.class.php';
// $fn->authpage();
$slug = $_GET['resume']??'';
$resumes = $db->query("SELECT * FROM resumes WHERE (slug='$slug')");
$resume= $resumes->fetch_assoc();
if(!$resume){
    $fn->redirect('myresumes.php');
}

$exps = $db->query("SELECT * FROM experiences WHERE (resume_id=".$resume['id'].")");
$exps = $exps->fetch_all(1);

$edus = $db->query("SELECT * FROM education WHERE (resume_id=".$resume['id'].")");
$edus = $edus->fetch_all(1);

$skills = $db->query("SELECT * FROM skills WHERE (resume_id=".$resume['id'].")");
$skills = $skills->fetch_all(1);

$ache = $db->query("SELECT * FROM achivements WHERE (resume_id=".$resume['id'].")");
$ache = $ache->fetch_all(1);

$proj = $db->query("SELECT * FROM projects WHERE (resume_id=".$resume['id'].")");
$proj = $proj->fetch_all(1);

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Akaya+Kanadaka&family=Comfortaa:wght@300..700&family=Concert+One&family=Dongle&family=Dosis:wght@200..800&family=Edu+AU+VIC+WA+NT+Hand:wght@400..700&family=Exo+2:ital,wght@0,100..900;1,100..900&family=Fira+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Josefin+Sans:ital,wght@0,100..700;1,100..700&family=Jost:ital,wght@0,100..900;1,100..900&family=Kalam:wght@300;400;700&family=Kaushan+Script&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&family=Playpen+Sans:wght@100..800&family=Playwrite+AU+NSW:wght@100..400&family=Playwrite+DE+Grund:wght@100..400&family=Raleway:ital,wght@0,100..900;1,100..900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Titillium+Web:ital,wght@0,200;0,300;0,400;0,600;0,700;0,900;1,200;1,300;1,400;1,600;1,700&family=Varela+Round&display=swap" rel="stylesheet">
    <!-- FTC -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="icon" href="./assets/images/logo.png">
    <title><?=$resume['full_name'].' : '.$resume['resume_title']?></title>

    <style>
       body {
    margin: 0;
    padding: 0;
    background-color: #FAFAFA;
    font-family: 'Poppins', sans-serif;
    font-size: 12pt;
    background: rgb(255, 255, 255);
    background: radial-gradient(circle, rgba(255, 255, 255, 1) 0%, rgba(240, 240, 240, 1) 49%, rgba(246, 246, 246, 1) 100%);
    /* background-image: url(./tiles/tile23.jpg); */
    background-image: url(./assets/images/tiles/<?=$resume['background']?>);
    background-attachment: fixed;
}

* {
    margin: 0;
    box-sizing: border-box;
    transition: all 0.2s;
}

.page {
    width: 100%;
    max-width: 21cm;
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
}

table {
    border-collapse: collapse;
}

.pr {
    padding-right: 30px;
}

.pd-table td {
    padding-right: 10px;
    padding-bottom: 3px;
    padding-top: 3px;
}

/* Responsive styles */
@media (max-width: 1200px) {
    .page {
        padding: 1cm;
    }
}

@media (max-width: 992px) {
    .page {
        width: 90%;
        padding: 0.8cm;
    }
}

@media (max-width: 768px) {
    body {
        font-size: 10pt;
    }
    .page {
        width: 100%;
        padding: 0.5cm;
    }
    .pr {
        padding-right: 20px;
    }
}

@media (max-width: 576px) {
    body {
        font-size: 9pt;
    }
    .page {
        width: 100%;
        padding: 0.3cm;
    }
    .pr {
        padding-right: 10px;
    }
}

    </style>

</head>
<body>
<div class="extra">
<div class="w-100 py-2 bg-dark d-flex justify-content-center gap-3">
    <?php
$actual_link = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    ?>
    <a href="whatsapp://send?text=<?=$actual_link?>"  class="btn btn-light btn-sm"><i class="bi bi-whatsapp"></i> Share</a>
    <button class="btn btn-light btn-sm" id="print"><i class="bi bi-printer"></i> Print</button>
    <button class="btn btn-light btn-sm" data-bs-toggle="offcanvas" data-bs-target="#background"><i class="bi bi-backpack4"></i> Background</button>
    <button class="btn btn-light btn-sm" data-bs-toggle="offcanvas" data-bs-target="#font"><i class="bi bi-backpack4-fill"></i> Font</button>
    <button class="btn btn-light btn-sm" id="downloadpdf"><i class="bi bi-file-earmark-pdf"></i> Download</button>
    
</div>
</div>

<div class="page" style="font-family:<?=$resume['font']?>">
    <div class="subpage">
        <table class="w-100">
            <tbody>
                <tr>
                    <td colspan="2" class="text-center fw-bold fs-4">Resume</td>
                </tr>
                <tr>
                    <td></td>
                    <td class="personal-info zsection">
                        <div class="fw-bold name" style="margin-top:30px;"><?=$resume['full_name']?></div>
                        <div>Mobile : <span class="mobile">+91 <?=$resume['mobile_no']?></span></div>
                        <div>Email : <span class="email"><?=$resume['email_id']?></span></div>
                        <div>Address : <span class="address"><?=$resume['address']?></span></div>
                        <div>Country Code : <span class="country_code"><?=$resume['country_code']?></span></div>
                        <hr>
                    </td>
                </tr>

                <tr class="objective-section zsection">
                    <td class="fw-bold align-top text-nowrap pr title">About Me</td>
                    <td class="pb-3 objective">
                    <?=$resume['about_me']?>
                    </td>
                </tr>

                <tr class="objective-section zsection">
                    <td class="fw-bold align-top text-nowrap pr title">Objective</td>
                    <td class="pb-3 objective">
                    <?=$resume['objective']?>
                    </td>
                </tr>

                

                <tr class="experience-section zsection">
                    <td class="fw-bold align-top text-nowrap pr title">Experience</td>
                    <td class="pb-3 experiences">

<?php
if($exps){
    foreach($exps as $exp){
    ?>
      <div class="experience mb-2">
                            <div class="fw-bold">- <span class="job-role"><?=$exp['position']?>
                            </div>
                            <div class="company"><?=$exp['company']?></div>
                            
                            <div class="work-description"><?=$exp['job_desc']?></div>
                            <div><span class="working-from"><?=$exp['started']?></span> – <span class="working-to"><?=$exp['ended']?></span></div>
                        </div>
    <?php
    }
}else{
    ?>
    <div class="experience mb-2">
                
                            <div class="company">I'am Fresher !!</div>
                
                        </div>
                        <?php
}
?>


                    </td>
                </tr>

                <tr class="education-section zsection">
                    <td class="fw-bold align-top text-nowrap pr title">Education</td>
                    <td class="pb-3 educations">

                    <?php
if($edus){
    foreach($edus as $edu){
    ?>
      <div class="education mb-2">
                            <div class="fw-bold">- <span class="course"><?=$edu['course']?></span></div>
                            <div class="institute"><?=$edu['institute']?></div>
                            <div><span class="working-from"><?=$edu['started']?></span> – <span class="working-to"><?=$edu['ended']?></span></div>
                        </div>
    <?php
    }
}else{
    ?>
    <div class="education mb-2">
                
                            <div class="institute">I Don't Have Any Education !!</div>
                
                        </div>
                        <?php
}
?>




                    </td>
                </tr>


<!-- achive -->
<tr class="education-section zsection">
                    <td class="fw-bold align-top text-nowrap pr title">Achievements</td>
                    <td class="pb-3 educations">

                    <?php
if($ache){
    foreach($ache as $ach){
    ?>
      <div class="education mb-2">
                            <div class="fw-bold">- <span class="course"><?=$ach['ach_title']?></span></div>
                            <div class="institute"><?=$ach['organization']?></div>
                            <div class="work-description"><?=$ach['ach_desc']?></div>
                        </div>
    <?php
    }
}else{
    ?>
    <div class="education mb-2">
                
                            <div class="institute">I Don't Have Any Achievements !!</div>
                
                        </div>
                        <?php
}
?>




                    </td>
                </tr>

<!--  -->

<!-- achive -->
<tr class="education-section zsection">
                    <td class="fw-bold align-top text-nowrap pr title">Projects</td>
                    <td class="pb-3 educations">

                    <?php
if($ache){
    foreach($proj as $prj){
    ?>
      <div class="education mb-2">
                            <div class="fw-bold">- <span class="course"><?=$prj['prj_title']?></span></div>
                            <div class="institute"><?=$prj['prj_role']?></div>
                            <div class="work-description"><?=$prj['prj_desc']?></div>
                        </div>
    <?php
    }
}else{
    ?>
    <div class="education mb-2">
                
                            <div class="institute">I Don't Have Any Projects !!</div>
                
                        </div>
                        <?php
}
?>




                    </td>
                </tr>

<!--  -->


                <tr class="skills-section zsection">
                    <td class="fw-bold align-top text-nowrap pr title">Skills</td>
                    <td class="pb-3 skills">
<?php
if($skills){
foreach($skills as $skill){
    ?>
    <div class="skill">- <?=$skill['skill']?> (<?=$skill['percentage']?> % Accuracy)</div>
    <?php
}
}else{
    ?>
<div class="skill">- I don't have skills</div>
    <?php
}
?>
                       

                    </td>
                </tr>

                <tr class="personal-details-section zsection">
                    <td class="fw-bold align-top text-nowrap pr title">Personal Details</td>
                    <td class="pb-3">
                        <table class="pd-table">
                            <tr>
                                <td>Date of Birth</td>
                                <td>: <span class="date-of-birth"><?=date('d F Y',strtotime($resume['dob']))?></span></td>
                            </tr>
                            <tr>
                                <td>Gender</td>
                                <td>: <span class="gender"><?=$resume['gender']?></span></td>
                            </tr>
                            <tr>
                                <td>Religion</td>
                                <td>: <span class="religion"><?=$resume['religion']?></span></td>
                            </tr>
                            <tr>
                                <td>Nationality</td>
                                <td>: <span class="nationality"><?=$resume['nationality']?></span></td>
                            </tr>
                            <tr>
                                <td>Marital Status</td>
                                <td>: <span class="marital-status"><?=$resume['marital_status']?></span></td>
                            </tr>
                            <tr>
                                <td>Hobbies</td>
                                <td>: <span class="hobbies"><?=$resume['hobbies']?></span></td>
                            </tr>

                        </table>

                    </td>
                </tr>

                <tr class="languages-known-section zsection">
                    <td class="fw-bold align-top text-nowrap pr title">Languages Known</td>
                    <td class="pb-3 languages">

                    <?=$resume['hobbies']?>
                    </td>
                </tr>

                <tr class="declaration-section zsection">
                    <td class="fw-bold align-top text-nowrap pr title">Declaration</td>
                    <td class="pb-5 declaration">
                        I hereby declare that above information is correct to the best of my
                        knowledge and can be supported by relevant documents as and when
                        required.
                    </td>
                </tr>
                
            </tbody>
        </table>
        <div class="d-flex justify-content-between">
                    <div class="px-3">Date : <?=date('d F, Y',$resume['updated_at'])?></div>
                    <div class="px-3 name text-end"><?=$resume['full_name']?></div>

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
        <option value="oo" <?=$resume['font']=='oo'?'selected':''?>>System Font</option>
        <option value="'Poppins', sans-serif" <?=$resume['font']=="'Poppins', sans-serif"?'selected':''?> style="font-family: 'Poppins', sans-serif;">'Poppins', sans-serif</option>
        <option value="'Playpen Sans', cursive" <?=$resume['font']== "'Playpen Sans', cursive" ?'selected':''?> style="font-family: 'Playpen Sans', cursive;">'Playpen Sans', cursive</option>
        <option value="'Dongle', sans-serif" <?=$resume['font']=="'Dongle', sans-serif" ?'selected':''?> style="font-family: 'Dongle', sans-serif;">'Dongle', sans-serif</option>
        <option value="'Akaya Kanadaka', system-ui" <?=$resume['font']=="'Akaya Kanadaka', system-ui" ?'selected':''?> style="font-family: 'Akaya Kanadaka', system-ui;">'Akaya Kanadaka', system-ui</option>
        <option value="'Playwrite DE Grund', cursive" <?=$resume['font']=="'Playwrite DE Grund', cursive" ?'selected':''?> style="font-family: 'Playwrite DE Grund', cursive;">'Playwrite DE Grund', cursive</option>
        <option value="'Playwrite AU NSW', cursive" <?=$resume['font']=="'Playwrite AU NSW', cursive" ?'selected':''?> style="font-family: 'Playwrite AU NSW', cursive;">'Playwrite AU NSW', cursive</option>
        <option value="'Kaushan Script', cursive" <?=$resume['font']== "'Kaushan Script', cursive"?'selected':''?> style="font-family: 'Kaushan Script', cursive;">'Kaushan Script', cursive</option>
        <option value="'Kalam', cursive" <?=$resume['font']=="'Kalam', cursive" ?'selected':''?> style="font-family: 'Kalam', cursive;">'Kalam', cursive</option>
        <option value="'Concert One', sans-serif" <?=$resume['font']=="'Concert One', sans-serif" ?'selected':''?> style="font-family: 'Concert One', sans-serif;">'Concert One', sans-serif</option>
        <option value="'Varela Round', sans-serif" <?=$resume['font']=="'Varela Round', sans-serif" ?'selected':''?> style="font-family: 'Varela Round', sans-serif;">'Varela Round', sans-serif</option>
        <option value="'Exo 2', sans-serif" <?=$resume['font']=="'Exo 2', sans-serif" ?'selected':''?> style="font-family: 'Exo 2', sans-serif;">'Exo 2', sans-serif</option>
        <option value="'Titillium Web', sans-serif" <?=$resume['font']=="'Titillium Web', sans-serif" ?'selected':''?> style="font-family: 'Titillium Web', sans-serif;">'Titillium Web', sans-serif</option>
        <option value="'Nunito Sans', sans-serif" <?=$resume['font']=="'Nunito Sans', sans-serif" ?'selected':''?> style="font-family: 'Nunito Sans', sans-serif;">'Nunito Sans', sans-serif</option>
        <option value="'Comfortaa', sans-serif" <?=$resume['font']=="'Comfortaa', sans-serif" ?'selected':''?> style="font-family: 'Comfortaa', sans-serif;">'Comfortaa', sans-serif</option>
        <option value="'Jost', sans-serif" <?=$resume['font']=="'Jost', sans-serif" ?'selected':''?> style="font-family: 'Jost', sans-serif;">'Jost', sans-serif</option>
        <option value="'Dosis', sans-serif" <?=$resume['font']== "'Dosis', sans-serif"?'selected':''?> style="font-family: 'Dosis', sans-serif;">'Dosis', sans-serif</option>
        <option value="'Josefin Sans', sans-serif" <?=$resume['font']=="'Josefin Sans', sans-serif" ?'selected':''?> style="font-family: 'Josefin Sans', sans-serif;">'Josefin Sans', sans-serif</option>
        <option value="'Fira Sans', sans-serif" <?=$resume['font']=="'Fira Sans', sans-serif" ?'selected':''?> style="font-family: 'Fira Sans', sans-serif;">'Fira Sans', sans-serif</option>
        <option value="'Raleway', sans-serif" <?=$resume['font']=="'Raleway', sans-serif" ?'selected':''?> style="font-family: 'Raleway', sans-serif;">'Raleway', sans-serif</option>
        <option value="'Montserrat', sans-serif" <?=$resume['font']== "'Montserrat', sans-serif"?'selected':''?> style="font-family: 'Montserrat', sans-serif;">'Montserrat', sans-serif</option>
        <option value="'Roboto', sans-serif" <?=$resume['font']== "'Roboto', sans-serif" ?'selected':''?> style="font-family: 'Roboto', sans-serif;">'Roboto', sans-serif</option>
        <option value="'Edu AU VIC WA NT Hand', cursive" <?=$resume['font']== "'Edu AU VIC WA NT Hand', cursive"?'selected':''?> style="font-family: 'Edu AU VIC WA NT Hand', cursive;">'Edu AU VIC WA NT Hand', cursive</option>
       
    </select>
  </div>
</div>




<div class="offcanvas offcanvas-bottom" tabindex="-1" id="background" style="height:50vh;" aria-labelledby="offcanvasBottomLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="offcanvasBottomLabel">Change Background</h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>

  <div class="offcanvas-body">
    <style>
      .tile{
        width : 100px;
        height: 100px;
        background-size: cover;
      }  
      .tile:hover{
        cursor: pointer;
        opacity: 0.7;
      }
    </style>
    <div class="d-flex w-100 gap-2 flex-wrap justify-content-center">
        <?php
        for($i=1;$i<22;$i++){
            ?>
            <div class="tile rounded shadow-sm border" data-background="tile<?=$i?>.png" style="background-image:url(./assets/images/tiles/tile<?=$i?>.png)"></div>
            <?php
        }
        ?>
<div class="tile rounded shadow-sm border" data-background="tile23.jpg" style=" background-image:url(./assets/images/tiles/tile23.jpg)"></div>
    
    </div>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
    <script src="https://unpkg.com/jspdf@latest/dist/jspdf.umd.min.js"></script>
<script>

$("#downloadpdf").click(function(){
            const { jsPDF } = window.jspdf;

            // Capture the page content
            html2canvas(document.querySelector('.page')).then(canvas => {
                var imgData = canvas.toDataURL('image/png');
                var doc = new jsPDF();

                // Add the image to the PDF
                doc.addImage(imgData, 'PNG', 10, 10, 190, 0);
                var fullName = '<?= $resume['full_name'] ?>';
                var resumeTitle = '<?= $resume['resume_title'] ?>';
                doc.save(`${fullName} - ${resumeTitle}.pdf`);
            });
        });


    $('#font').change(function() {
        let font = $(this).find(":selected").val();
        $(".page").css('font-family',font);
        
        $.ajax({
            url:'actions/changefont.action.php',
            method:'post',
            data:{
                resume_id: <?=@$resume['id']?>,
                font: font
            },
            success:function(res){
                console.log(res);
            },
            error:function(res){
                console.log(res);
                alert('Font is not Updated !!!')
            }
        })
    })

    $('.tile').click(function() {
        let tile = $(this).data('background');
        $("body").css('background-image','url(./assets/images/tiles/'+tile+')');
        
        $.ajax({
            url:'actions/changeback.action.php',
            method:'post',
            data:{
                resume_id: <?=@$resume['id']?>,
                background: tile
            },
            success:function(res){
                console.log(res);
            },
            error:function(res){
                console.log(res);
                alert('Background is not Updated !!!')
            }
        })
    })

    $("#print").click(function(){
        $(".extra").hide();
        window.print();
        setTimeout(()=>{
            $(".extra").show();
        },500)
    })
</script>




</body>
</html>