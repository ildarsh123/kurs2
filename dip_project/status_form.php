<?php session_start();

require 'functions.php';

if(is_not_logged_in()) {
    redirect_to('page_login.php');
}

$selected_user['id'] = $_GET['id'];
if(is_not_admin(get_authenticated_user())) {
    if(!is_equal($selected_user,get_authenticated_user())) {
        set_flash_message('danger', 'Редактировать можно только свой профиль');
        redirect_to('users.php');
    }
}


$status_old = get_status($_GET['id']);
if($_POST['status'] == $status_old['status'])
{
    set_flash_message('success','Статус установлен');
    redirect_to('page_profile.php?id='.$_GET['id']);
} else {
    set_status($_GET['id'], $_POST['status']);
    set_flash_message('success','Статус установлен');
    redirect_to('page_profile.php?id='.$_GET['id']);
}