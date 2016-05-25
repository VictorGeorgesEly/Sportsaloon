<?php

function connectBDD(){
  $servername = "localhost";
  $username = "root";
  $password = "root";
  $dbname = "sportsaloon";
  $db=null;


  $db = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  //$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); requêtes préparées avec des INT

  $db->query("SET NAMES UTF8"); // GUILLAUME <3
  return $db;
}
