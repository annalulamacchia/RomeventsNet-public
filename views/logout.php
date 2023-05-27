<?php
session_start();
unset($_SESSION['session_id']);
unset($_SESSION['session_user']);
session_destroy();
header('location:index.php');
?>