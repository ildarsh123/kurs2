<?php session_start();

$email = $_POST['email'];
$password = $_POST['password'];

//1. если одно из полей маил или пароль незаполнен то выведем сообщение неверный логин или пароль

if (empty($email) or empty($password)) {
    $_SESSION['alert'] = 'Неверный логин или пароль';
    header('Location: task_15.php');
    exit();
}


$host = 'localhost'; // имя хоста
$username = 'root';      // имя пользователя
$pass = '';          // пароль
$dbname = 'test';      // имя базы данных

$pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $pass);

//2. Нужно получить пользователя по эл. адресу

$sql = "SELECT * FROM users WHERE email = :email";
$statement = $pdo->prepare($sql);
$statement->execute(['email' => $email]);
$user = $statement->fetch(PDO::FETCH_ASSOC);

if(empty($user)) {
    $_SESSION['alert'] = 'Неверный логин или пароль';
    header('Location: task_15.php');
    exit();
}



if(password_verify($password, $user['password'])) {
   $_SESSION['user'] = $user;
   header('Location: index.php');
   exit();
} else {
    $_SESSION['alert'] = 'Неверный логин или пароль';
    header('Location: task_15.php');
    exit();
}