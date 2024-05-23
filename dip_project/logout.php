<?php session_start();

unset($_SESSION['user']);
require 'functions.php';
redirect_to('page_login.php');