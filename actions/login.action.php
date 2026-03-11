<?php

require '../assets/class/database.class.php';
require '../assets/class/function.class.php';

if ($_POST) {
    $post = $_POST;

    if (!empty($post['email_id']) && !empty($post['password'])) {
        $email_id = $db->real_escape_string($post['email_id']);
        $password = md5($db->real_escape_string($post['password']));

        $result = $db->query("SELECT usr_id, full_name, status FROM users WHERE email_id='$email_id' AND password='$password'");
        $user = $result->fetch_assoc();

        if ($user) {
            $authid = $user['usr_id'];

            // Update the user status to 0 (active)
            $query = "UPDATE users SET status = 0 WHERE usr_id = $authid";
            $db->query($query);

            // Update the associated records status to 0 (active)
            $query2 = "
                UPDATE resumes
                LEFT JOIN skills ON resumes.user_id = skills.user_id
                LEFT JOIN education ON resumes.user_id = education.user_id
                LEFT JOIN experiences ON resumes.user_id = experiences.user_id
                LEFT JOIN achivements ON resumes.user_id = achivements.user_id
                LEFT JOIN projects ON resumes.user_id = projects.user_id
                LEFT JOIN profiles ON resumes.user_id = profiles.user_id
                SET resumes.usr_status = 0,
                    skills.usr_status = 0,
                    education.usr_status = 0,
                    experiences.usr_status = 0,
                    achivements.usr_status = 0,
                    projects.usr_status = 0,
                    profiles.usr_status = 0
                WHERE resumes.user_id = $authid;
            ";
            $db->query($query2);

            // Set authentication and redirect to myresumes.php
            $fn->setAuth($user);
            $fn->setAlert('Logged In !!!');
            $fn->redirect('../myresumes.php');
        } else {
            // Incorrect email or password
            $fn->setError('Incorrect Email Id or Password');
            $fn->redirect('../login.php');
        }
    } else {
        // Form fields are empty
        $fn->setError('Please Fill The Form !!');
        $fn->redirect('../login.php');
    }
} else {
    // No POST data received, redirect to login
    $fn->redirect('../login.php');
}
?>
