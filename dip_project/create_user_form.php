<?php session_start();
require 'functions.php';

if(is_not_logged_in() and is_not_admin()) {
    redirect_to('page_login.php');
}

$email = $_POST['email'];
$password = $_POST['password'];


$user_id = add_user($email, $password);


$name = $_POST["name"];
$profession = $_POST["company"];
$tel = $_POST["tel"];
$address = $_POST["address"];

add_user_information($user_id, $name, $profession, $email, $tel, $address);

$status = $_POST["status"];

set_status($user_id, $status);


$image = $_FILES['image'];

if(empty($_FILES['image']['name'])) {
    zaglushka_na_avatar($user_id);
} else {
    upload_avatar($user_id, $_FILES['image']);
}



set_flash_message('success','Профиль успешно добавлен.');
redirect_to('users.php');