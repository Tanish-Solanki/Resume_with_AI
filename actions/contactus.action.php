<?php

require '../assets/class/database.class.php';
require '../assets/class/function.class.php';

if($_POST){

$post = $_POST;

// echo "<pre>";
// print_r($post);



if($post['full_name'] && $post['email_id'] && $post['message']){


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
    $query = "INSERT INTO contact_us";
    $query.= "($columns) ";
    $query.= "VALUES($values)";


$db->query($query);

$fn->setAlert('Contact Recorded Successfully !!');
$fn->redirect('../index.php#contact');

}catch(Exception $error){
    $fn->setError($error->getMessage());
    $fn->redirect('../index.php#contact');
}


}else{
    $fn->setError('Please Fill The Form !!');
    $fn->redirect('../index.php#contact');
}

}else{
    $fn->redirect('../index.php#contact');
}

?>