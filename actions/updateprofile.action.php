<?php
require '../assets/class/database.class.php';
require '../assets/class/function.class.php';

if ($_POST) {
    $post = $_POST;

    if ($post['full_name'] && $post['email_id'] && $post['old_password']) {
        $full_name = $db->real_escape_string($post['full_name']);
        $email_id = $db->real_escape_string($post['email_id']);
        $old_password = md5($db->real_escape_string($post['old_password']));
        $new_password = $db->real_escape_string($post['password']);
        $authid = $fn->Auth()['usr_id'];

        // Verify old password
        $result = $db->query("SELECT password FROM users WHERE usr_id=$authid");
        $user = $result->fetch_assoc();

        if ($user['password'] !== $old_password) {
            $fn->setError('Old password is incorrect!');
            $fn->redirect('../myresumes.php');
            die();
        }

        // Check if email is already registered to another user
        $result = $db->query("SELECT COUNT(*) as user FROM users WHERE email_id='$email_id' AND usr_id!=$authid");
        $result = $result->fetch_assoc();

        if ($result['user']) {
            $fn->setError($email_id . ' is already registered!');
            $fn->redirect('../myresumes.php');
            die();
        }

        // Update user details
        if ($new_password !== '') {
            $new_password = md5($new_password);
            $db->query("UPDATE users SET full_name='$full_name', email_id='$email_id', password='$new_password' WHERE usr_id=$authid");
        } else {
            $db->query("UPDATE users SET full_name='$full_name', email_id='$email_id' WHERE usr_id=$authid");
        }

        $fn->setAlert('Account Updated Successfully !!');
        $fn->redirect('../myresumes.php');
    } else {
        $fn->setError('Please fill the form completely!');
        $fn->redirect('../myresumes.php');
    }
} else {
    $fn->redirect('../myresumes.php');
}
?>
