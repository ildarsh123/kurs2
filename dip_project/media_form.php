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




delete_image($_GET['id']);

$image = $_FILES['image'];

if(empty($_FILES['image']['name'])) {
    zaglushka_na_avatar($_GET['id']);
} else {
    upload_avatar($_GET['id'], $_FILES['image']);
}



set_flash_message('success','рисунок обновлен');
redirect_to('page_profile.php?id='.$_GET['id']);