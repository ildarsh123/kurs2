<?php session_start();

require 'functions.php';

if(is_not_logged_in()) {
    redirect_to('page_login.php');
}


$selected_user['id'] = $_GET['id'];
if(is_not_admin(get_authenticated_user())) {
    if(!is_equal($selected_user,get_authenticated_user())) {
        set_flash_message('danger','Редактировать можно только свой профиль');
        redirect_to('users.php');
    }
}

$email = $_POST['email'];
$password = $_POST['password'];
$password2 = $_POST['password2'];
$user = get_user_by_email($email);


$path = "security.php?id=47";
if(!empty($user)) {
    set_flash_message('danger', 'Этот эл. адрес уже занят другим пользователем');
    redirect_to($path);

}

if($password2 !== $password) {
    set_flash_message('danger', 'Пароли не совпадают');
    redirect_to($path);

}

$user_id = update_user_security($email, $password, $_GET['id']);
if(!empty($user_id)) {
    set_flash_message('success', 'Данные успешно изменены');
    redirect_to($path);
}