<?php
/**
Parameters:
   string - email

   Description: поиск пользователя no эл. адресу

   Return value: array
**/

function get_user_by_email($email) {
    $host = 'localhost';
    $username = 'root';
    $pass = '';
    $dbname = 'test';

    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $pass);
    $sql = "SELECT * FROM users WHERE email = :email";
    $statement = $pdo->prepare($sql);
    $statement->execute(['email' => $email]);
    $user = $statement->fetch(PDO::FETCH_ASSOC);

    return $user;

}

/**
    Parameters:
        string - email
        string - password
 *
    Description: добавить пользователя в БД
 *
    Return value: int (user_id)
 **/
function add_user($email, $password) {

    $hashedpassword = password_hash($password, PASSWORD_DEFAULT);

    $host = 'localhost';
    $username = 'root';
    $pass = '';
    $dbname = 'test';
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $pass);

    $sql = "INSERT INTO users (email, password) VALUES (:email, :hashedpassword)";
    $statement = $pdo->prepare($sql);
    $statement->execute(['email' => $email,'hashedpassword' => $hashedpassword]);

    $user = get_user_by_email($email);
    return $user['id'];
}

/**
   Parameters:
      string - $type (ключ) тип сообщения
      string - $message (значение, текст сообщения)
 *
   Description: подготовить флеш сообщение
 *
   Return value: null
 **/
function  set_flash_message($type, $message) {
    $_SESSION[$type] = $message;
}


/**
   Parameters:
      string - $name (ключ)
 *
   Description: вывести флеш сообщение
 *
   Return value: null
•*/
function display_flash_message($name) {

    if(isset($_SESSION[$name])) {
        echo "<div class=\"alert alert-{$name} text-dark\" role=\"alert\">{$_SESSION[$name]}</div>";
        unset($_SESSION[$name] );

    }

}


/**
    Parameters:
        string - $path
 *
    Description: перенаправить на другую страницу
**/
function redirect_to($path) {
    header("Location: {$path}");
    exit;
}


/**
    * Parameters:
         string - $email
         string - $password
    *Description: авторизовать пользователя, добавляет пользователя в сессию
    * Return value: boolean
 **/

function login($email, $password) {
    $user = get_user_by_email($email);
    if(empty($user)){
        set_flash_message('danger','Неверный логин или пароль');
        return false;
    }

    if(empty($password)){
        set_flash_message('danger','Неверный логин или пароль');
        return false;
    }

    if(password_verify($password,$user['password'])) {
        $_SESSION['user'] = $user;
        return true;
    } else {
        set_flash_message('danger','Неверный логин или пароль');
        return false;
    }

};

/**
 * Parameters:
 *Description: Проверяет зарегистрированный ли пользователь на странице
 * Return value: boolean
 **/
function is_logged_in() {
     if(isset($_SESSION['user'])){
         return true;
     }

     return false;
}

/**
 * Parameters:
 *Description: Проверяет зарегистрированный ли пользователь на странице
 * Return value: boolean
 **/
function is_not_logged_in() {
    return !is_logged_in();
}


function get_users() {
    $host = 'localhost';
    $user = 'root';
    $dbname = 'test';
    $pass = '';

    $pdo = new PDO("mysql:host=$host;dbname=$dbname",$user ,$pass);
    $sql = "SELECT * FROM user_data ";
    $statement = $pdo->query($sql);
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}

/**
 * Parameters:
 *Description: Получить авторизованного пользователя
 * Return value: array
 **/
function get_authenticated_user() {
    if(is_logged_in()){
        return $_SESSION['user'];
    }

    return false;
}


function is_admin($user) {
    if(is_logged_in()) {
        if($user['role'] === 'admin') {
            return true;
        }

        return false;
    }
}

function is_not_admin($user) {
    return !is_admin($user);
}

function is_equal($user, $current_user) {
    if($user['id'] == $current_user['id']) {
        return true;
    }

    return false;
}


/**
 * Parameters:
          $username  string
          $job_title string
          $phone     string
          $address   string
 *Description: редактировать пользователя
 * Return value: boolean
 **/

function add_user_information($user_id, $name, $profession, $email, $tel, $address) {

    $host = 'localhost';
    $username = 'root';
    $pass = '';
    $dbname = 'test';
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $pass);

    $sql = "INSERT INTO user_data (user_id, name, profession, tel, email, address) VALUES (:user_id, :name, :profession, :tel, :email, :address)";
    $statement = $pdo->prepare($sql);
    $statement->execute(['user_id' => $user_id,'name' => $name,'profession' => $profession,'tel' => $tel,'email' => $email,'address' => $address]);

}


/**
 * Parameters: $status  string
 *Description: установить статус
 * Return value: null
 **/

function set_status($user_id, $status) {
    $host = 'localhost';
    $username = 'root';
    $pass = '';
    $dbname = 'test';
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $pass);

    $sql = "UPDATE user_data SET status = :status WHERE user_id = :user_id";
    $statement = $pdo->prepare($sql);
    $statement->execute(['user_id' => $user_id,'status' => $status]);
}

/**
 * Parameters: $image array

 *Description: загрузить аватар
 * Return value: null | string (path)
 **/

function upload_avatar($user_id,$image)
{
    $prefix = strval(random_int(123, 999));
    $uniqid = uniqid($prefix);


    $path = 'img/demo/avatars/';
    $uploaddir = $path . $uniqid . $image['name'];


    $host = 'localhost'; // имя хоста
    $username = 'root';      // имя пользователя
    $pass = '';          // пароль
    $dbname = 'test';      // имя базы данных

    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $pass);


    if (move_uploaded_file($image['tmp_name'], $uploaddir)) {
        $title = $uniqid . $image['name'];
        $sql = "UPDATE user_data SET image = :title WHERE user_id = :user_id";
        $statement = $pdo->prepare($sql);
        $statement->execute(['user_id' => $user_id,'title' => $title]);
    }
}


