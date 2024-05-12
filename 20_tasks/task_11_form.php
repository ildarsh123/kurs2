<?php session_start();

$host = 'localhost'; // имя хоста
$username = 'root';      // имя пользователя
$password = '';          // пароль
$dbname = 'test';      // имя базы данных

$pdo_db = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
$text = $_POST['text1'];

$sql = "SELECT * FROM text WHERE text=:text";
$statement = $pdo_db->prepare($sql);
$statement->execute(['text' => $text]);
$task = $statement->fetch(PDO::FETCH_ASSOC);
if(!empty($task)) {
    $_SESSION['danger'] = 'Такое выражение уже было';
    header('Location: http://localhost/welcome/marlindev/20%20zadaniy/task_11.php');
    exit();
}



if (!empty($_POST['text1'])) {


$query = "INSERT INTO text (text) VALUES (:text)";
$statement = $pdo_db->prepare($query);
$statement->execute(['text' => $text]);
$_SESSION['success'] = 'Такое выражение уже было';
header('Location: http://localhost/welcome/marlindev/20%20zadaniy/task_11.php' );
}