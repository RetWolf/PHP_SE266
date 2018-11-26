<?php 
  $age = filter_input(INPUT_GET, "age");
  if($age >= 18) {
    $str = json_encode("You are an adult");
    echo $str;
  } else {
    $str = json_encode("You are a child");
    echo $str;
  }
?>