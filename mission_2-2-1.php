<html>
<head>
  <meta name="viewport" content="width=320, height=480, initial-scale=1.0, minimum-scale=1.0, maximum-scale=2.0, user-scalable=yes"><!-- for smartphone. ここは一旦、いじらなくてOKです。 -->
	<meta charset="UTF-8"><!-- 文字コード指定。ここはこのままで。 -->
	<title>mission 2-1</title>
</head>

<body>


<form action="mission_2-2-1.php" method="post">
	<textarea name="comment" cols="30" rows="5"></textarea><br>
	<input type="submit" value="送信" onclick="document.charset='UTF-8';">
</form>






<?php 
	$filename = "mission_2-2.txt";
	echo $_POST["comment"] ;

	$str = mb_convert_encoding($_POST["comment"], "UTF-8");
	$fp = fopen($filename, "w");
	fwrite($fp, $str);
	fclose($fp);

?>

</body>
</html>

