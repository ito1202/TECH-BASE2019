<?php
	echo "減算\n";
	$year = 2019;
	$birth = 1995;
	$old = $year - $birth;
	echo $old;

	echo "加算\n";
	echo ($old + 12)."\n";

	echo"乗算"."\n";
	echo ($old + 12 * 2)."\n";

	echo "除算"."\n";
	$mod = $old % 4.;
	$olympic = ($old - $mod) / 4;
	echo $olympic."\n";

?>