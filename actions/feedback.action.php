<?php

require '../assets/class/database.class.php';
require '../assets/class/function.class.php';

if($_POST){

$post = $_POST;

// echo "<pre>";
// print_r($post);


if($post['full_name'] && $post['email_id'] && $post['feedback']){


$columns = '';
$values = '';
foreach($post as $index=>$value){
    $value=$db->real_escape_string($value);
    $columns.= $index.',';
    $values .= "'$value',";
}


$columns.= 'created_at';
$values.= time();


// $full_name = $db->real_escape_string($post['full_name']);
// $email_id = $db->real_escape_string($post['email_id']);
// $password = md5($db->real_escape_string($post['password']));

try{
    $query = "INSERT INTO feedback";
    $query.= "($columns) ";
    $query.= "VALUES($values)";

    // echo $query;
    // die();

$db->query($query);

$fn->setAlert('Feedback Recorded Successfully !!');
$fn->redirect('../index.php#feedback');

}catch(Exception $error){
    $fn->setError($error->getMessage());
    $fn->redirect('../index.php#feedback');
}


}else{
    $fn->setError('Please Fill The Form !!');
    $fn->redirect('../index.php#feedback');
}

}else{
    $fn->redirect('../index.php#feedback');
}

?>