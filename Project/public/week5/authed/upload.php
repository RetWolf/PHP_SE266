<?php 
  session_start();
  if(isset($_SESSION['authed']) && $_SESSION['authed']) {
    echo 'Were IN';
  } else {
    header('Location: ../login.php');
  }
?>