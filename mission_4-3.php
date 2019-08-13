<?php



try{
    $dsn = 'mysql:dbname=tb210012db;host=localhost;charset=utf8';
    $user = '******';
    $password = '******';
    $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
	$sql = 'SHOW TABLES FROM tb210012db';
    
    $stmt = $pdo->query($sql);
           
    while($re = $stmt->fetch(PDO::FETCH_ASSOC)){
        var_dump($re);    // $re は配列。echo では表示できない
    }
} catch(PDOException $e) {

	echo $e->getMessage();
	die();
}

// 接続を閉じる
$pdo = null;
?>