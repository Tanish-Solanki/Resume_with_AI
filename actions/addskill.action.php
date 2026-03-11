<?php

require '../assets/class/database.class.php';
require '../assets/class/function.class.php';

if($_POST){

$post = $_POST;

// echo "<pre>";
// print_r($post);

if($post['resume_id'] && $post['skill']){

    $resumeid = array_shift($post);
    $post2 = $post;
    unset($post['slug']);

$columns = '';
$values = '';
foreach($post as $index=>$value){
    $value=$db->real_escape_string($value);
    $columns.= $index.',';
    $values .= "'$value',";
}

$authid = $fn->Auth()['usr_id'];


$columns.= 'resume_id, created_at, updated_at,user_id';
$values.= "$resumeid,".time().",".time().",".$authid;


// $full_name = $db->real_escape_string($post['full_name']);
// $email_id = $db->real_escape_string($post['email_id']);
// $password = md5($db->real_escape_string($post['password']));

try{
    $query = "INSERT INTO skills";
    $query.= "($columns) ";
    $query.= "VALUES($values)";

   

$db->query($query);

$fn->setAlert('Skill Added Successfully !!');
$fn->redirect('../updateresume.php?resume='.$post2['slug']);

}catch(Exception $error){
    $fn->setError($error->getMessage());
    $fn->redirect('../updateresume.php?resume='.$post2['slug']);
}


}else{
    $fn->setError('Please Fill The Form !!');
    $fn->redirect('../updateresume.php?resume='.$post2['slug']);
}

}else{
    $fn->redirect('../updateresume.php?resume='.$post2['slug']);
}

?>