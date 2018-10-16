<?php 
  function getDatabase() {
    // Remote Config
    $config = array(
      'DB_DNS' => 'mysql:host=ict.neit.edu;port=5500;dbname=se266_matt',
      'DB_USER' => 'se266_matt',
      'DB_PASSWORD' => '1433733'
    );

    // Local Config
    /*
    $config = array(
      'DB_DNS' => 'mysql:host=192.168.10.10;port=3306;',
      'DB_USER' => 'homestead',
      'DB_PASSWORD' => 'secret'
    );*/

    try {
      $db = new PDO($config['DB_DNS'], $config['DB_USER'], $config['DB_PASSWORD']);
      $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    } catch (Exception $ex) {
      echo $ex->getMessage();
      $db = null;
    }

    return $db;
  }
?>