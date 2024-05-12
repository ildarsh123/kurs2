<?php
$host = 'localhost'; // имя хоста
$username = 'root';      // имя пользователя
$password = '';          // пароль
$dbname = 'test';      // имя базы данных

$pdo_db = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);



if (!empty($_POST['text1'])) {


    $text = $_POST['text1'];
    $query = "INSERT INTO text (text) VALUES (:text)";
    $statement = $pdo_db->prepare($query);
    $statement->execute(['text' => $text]);

    header('Location: task_10.html');
}