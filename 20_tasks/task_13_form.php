<?php session_start();

$text = $_POST['text'];

$_SESSION['alertinfo'] = $text;

header("Location: task_13.php");

exit;