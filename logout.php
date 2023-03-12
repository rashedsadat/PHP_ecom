<?php
session_start();

unset($_SESSION['USER_LOGIN']);
unset($_SESSION['USER_ID']);
unset($_SESSION['USER_NAME']);

// session_unset();
header('location: index.php');
die();
