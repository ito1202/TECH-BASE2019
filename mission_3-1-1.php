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
	$count = count($arr);
	
	
	echo $_POST["name"]."<br>" ;
	echo $_POST["comment"]."<br>";

	fwrite($fp, $count."<>".$_POST["name"]."<>".htmlspecialchars($_POST["comment"])."<>".$date."<br>\r\n");
	$content = file_get_contents($filename);
	echo $content;
	fclose($fp);

?>

</body>
</html>

