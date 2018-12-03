<?php
  include '../../utils/dbConnect.php';
  include '../../utils/timecardFunctions.php';
  $id = filter_input(INPUT_GET, "id");
  $isClockedIn = filter_input(INPUT_GET, "clocked_in");

  // If the project is clocked in
  if($isClockedIn) {
    session_start();
    clockProjectOut($id);
    $timecard = getOpenTimecard();
    closeTimecard($timecard["timecard_id"], $timecard["checked_in"]);
    setProjectTimeWorked($id);
    unset($_SESSION["clocked_id"]);
    session_write_close();
    header("Location: ./index.php");
  } 
  // If the project is not clocked in
  else {
    session_start();
    clockProjectIn($id);
    createTimecard($id);
    $_SESSION["clocked_id"] = $id;
    session_write_close();
    header("Location: ./index.php");
  }
?>