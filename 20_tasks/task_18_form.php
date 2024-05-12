<?php session_start();


var_dump($_GET);
$image_id = $_GET['id'];


$host = 'localhost';
$username = 'root';
$dbname = 'test';
$pass = '';

$pdo = new PDO("mysql:host=$host;dbname=$dbname",$username,$pass);

$sql = "SELECT * FROM images WHERE id = :id";
$statement = $pdo->prepare($sql);
$statement->execute(['id' => $image_id]);
$image = $statement->fetch(PDO::FETCH_ASSOC);


var_dump($image);




$directory = "uploads\\";
if(file_exists($directory . $image['title'])) {
    unlink($directory . $image['title']);

}

if(!empty($image)) {
    $sql = "DELETE FROM images WHERE id = :id";
    $statement = $pdo->prepare($sql);
    $statement->execute(['id' => $image_id]);
}


  header("Location: task_18.php");
  exit();

