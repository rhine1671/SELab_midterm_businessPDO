<!--Setting up PDO-->

<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "ibañez";
$dsn = "mysql:host={$host};dbname={$dbname}";

$pdo = new pdo($dsn, $user, $password);
$pdo->exec("Set time_zone = '+08:00';");

?>