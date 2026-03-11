<?php

require '../assets/class/database.class.php';
require '../assets/class/function.class.php';

if($_POST){

$post = $_POST;

// echo "<pre>";
// print_r($post);


if($post['prf_id'] && $post['slug'] && $post['full_name'] && $post['email_id'] && $post['objective'] && $post['mobile_no'] && $post['dob'] && $post['gender'] && $post['religion'] && $post['nationality'] && $post['marital_status'] && $post['hobbies'] && $post['languages'] && $post['address'] && $post['country_code']  && $post['about_me'] && $post['profession']){

$columns = '';
$values = '';
$post2=$post;
unset($post2['prf_id']);
unset($post2['slug']);
foreach($post2 as $index=>$value){
    $value=$db->real_escape_string($value);
    $columns.= $index."='$value',";
   
}

$columns.='updated_at='.time();


try{
    $query = "UPDATE profiles SET ";
    $query.= "$columns ";
    $query.= "WHERE prf_id={$post['prf_id']} AND slug='{$post['slug']}'";



$db->query($query);

$fn->setAlert('Profile Updated Successfully !!');
$fn->redirect('../updateprofile.php?resume='.$post['slug']);

}catch(Exception $error){
    $fn->setError($error->getMessage());
    $fn->redirect('../updateprofile.php?resume='.$post['slug']);
}


}else{
    $fn->setError('Please Fill The Form !!');
    $fn->redirect('../updateprofile.php?resume='.$post['slug']);
}

}else{
    $fn->redirect('../updateprofile.php?resume='.$post['slug']);
}

?>