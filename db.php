<?php

$host = "db";
$dbname = "my_site";
$username = "root";
$password = "awdr0927168@";

try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8",
        $username,
        $password
    );

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch(PDOException $e) {

    echo "DB 연결 실패 : " . $e->getMessage();
	exit;
}
?>