<?php
  session_start();
  unset($_SESSION['authed']);
  unset($_SESSION['user']);
  header("Location: ../login.php");
?>