<?php session_start();

$_SESSION['times'] = ($_SESSION['times']>= 1)? $_SESSION['times'] + 1 : 1;
//2) $_SESSION['times'] = ($_SESSION['times']>= 1)? $_SESSION['times']++ : 1;
header("Location: task_14.php");