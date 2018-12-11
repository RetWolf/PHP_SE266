<?php
  function getTopTen() {
    $db = getDatabase();
    $sql = "SELECT CountryDetailID AS CountryID, CountryName AS Country, CountryRegion AS Region, CountryPopulation AS 'Population(thousands)', CountrySize AS 'Size(square miles)' FROM countrydetails ORDER BY CountryPopulation DESC LIMIT 10";
    $stmt = $db->prepare($sql);
    $results = array();
    if($stmt->execute() && $stmt->rowCount() > 0) {
      $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    return $results;
  }

  function getCountryDetails($countryID) {
    $db = getDatabase();
    $sql = "SELECT * FROM countrydetails WHERE CountryDetailID = :id";
    $stmt = $db->prepare($sql);
    $binds = array(
      ":id" => $countryID,
    );
    $results = array();
    if($stmt->execute($binds) && $stmt->rowCount() > 0) {
      $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    return $results;
  }

  function updateCountryDetails($countryID, $countryPopulation, $countrySize) {
    $db = getDatabase();
    $sql = "UPDATE countrydetails SET CountryPopulation = :countryPopulation, CountrySize = :countrySize WHERE CountryDetailID = :id";
    $stmt = $db->prepare($sql);
    $binds = array(
      ":countryPopulation" => $countryPopulation,
      ":countrySize" => $countrySize,
      ":id" => $countryID
    );
    $results = "Error updating country data.";
    if($stmt->execute($binds) && $stmt->rowCount() > 0) {
      $results = "Successfully updated country data.";
    }
    return $results;
  }

  function getAllRegions() {
    $db = getDatabase();
    $sql = "SELECT CountryRegion FROM CountryDetails GROUP BY CountryRegion;";
    $stmt = $db->prepare($sql);
    $results = array();
    if($stmt->execute() && $stmt->rowCount() > 0) {
      $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    return $results;
  }

  function searchCountryData($countryName, $countryRegion) {
    $db = getDatabase();
    $sql = "SELECT CountryDetailID AS CountryID, CountryName AS Country, CountryRegion AS Region, CountryPopulation AS 'Population(thousands)', CountrySize AS 'Size(square miles)' FROM CountryDetails WHERE 0=0";
    $binds = array();
    if($countryName !== "") {
      $sql .= " AND CountryName LIKE :countryName";
      $binds[":countryName"] = "%$countryName%";
    }
    if($countryRegion !== "") {
      $sql .= " AND CountryRegion LIKE :countryRegion";
      $binds[":countryRegion"] = "%$countryRegion%";
    }
    $stmt = $db->prepare($sql);
    $results = array();
    if($stmt->execute($binds) && $stmt->rowCount() > 0) {
      $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    return $results;
  }

  function populationByRegion() {
    $db = getDatabase();
    $sql = "SELECT CountryRegion AS Region, SUM(CountryPopulation) AS 'Population(thousands)' FROM CountryDetails GROUP BY Region;";
    $stmt = $db->prepare($sql);
    $results = array();
    if($stmt->execute() && $stmt->rowCount() > 0) {
      $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    return $results;
  }
?>