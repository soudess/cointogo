<?php

$servename = "localhost";
$username = "root";
$password = "";
$dbname = "soudess-test";
//connexion a la base de donne en utilisan mysql

$db = new mysqli($servename,  $username, $password, $dbname);
if ($db->connect_error) {
     die("La connexion a la base donne a echoue :" . $db->connect_error);
}
?>