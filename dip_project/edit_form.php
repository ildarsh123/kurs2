<?php session_start();
require 'functions.php';

$user_id = $_GET['id'];
$name = $_POST["name"];
$profession = $_POST["profession"];
$tel = $_POST["tel"];
$address = $_POST["address"];

$email = get_user_data_by_id($user_id)['email'];

edit_user_information($user_id, $name, $profession, $email, $tel, $address);





set_flash_message('success','Профиль успешно обновлен.');
redirect_to('users.php');