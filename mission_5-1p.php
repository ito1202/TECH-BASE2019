<html>
<head>
  <meta name="viewport" content="width=320, height=480, initial-scale=1.0, minimum-scale=1.0, maximum-scale=2.0, user-scalable=yes"><!-- for smartphone. ここは一旦、いじらなくてOKです。 -->
	<meta charset="UTF-8"><!-- 文字コード指定。ここはこのままで。 -->
	<title>mission 5-1</title>
</head>

<body>
<?php
$dsn = 'mysql:dbname=tb210012db;host=localhost;charset=utf8';
$user = 'tb-******';
$password = '******';
$pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));


$old_submission = array("", "", 0, "");            //編集する名前、編集するコメント、編集するか否かのフラグ、パスワードの4要素
if(empty($_POST["edit_num"]) == FALSE){
    $old_submission = getOldComment($pdo, $_POST["edit_num"]);
    echo "$old_submission[0]の$old_submission[1]を編集します<br>";
}

?>
<form action="mission_5-1p.php" method="post">
    <input type="hidden" name="new_edit_num" value = "<?php if(empty($_POST["edit_num"]) == FALSE && $old_submission[2] == 1){echo$_POST["edit_num"];}?>"><br>
    パスワード:<br>
    <input type="text" name = "password" size = "50" value = "<?php if($old_submission[2] == 1){echo $old_submission[3];}?>"><br>
	名前:<br>
	<input type="text" name="name" size="50" value = "<?php if($old_submission[2] == 1){echo $old_submission[0];}?>"><br>
	コメント:<br>
    <textarea name="comment" cols="50" rows="5"><?php if($old_submission[2] == 1){echo $old_submission[1];}?></textarea><br>
	<input type="submit" value="送信" onclick="document.charset='UTF-8';">
</form>
<hr>
<form action="mission_5-1p.php" method="post">
    削除番号:<br>
    <input type="text" name="delete_num" size="3"><br>
    パスワード:<br>
    <input type="text" name = "password_delete" size = "50"><br>
    <input type="submit" value="削除">
</form>
<hr>
<form action="mission_5-1p.php" method="post">
    編集番号:<br>
    <input type="text" name="edit_num" size="3"><br>
    パスワード:<br>
    <input type="text" name = "password_edit" size = "50"><br>
	<input type="submit" value="編集" onclick="document.charset='UTF-8';">
</form>




<?php
try{
    //テーブルの初期化
    $sql = 'CREATE TABLE IF NOT EXISTS BBSKEY (
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(1024),
        comment VARCHAR(1024),
        datetime DATETIME,
        password VARCHAR(1024)
    )';
    $res = $pdo->query($sql);

    //制御
    if(empty($_POST["new_edit_num"]) == FALSE){
        editComments($pdo, $_POST["new_edit_num"], $_POST["name"] ,$_POST["comment"], $_POST["password"]);
    }elseif(empty($_POST["name"]) == FALSE || empty($_POST["comment"]) == FALSE){
        submission($pdo, $_POST["name"], $_POST["comment"], $_POST["password"]);
    }elseif(empty($_POST["delete_num"]) == FALSE){
        deleteComments($pdo, $_POST["delete_num"]);        
    }

    viewComments($pdo);

}catch(PDOException $e) {
    echo $e->getMessage();
    die();
}
$pdo = null;

function submission($pdo, $name, $comment, $password){
    $sql = 'select count(*) from BBSKEY';
    $stmt = $pdo->query($sql);
    $count =  $stmt->fetchColumn();
    //echo "行数は".$count."です<br>";

    //データベースへの書き込み
    $date = date('Y-m-d H:i:s');
    $sql = "INSERT INTO BBSKEY
    (name, comment, datetime, password) VALUES ('$name','$comment','$date', '$password')";
    $res = $pdo->query($sql);
}

function viewComments($pdo){
    $sql = "SELECT * FROM BBSKEY";
    $res = $pdo->query($sql);
    foreach( $res as $value ) {
        echo "$value[id]:";
        echo "$value[name]:";
        echo "$value[comment]:";
        echo "$value[datetime]";
        echo "$value[password]<br>";
    }
}

function deleteComments($pdo, $id){
    $sql = "SELECT * FROM BBSKEY WHERE id = '$id'";
    $res = $pdo->query($sql);
    foreach( $res as $value ){
        $pass = "$value[password]";
    }
    //echo $_POST["password_delete"]."と".$pass."を比較しています<br>";
    if($_POST["password_delete"] == $pass){
        $sql = "DELETE FROM BBSKEY WHERE id = '$id'";
    //    echo "if文を通りました<br>";
        // クエリ実行（データを取得）
        $res = $pdo->query($sql);
    }
}

function getOldComment($pdo, $id){
    $flag = 0;
    $sql = "SELECT * FROM BBSKEY WHERE id = '$id'";
    $res = $pdo->query($sql);
    foreach( $res as $value ){
        $old_name = $value['name'];
        $old_comment = $value['comment'];
        $old_password = $value['password'];
    }

    if ($old_password == $_POST["password_edit"]){
        $flag = 1;
    }

    return array ($old_name, $old_comment, $flag, $old_password);
}

function editComments($pdo, $id, $new_name, $new_comment, $new_password){
        
    $date = date("Y/m/d H:i:s");    //日付取得
    $sql = "UPDATE BBSKEY SET name = '$new_name' , comment = '$new_comment' , datetime = '$date', password = '$new_password' WHERE id = '$id'";
    $res = $pdo->query($sql);
}

?>

</body>
</html>