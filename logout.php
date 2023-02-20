<?php
error_reporting(0);

session_start();
unset($_SESSION['valid']);

echo header("Location: login.php");
