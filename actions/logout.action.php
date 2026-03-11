<?php

require '../assets/class/database.class.php';
require '../assets/class/function.class.php';

$authid = $fn->Auth()['usr_id'];


if (isset($authid)) {

    $query = "UPDATE users SET status = 1 WHERE usr_id = $authid";
    $query2 = "
                UPDATE resumes
                LEFT JOIN skills ON resumes.user_id = skills.user_id
                LEFT JOIN education ON resumes.user_id = education.user_id
                LEFT JOIN experiences ON resumes.user_id = experiences.user_id
                LEFT JOIN achivements ON resumes.user_id = achivements.user_id
                LEFT JOIN projects ON resumes.user_id = projects.user_id
                LEFT JOIN profiles ON resumes.user_id = profiles.user_id
                
                SET resumes.usr_status = 1,
                    skills.usr_status = 1,
                    education.usr_status = 1,
                    experiences.usr_status = 1,
                    achivements.usr_status = 1,
                    projects.usr_status = 1,
                    profiles.usr_status = 1
                WHERE resumes.user_id = $authid;
            ";
            
   
    if ($db->query($query) && $db->query($query2) === TRUE) {
  
        $fn->setAlert('Log Out Permitted !!');
    } else {
        
        $fn->setError("Failed to update the status.");
       
        $fn->redirect('../myresumes.php');
        exit();
    }
} else {
    $fn->setError("User is not logged in.");

    $fn->redirect('../index.php');
    exit();
}

session_destroy();

echo "<!DOCTYPE html>
<html>
<head>
    <title>Logout</title>
    <!-- Include SweetAlert CSS and JS -->
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css'>
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
</head>
<body>
    <script>
        let timerInterval;
        Swal.fire({
            title: 'Log Out Permitted !!',
            html: 'This alert will close in <b></b> seconds.',
            timer: 1750, // Alert will auto-close after this seconds
            timerProgressBar: true,
            didOpen: () => {
                Swal.showLoading();
                const timer = Swal.getPopup().querySelector('b');
                timerInterval = setInterval(() => {
                    // Update countdown timer
                    const timeLeft = Math.max(0, Math.ceil(Swal.getTimerLeft() / 1000));
                    timer.textContent = timeLeft;
                }, 100); // Update every 100 milliseconds
            },
            willClose: () => {
                clearInterval(timerInterval);
            }
        }).then((result) => {
            if (result.dismiss === Swal.DismissReason.timer) {
                // Redirect after the alert closes
                window.location.href = '../index.php';
            }
        });
    </script>
</body>
</html>";

exit();
?>