function zaglushka_na_avatar($user_id) {
    $path = "avatar-m.png";


    $host = 'localhost'; // имя хоста
    $username = 'root';      // имя пользователя
    $pass = '';          // пароль
    $dbname = 'test';      // имя базы данных

    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $pass);



        $title = $path;
        $sql = "UPDATE user_data SET image = :title WHERE user_id = :user_id";
        $statement = $pdo->prepare($sql);
        $statement->execute(['user_id' => $user_id,'title' => $title]);
}
/**
 * Parameters:
        $telegram  string
        $instagram string
        $vk        string

 *Description: добавить ссылки на соц.сети
 * Return value: null
 **/

function add_social_links($telegram, $instagram, $vk) {}


function get_user_data_by_id($id) {
    $host = 'localhost';
    $username = 'root';
    $pass = '';
    $dbname = 'test';

    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $pass);
    $sql = "SELECT * FROM user_data WHERE user_id = :id";
    $statement = $pdo->prepare($sql);
    $statement->execute(['id' => $id]);
    $user = $statement->fetch(PDO::FETCH_ASSOC);

    return $user;

}


function edit_user_information($user_id, $name, $profession, $email, $tel, $address) {

$host = 'localhost';
    $username = 'root';
    $pass = '';
    $dbname = 'test';
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $pass);

    $sql = "UPDATE user_data SET name = :name, profession = :profession, tel = :tel, email = :email, address = :address WHERE user_id = :user_id";
    $statement = $pdo->prepare($sql);
    $statement->execute(['user_id' => $user_id,'name' => $name,'profession' => $profession,'tel' => $tel,'email' => $email,'address' => $address]);

}


function update_user_security($email, $password, $user_id) {

    $hashedpassword = password_hash($password, PASSWORD_DEFAULT);

    $host = 'localhost';
    $username = 'root';
    $pass = '';
    $dbname = 'test';
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $pass);
    //
    $sql = "UPDATE users SET email = :email, password =:hashedpassword WHERE id = :id";
    $statement = $pdo->prepare($sql);
    $statement->execute(['email' => $email,'hashedpassword' => $hashedpassword, 'id' => $user_id]);

    $sql = "UPDATE user_data SET email = :email WHERE user_id = :id";
    $statement = $pdo->prepare($sql);
    $statement->execute(['email' => $email, 'id' => $user_id]);

    $user = get_user_by_email($email);
    return $user['id'];
}


function delete_user($user_id) {



    $host = 'localhost';
    $username = 'root';
    $pass = '';
    $dbname = 'test';
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $pass);
    //
    $sql = "DELETE FROM users WHERE id = :id";
    $statement = $pdo->prepare($sql);
    $statement->execute(['id' => $user_id]);

    $sql = "DELETE FROM user_data  WHERE user_id = :id";
    $statement = $pdo->prepare($sql);
    $statement->execute(['id' => $user_id]);

    return true;
}


function get_status($id) {
    $host = 'localhost';
    $username = 'root';
    $pass = '';
    $dbname = 'test';

    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $pass);
    $sql = "SELECT status  FROM user_data WHERE user_id = :id";
    $statement = $pdo->prepare($sql);
    $statement->execute(['id' => $id]);
    $status = $statement->fetch(PDO::FETCH_ASSOC);

    return $status;
}

function nav_bar()
{  echo '  <nav class="navbar navbar-expand-lg navbar-dark bg-primary bg-primary-gradient" >
        <a class="navbar-brand d-flex align-items-center fw-500" href = "users.php" ><img alt = "logo" class="d-inline-block align-top mr-2" src = "img/logo.png" > Учебный проект </a > <button aria - controls = "navbarColor02" aria - expanded = "false" aria - label = "Toggle navigation" class="navbar-toggler" data - target = "#navbarColor02" data - toggle = "collapse" type = "button" ><span class="navbar-toggler-icon" ></span ></button >
        <div class="collapse navbar-collapse" id = "navbarColor02" >
            <ul class="navbar-nav mr-auto" >
                <li class="nav-item" >
                    <a class="nav-link" href = "users.php" > Главная <span class="sr-only" > (current)</span ></a >
                </li >
            </ul >
            <ul class="navbar-nav ml-auto" >
                <li class="nav-item" >
                    <a class="nav-link" href = "page_login.php" > Войти</a >
                </li >
                <li class="nav-item" >
                    <a class="nav-link" href = "logout.php" > Выйти</a >
                </li >
            </ul >
        </div >
    </nav > ';
    }


function delete_image($user_id) {



    $host = 'localhost';
    $username = 'root';
    $pass = '';
    $dbname = 'test';
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $pass);


    $sql = "SELECT image  FROM user_data WHERE user_id = :id";
    $statement = $pdo->prepare($sql);
    $statement->execute(['id' => $user_id]);
    $image = $statement->fetch(PDO::FETCH_ASSOC);

    $path = 'img/demo/avatars/';
    if ($image['image'] != 'avatar-m') {
        if (file_exists($path . $image['image'])) {
            unlink($path . $image['image']);
    }
    }
    $sql = "UPDATE user_data SET image = NULL WHERE user_id = :id";

    $statement = $pdo->prepare($sql);
    $statement->execute(['id' => $user_id]);

    return true;
}