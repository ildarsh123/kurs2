<?php session_start();

var_dump($_FILES);

 $prefix = strval(random_int(123,999));
 $uniqid = uniqid($prefix);


$uploaddir = 'uploads\\' . $uniqid . $_FILES['file']['name'];
echo $uploaddir;

/*
//$uploadfile = $uploaddir . basename($_FILES['userfile']['name']);
*/

$host = 'localhost'; // имя хоста
$username = 'root';      // имя пользователя
$pass = '';          // пароль
$dbname = 'test';      // имя базы данных

$pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $pass);


if (move_uploaded_file($_FILES['file']['tmp_name'], $uploaddir)) {
   $title = $uniqid . $_FILES['file']['name'];
   $sql = "INSERT INTO images (title) VALUES (:title)";
   $statement = $pdo->prepare($sql);
   $statement ->execute(['title' => $title]);
   //echo  "Файл корректен и был успешно загружен.\n";
} else {
    //echo  "Возможная атака с помощью файловой загрузки!\n";
}

/*
$_SESSION = [];
$_SESSION['files'] = getNormalizedFiles();

*/

header('Location: task_17.php');






