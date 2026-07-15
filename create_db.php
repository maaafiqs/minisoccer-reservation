<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";

try {
  $conn = new PDO("mysql:host=$servername", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $sql = "CREATE DATABASE IF NOT EXISTS reservasi_minisoccer";
  $conn->exec($sql);
  echo "Database created successfully";
} catch(PDOException $e) {
  echo $sql . "\n" . $e->getMessage();
}
$conn = null;
?>
