<html>
<head>
  <meta name="viewport" content="width=320, height=480, initial-scale=1.0, minimum-scale=1.0, maximum-scale=2.0, user-scalable=yes"><!-- for smartphone. ここは一旦、いじらなくてOKです。 -->
	<meta charset="UTF-8"><!-- 文字コード指定。ここはこのままで。 -->
	<title>mission 3-3</title>
</head>

<body>
<?php
    $filename = "mission_3-4.txt";

    $old_submission = array("", "");
    if(empty($_POST["edit_num"]) == FALSE){
        $old_submission = getOldComment($filename, $_POST["edit_num"]);
    }

?>

<hr>

<form action="mission_3-4.php" method="post">
    <input type="text" name="new_edit_num" value = "<?php if(empty($_POST["edit_num"]) == FALSE){echo$_POST["edit_num"];}?>"><br>
	名前:<br>
	<input type="text" name="name" size="50" value = "<?php echo $old_submission[0]?>"><br>
	コメント:<br>
    <textarea name="comment" cols="50" rows="5"><?php echo $old_submission[1];?></textarea><br>
	<input type="submit" value="送信" onclick="document.charset='UTF-8';">
</form>

<form action="mission_3-4.php" method="post">
    削除番号:<br>
    <input type="text" name="delete_num" size="3"><br>
    <input type="submit" value="削除">
</form>

<form action="mission_3-4.php" method="post">

    編集番号:<br>
	<input type="text" name="edit_num" size="3"><br>
	<input type="submit" value="編集" onclick="document.charset='UTF-8';">
</form>

<hr>
<?php 
    $filename = "mission_3-4.txt";
        
    //実行モードの制御
    if(empty($_POST["new_edit_num"]) == FALSE){
        editComments($filename, $_POST["new_edit_num"], $_POST["name"] ,$_POST["comment"]);
    }elseif(empty($_POST["comment"]) == FALSE){
        submission($filename);
    }elseif(empty($_POST["delete_num"] == FALSE)){
        deleteComments($filename, $_POST["delete_num"]);        
    }

    viewComments($filename);
    
    //コメントを表示する関数
    function viewComments($file){
        $content = file_get_contents($file);   
        $arr = explode("\r\n", $content);

        foreach($arr as $comment_raw){               //1行ずつ順番に見ていく
            $comment = explode("<>", $comment_raw);
            foreach($comment as $elements){                 //1要素ずつ順番に見ていく
                echo $elements;
            }
        }
    }
    //投稿を受け付ける関数
    function submission($file){
        $date = date("Y/m/d H:i:s");    //日付取得

        $fp = fopen($file, "a");
        $content = file_get_contents($file);
        $arr=explode("\r\n", $content);	//改行をデリミタとして配列に格納
        $count = count($arr) + 1;           //行数取得

        fwrite($fp, $count."<>".$_POST["name"]."<>".htmlspecialchars($_POST["comment"])."<>".$date."<br>\r\n");
        echo $_POST["name"]."さんのコメント".$_POST["comment"]."を受け付けました。<br>";        
        fclose($fp);
    }
    //投稿を削除する関数
    function deleteComments($file, $num){
        $content = file_get_contents($file);    //読み込み用のファイルポインタ
        $arr = explode("\r\n", $content);       //１行ずつ配列に格納
        $output_fp = fopen($file, "w");         //書き込み用のファイルポインタ

        $i = 1;                                 //更新後の投稿番号の初期化
        
        foreach($arr as $comment_raw){               //1行ずつ順番に見ていく
            $comment = explode("<>", $comment_raw);  //<>で分割して配列に格納(0...投稿番号, 1...名前, 2...コメント, 3...日付)
            if($comment[0] != $num){                    //投稿番号を削除番号と比較
                fwrite($output_fp, $i."<>".$comment[1]."<>".$comment[2]."<>".$comment[3]."\r\n");   //新しい投稿番号をつけてファイルに書き込み
                $i++;                                   //投稿番号の更新
            }
        }
        fclose($output_fp);
    }

    //編集する際フォームに編集中の文字を取得する関数
    function getOldComment($file, $num){
        $content = file_get_contents($file);    //読み込み用のファイルポインタ
        $arr = explode("\r\n", $content);       //１行ずつ配列に格納
        foreach($arr as $comment_raw){               //1行ずつ順番に見ていく
            $comment = explode("<>", $comment_raw);  //<>で分割して配列に格納(0...投稿番号, 1...名前, 2...コメント, 3...日付)
            if($comment[0] == $num){                    //投稿番号を削除番号と比較
                $old_name = $comment[1];
                $old_comment = $comment[2];//新しい投稿番号をつけてファイルに書き込み
            }
        }
        return array ($old_name, $old_comment);
    }

    //編集機能で既存の投稿を新たな名前とコメントに置換する関数
    function editComments($file, $num, $new_name, $new_comment){
        
        $date = date("Y/m/d H:i:s");    //日付取得
        $content = file_get_contents($file);
        $arr = explode("\r\n", $content);
        $fp = fopen($file, "w");
        foreach($arr as $comment_raw){
            $comment = explode("<>", $comment_raw);
            if($comment[0] == $num){
                fwrite($fp, $comment[0]."<>".$new_name."<>".htmlspecialchars($new_comment)."<>".$date."<br>\r\n");    
            }else{
                fwrite($fp, $comment[0]."<>".$comment[1]."<>".htmlspecialchars($comment[2])."<>".$comment[3]."\r\n");
            }
        }

    }
?>

</body>
</html>