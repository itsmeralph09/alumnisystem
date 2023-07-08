<?php

session_start();

if (!isset($_SESSION['email'])) {
  header('Location: login.php');
  exit;
} else{
      unset($_SESSION['email']);
      unset($_SESSION['usertype']);

      unset($_COOKIE['PHPSESSID']);
      setcookie('PHPSESSID', '', time() - 3600, '/');

      session_destroy();
      header("Location: login.php");
      exit;
    }

header("Location: login.php");
exit;
?>