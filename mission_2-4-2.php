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
	$fp = fopen($filename, "r");
	$arr = array();
	$i = 0;
	while ($line = fgets($fp)){
		$arr[$i] = $line;
		$i = $i + 1;
	}
/*
	echo $arr[0]."<br>";
	echo $arr[1]."<br>";
	echo $arr[2]."<br>";
*/
	foreach ($arr as $message){
		echo $message."<br>";
	}

	fclose($fp);

?>

</body>
</html>

