<?php

require '../assets/class/database.class.php';
require '../assets/class/function.class.php';

if($_GET){

$post = $_GET;

// echo "<pre>";
// print_r($post);



if($post['exp_id'] && $post['resume_id']){

try{
    $query = "DELETE FROM experiences WHERE exp_id={$post['exp_id']} AND resume_id={$post['resume_id']}";


$db->query($query);



$fn->setAlert('Experience Deleted Successfully !!');
$fn->redirect('../updateresume.php?resume='.$post['slug']);

}catch(Exception $error){
    $fn->setError($error->getMessage());
    $fn->redirect('../updateresume.php?resume='.$post['slug']);
}


}else{
    $fn->setError('Please Fill The Form !!');
    $fn->redirect('../updateresume.php?resume='.$post['slug']);
}

}else{
    $fn->redirect('../updateresume.php?resume='.$post['slug']);
}

?>