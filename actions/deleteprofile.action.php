<?php

require '../assets/class/database.class.php';
require '../assets/class/function.class.php';

if($_GET){

$post = $_GET;
$post2 = $_POST;

// echo "<pre>";
// print_r($post);


if($post['slug'] && $post['prf_id']){

$slug = $post['slug'];
$authid =$fn->Auth()['usr_id'];
$prfID = $post['prf_id'];

try{
    $query = "UPDATE profiles SET status = 1 WHERE (user_id=$authid AND slug='$slug' AND prf_id=$prfID);";
   
    $db->query($query);

$fn->setAlert('Profile Deleted Successfully !!');
$fn->redirect('../myresumes.php?slug='.$slug);

}catch(Exception $error){
    $fn->setError($error->getMessage());
    $fn->redirect('../updateprofile.php?slug='.$slug);
}


}else{
    $fn->setError('Please Fill The Form !!');
    $fn->redirect('../updateprofile.php?slug='.$slug);
}

}else{
    $fn->redirect('../updateresume.php?slug='.$slug);
}

?>