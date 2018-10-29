<?php 

  function getAllData($table) {
    $db = getDatabase();
    $stmt = $db->prepare("SELECT * FROM $table");

    $results = array();
    if ($stmt->execute() && $stmt->rowCount() > 0) {
      $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    return $results;
  }

  function searchData($table, $column, $searchValue) {
    $db = getDatabase();
    $stmt = $db->prepare("SELECT * FROM $table WHERE $column LIKE :searchValue");

    $searchValue = "%$searchValue%";
    $binds = array(
      ":searchValue" => $searchValue
    );

    $results = array();
    if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
      $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    return $results;
  }

  function sortData($table, $column, $order) {
    $db = getDatabase();
    $stmt = $db->prepare("SELECT * FROM $table ORDER BY $column $order");

    $results = array();
    if ($stmt->execute() && $stmt->rowCount() > 0) {
      $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    return $results;
  }

  function getAllColumns() {
    $db = getDatabase();
    $stmt = $db->prepare("SELECT `COLUMN_NAME` 
      FROM `INFORMATION_SCHEMA`.`COLUMNS` 
      WHERE `TABLE_SCHEMA`='se266_matt' 
      AND `TABLE_NAME`='corps';"
    );

    $results = array();
    if ($stmt->execute() && $stmt->rowCount() > 0) {
      $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    return $results;
  }
?>