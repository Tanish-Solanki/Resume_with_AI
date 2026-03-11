<?php

require '../assets/class/database.class.php';
require '../assets/class/function.class.php';

if($_POST){

$post = $_POST;



if($post['full_name'] && $post['email_id'] && $post['objective'] && $post['mobile_no'] && $post['dob'] && $post['gender'] && $post['religion'] && $post['nationality'] && $post['marital_status'] && $post['hobbies'] && $post['languages'] && $post['address'] && $post['country_code'] && $post['about_me'] && $post['profession']){


$columns = '';
$values = '';
foreach($post as $index=>$value){
    $value=$db->real_escape_string($value);
    $columns.= $index.',';
    $values .= "'$value',";
}
$authid = $fn->Auth()['usr_id'];

// $full_name = $db->real_escape_string($post['full_name']);
// $email_id = $db->real_escape_string($post['email_id']);
// $password = md5($db->real_escape_string($post['password']));

$columns .= 'slug,created_at,updated_at,user_id';
$values .= "'".$fn->randomstring()."',".time().",".time().",".$authid;



try{
    $query = "INSERT INTO profiles";
    $query.= "($columns) ";
    $query.= "VALUES($values)";


$db->query($query);

$fn->setAlert('Profile Added Successfully !!');
$fn->redirect('../myresumes.php');


}catch(Exception $error){


    $fn->setError($error->getMessage());
    $fn->redirect('../createresume.php');
}


}else{
    $fn->setError('Please Fill The Form !!');
    $fn->redirect('../createresume.php');
}

}else{
    $fn->redirect('../createresume.php');
}

?>