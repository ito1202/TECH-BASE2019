<?php
$dsn = 'mysql:dbname=tb210012db;host=localhost';
$user = '******';
$password = '******';
$pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

$sql = 'CREATE TABLE user(
        id INT(11) AUTO_INCREMENT,
        name VARCHAR(20),
        age INT(11),
        registry_datetime DATETIME
        )engine=innodb default charset=utf8';

$res = $pdo->query($sql);        


?>