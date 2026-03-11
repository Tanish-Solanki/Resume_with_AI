<?php

require '../assets/class/database.class.php';
require '../assets/class/function.class.php';

if($_POST){
$post = $_POST;

if($post['otp']){

    $otp = $post['otp'];
if($fn->getSession('otp')==$otp){

    $fn->setAlert('Email is Verified !!');
    $fn->redirect('../change-password.php');
}else{
    $fn->setError('Incorrect OTP Entered !!!');
    $fn->redirect('../verification.php');
}


}else{
    $fn->setError('Please Enter 6 Digit Code Sended to your email id !!');
    $fn->redirect('../verification.php');
}

}else{
    $fn->redirect('../verification.php');
}

?>