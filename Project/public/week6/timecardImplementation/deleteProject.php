<?php 
  include '../../utils/dbConnect.php';
  include '../../utils/timecardFunctions.php';

  $id = filter_input(INPUT_GET, "id");
  deleteProject($id);
  header("Location: ./index.php");
?>