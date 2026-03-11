<?php

require '../assets/class/database.class.php';
require '../assets/class/function.class.php';

if ($_GET) {

    $post = $_GET;

    if ($post['id']) {
        $authid = $fn->Auth()['usr_id'];

        try {
            // Update the status to 1 (deleted)
            $query = "
                UPDATE resumes
                LEFT JOIN skills ON resumes.id = skills.resume_id
                LEFT JOIN education ON resumes.id = education.resume_id
                LEFT JOIN experiences ON resumes.id = experiences.resume_id
                LEFT JOIN achivements ON resumes.id = achivements.resume_id
                LEFT JOIN projects ON resumes.id = projects.resume_id
                SET resumes.status = 1,
                    skills.status = 1,
                    education.status = 1,
                    experiences.status = 1,
                    achivements.status = 1,
                    projects.status = 1
                WHERE resumes.id = {$post['id']} AND resumes.user_id = $authid;
            ";
            
            $db->query($query);

            $fn->setAlert('Resume Deleted Successfully !!');
            $fn->redirect('../myresumes.php');

        } catch (Exception $error) {
            
            $fn->setError($error->getMessage());
            $fn->redirect('../myresumes.php');
        }

    } else {
        $fn->setError('Please Fill The Form !!');
        $fn->redirect('../myresumes.php');
    }

} else {
    $fn->redirect('../myresumes.php');
}

?>
