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

$user_id = $_GET['id'];

delete_user($user_id);

if(is_equal($selected_user,get_authenticated_user())) {

    redirect_to('logout.php');

} else {
    set_flash_message('success','Пользователь удален');
    redirect_to('users.php');
}