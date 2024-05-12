<?php

$host = 'localhost'; // имя хоста
$username = 'root';      // имя пользователя
$pass = '';          // пароль
$dbname = 'test';      // имя базы данных

$pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $pass);




function normalize_files_array($files = []) {

    $normalized_array = [];

    foreach($files as $index => $file) {

        if (!is_array($file['name'])) {
            $normalized_array[$index][] = $file;
            continue;
        }

        foreach($file['name'] as $idx => $name) {
            $normalized_array[$index][$idx] = [
                'name' => $name,
                'type' => $file['type'][$idx],
                'tmp_name' => $file['tmp_name'][$idx],
                'error' => $file['error'][$idx],
                'size' => $file['size'][$idx]
            ];
        }

    }

    return $normalized_array;

}





/*
//$uploadfile = $uploaddir . basename($_FILES['userfile']['name']);
*/

$files[] = (normalize_files_array($_FILES));

foreach ($files as $file) {

    $prefix = strval(random_int(123,999));
    $uniqid = uniqid($prefix);


    $uploaddir = 'uploads\\' . $uniqid . $file['file']['name'];


    if (move_uploaded_file($file['file']['tmp_name'], $uploaddir)) {
        $title = $uniqid . $file['file']['name'];
        $sql = "INSERT INTO images (title) VALUES (:title)";
        $statement = $pdo->prepare($sql);
        $statement->execute(['title' => $title]);
        //echo  "Файл корректен и был успешно загружен.\n";
    } else {
        //echo  "Возможная атака с помощью файловой загрузки!\n";
    }
}
/*
$_SESSION = [];
$_SESSION['files'] = getNormalizedFiles();

*/

header('Location: task_17.php');