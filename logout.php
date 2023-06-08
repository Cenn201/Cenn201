<?php
session_start();
unset($_SESSION['uml_user']);
header('Location: ./index.php');
?>