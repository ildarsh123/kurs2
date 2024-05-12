<?php session_start();
$host = 'localhost'; // имя хоста
$username = 'root';      // имя пользователя
$password = '';          // пароль
$dbname = 'test';      // имя базы данных

$pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

$email = $_POST['email'];
$password = $_POST['password'];


$sql = 'SELECT * FROM users WHERE email=:email';
$statement = $pdo->prepare($sql);
$statement->execute(['email' => $email]);
$user = $statement->fetch(PDO::FETCH_ASSOC);


if(!empty($user)) {

     $_SESSION['danger'] = 'Этот эл адрес уже занят другим пользователем';
     header('Location: task_12.php');
    exit;
}
