<?php session_start();
require 'functions.php';

$login = $_POST['login'];
$password = $_POST['password'];



if(login($login, $password)){
    redirect_to('users.php');
    //add_auth_user_to_session()
} else {

    redirect_to('page_login.php');
}



/*$hash = '';

if(password_verify($password,$hash)) {
    header('Location: ');
    exit();
} else {
    header('Location: ');
    exit();
}*/