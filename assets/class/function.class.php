<?php
session_start();

class Functions {
    public function redirect($address) {
        header("Location: " . $address);
        exit();
    }

    public function setError($msg) {
        $_SESSION['error'] = $msg;
    }

    public function setAuth($data) {
        $_SESSION['Auth'] = $data;
    }

    public function Auth(){
        if(isset($_SESSION['Auth'])){
            return $_SESSION['Auth'];
        }else{
            return false;
        }
    }

    public function error() {
        if (isset($_SESSION['error']) && !empty($_SESSION['error'])) {
            echo "Swal.fire({
                title: 'Error',
                text: '" . $_SESSION['error'] . "',
                icon: 'error'
            });";
            unset($_SESSION['error']); // Clear error after displaying
        }
    }


    public function setAlert($msg) {
        $_SESSION['alert'] = $msg;
    }

    public function alert() {
        if (isset($_SESSION['alert']) && !empty($_SESSION['alert'])) {
            echo "Swal.fire({
                title: 'Success',
                text: '" . $_SESSION['alert'] . "',
                icon: 'success'
            });";
            unset($_SESSION['alert']); // Clear alert after displaying
        }
    }

    

    public function setWarning($msg) {
        $_SESSION['warning'] = $msg;
    }
    
    public function warning() {
        if (isset($_SESSION['warning']) && !empty($_SESSION['warning'])) {
            echo "Swal.fire({
                title: '404 Not Found !!!',
                text: '" . $_SESSION['warning'] . "',
                icon: 'warning'
            });";
            unset($_SESSION['warning']); // Clear alert after displaying
        }
    }

    public function setMessage($msg) {
        $_SESSION['message'] = $msg;
    }
    
    public function message() {
        if (isset($_SESSION['message']) && !empty($_SESSION['message'])) {
            echo "Swal.fire('" . $_SESSION['message'] . "');";
            unset($_SESSION['message']); // Clear alert after displaying
        }
    }


    

    public function setSession($key, $value){
        $_SESSION[$key] = $value;
    }

    public function getSession($key){
        return $_SESSION[$key] ?? '';
    }

    public function authpage(){
        if(!isset($_SESSION['Auth'])){
            $this->redirect('login.php');
        }
    }

    public function nonAuthpage(){
        if(isset($_SESSION['Auth'])){
            $this->redirect('myresumes.php');
        }
    }

    public function randomstring(){
        $string = "0123456789abcdefgijklmnopqrstuvwxyz_" . time() . rand(1111, 2222333);
        $string = str_shuffle($string);
        return str_split($string, 16)[0];
    }
    
}

$fn = new Functions();
