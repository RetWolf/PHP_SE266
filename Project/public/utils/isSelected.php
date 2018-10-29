<?php
  function isSelected($key, $value) {
    return filter_input(INPUT_GET, $key) === $value ? "selected" : "";
  }
?>