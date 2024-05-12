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