<html>
<head>
  <meta name="viewport" content="width=320, height=480, initial-scale=1.0, minimum-scale=1.0, maximum-scale=2.0, user-scalable=yes"><!-- for smartphone. ここは一旦、いじらなくてOKです。 -->
	<meta charset="UTF-8"><!-- 文字コード指定。ここはこのままで。 -->
	<title>mission 2-1</title>
</head>

<body>


<form action="mission_2-3-2.php" method="post">
	<textarea name="comment" cols="30" rows="5"></textarea><br>
	<input type="submit" value="送信" onclick="document.charset='UTF-8';">
</form>






<?php 
	$filename = "mission_2-3.txt";
	$fp = fopen($filename, "a");
	echo $_POST["comment"] ;

	
	if(empty($_POST["comment"])==false){
		$str = $_POST["comment"];
		fwrite($fp, $str."\r\n");
	}else{
		echo "文字列が空です。フォームに文字を入力してください";
	}
	fclose($fp);

?>

</body>
</html>

