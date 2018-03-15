<?php header('Content-Type: text/plain; charset=utf-8');

	include 'connect.php';
	$word = $_POST["word"];
	$pos = $_POST["pos"];
	
	$sql = mysql_query("SELECT * FROM tbl_all_words_gj WHERE word='$word'"); 
	$sql2 = mysql_query("SELECT * FROM tbl_all_words_gj WHERE pos='$pos'"); 
	//$sql = mysql_query("SELECT * FROM tbl_all_gujarati_synset_data WHERE synset like '$word%' ORDER BY category DESC"); 
	$items = array();
	$count = 1;
    While($row = mysql_fetch_array($sql))
	{ 
 	
		/*echo $count."] Synset ID = ".$row['synset_id']."\r Synsets = ".$row['synset']."\r Gloss = ".$row['gloss']."\r POS Category = ".$row['category']."";
		echo "\r\n";
		echo "\r\n";
		$count++;*/
		$cars=array($row['synset_id']);
		foreach($cars as $username) {
			$items[] = $username;
		}
	}

	$unique_arr = array_unique($items);
	$unique_array  = array_values($unique_arr);
	$c = count ($unique_array);
	$count = 1;
	for ($x = 0; $x<$c; $x++)
	{
		$sql1 = mysql_query("SELECT * FROM tbl_all_gujarati_synset_data WHERE synset_id='$unique_array[$x]'"); 
		While($row = mysql_fetch_array($sql1))
		{
			echo $count."] Synset ID = ".$row['synset_id']."\r Synsets = ".$row['synset']."\r Gloss = ".$row['gloss']."\r POS Category = ".$row['category']."";
			echo "\r\n";
			echo "\r\n";
			$count++;
		}
	}
	mysql_close($db);
?>