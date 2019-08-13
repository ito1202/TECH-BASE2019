<html>
	<head>
		<title>mission1-6</title>
		
	</head>
	<body>
	<?php
	$Shiritori = array("しりとり", "りす", "すずめ","めだか", "からす");
	for ($i = 1; $i <= 5; $i++){
		$log = array_slice($Shiritori, 0, $i );
		foreach ($log as $word){
			echo $word;
		}
		echo " "."<br/>";
	}

	?>
	</body>
</html>