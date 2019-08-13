<html>
<head>
  <meta name="viewport" content="width=320, height=480, initial-scale=1.0, minimum-scale=1.0, maximum-scale=2.0, user-scalable=yes"><!-- for smartphone. ここは一旦、いじらなくてOKです。 -->
	<meta charset="UTF-8"><!-- 文字コード指定。ここはこのままで。 -->
	<title>mission 3-3</title>
</head>

<body>


<form action="mission_3-3.php" method="post">
	名前:<br>
	<input type="text" name="name" size="50" value=""><br>
	コメント:<br>
    <textarea name="comment" cols="50" rows="5"></textarea><br>
    削除:<br>
	<input type="text" name="delete_num" size="3"><br>
	<input type="submit" value="送信" onclick="document.charset='UTF-8';">
</form>





<hr>
<?php 
    $filename = "mission_3-1.txt";
        
    //実行モードの制御
    if(empty($_POST["comment"]) == FALSE){
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

?>

</body>
</html>

