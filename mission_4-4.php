<?php
    $dsn = 'mysql:dbname=tb210012db;host=localhost;charset=utf8';
    $user = '******';
    $password = '******';
    $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
	$sql = 'SELECT * from user';


try{
    //4-2

    $sql = 'CREATE TABLE IF NOT EXISTS user_list (
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(20),
        age INT(11),
        registry_datetime DATETIME
    )';
    $res = $pdo->query($sql);

    //4-3
    $sql = 'SHOW TABLES';
    $stmt = $pdo->query($sql);
    while ($result = $stmt->fetch(PDO::FETCH_NUM)){
        $table_names[] = $result[0];
        echo $result[0]."<br>";
    }

    //4-4
	// SQL作成
	$sql = "SELECT * FROM user_list";
	// SQL実行
	$res = $pdo->query($sql);
	// 取得したデータを出力
	foreach( $res as $value ) {
        echo "$value[id]<br>";
        echo "$value[name]<br>";
        echo "$value[age]<br>";
        echo "$value[registry_datetime]<br>";
    }


} catch(PDOException $e) {

	echo $e->getMessage();
	die();
}

// 接続を閉じる
$pdo = null;
?>