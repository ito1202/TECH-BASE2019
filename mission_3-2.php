<html>
<head>
  <meta name="viewport" content="width=320, height=480, initial-scale=1.0, minimum-scale=1.0, maximum-scale=2.0, user-scalable=yes"><!-- for smartphone. ここは一旦、いじらなくてOKです。 -->
	<meta charset="UTF-8"><!-- 文字コード指定。ここはこのままで。 -->
	<title>mission 2-1</title>
</head>

<body>


<form action="mission_3-1-1.php" method="post">
	名前:<br>
	<input type="text" name="name" size="50" value=""><br>
	コメント:<br>
	<textarea name="comment" cols="50" rows="5"></textarea><br>
	<input type="submit" value="送信" onclick="document.charset='UTF-8';">
</form>






<?php 
	$filename = "mission_3-1.txt";
	$fp = fopen($filename, "a");

	//日付取得
	$date = date("Y/m/d H:i:s");

	//テキストファイルの行数を取得
	$content = file_get_contents($filename);
    $arr=explode("\r\n", $content);	//改行をデリミタとして配列に格納
    
	foreach($arr as $comment_raw){  //1行ずつ順番に見ていく
		$comment = explode("<>", $comment_raw);
		foreach($comment as $elements){     //1要素ずつ順番に見ていく
			echo $elements;
		}
		//echo "<br>";
	}
?>

</body>
</html>

