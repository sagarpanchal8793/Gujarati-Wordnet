<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
			 <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
			 <meta name="description" content="Gujarati WordNet">
        <meta name="author" content="">
        
        <!-- viewport settings -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" /></head>
<?php header('Content-Type: text/html; charset=utf-8');
	include 'connect.php';
	session_start();
	$rword = $_SESSION['word'];
	//$rword=$_GET["q"];
//-----------------------Hypernymy Code--------------------------------------------------------------------------------	
	echo "<br><br>";
	echo "Relations of wordnet...<br><br>";
	
	$sql11 = mysql_query("SELECT synset_id FROM tbl_all_words_gj WHERE word='$rword'");
	
	if($row11=mysql_fetch_array($sql11))
	{
		$hyprsynid = $row11['synset_id'];
	}

	$sql12 = mysql_query("SELECT hypernymy_id FROM tbl_hypernymy WHERE synset_id='$hyprsynid'");
	
	if(mysql_num_rows($sql12) > 0)
	{
		if($row12=mysql_fetch_array($sql12))
		{
			$hyprid = $row12['hypernymy_id'];
		}
	
		$sql13 = mysql_query("SELECT word FROM tbl_all_words_gj WHERE synset_id='$hyprid'");
	
		if($row13=mysql_fetch_array($sql13))
		{
			$hyprword = $row13['word'];
		}
		//echo"Hypernymy id = ".$hyprid. "<br><br> Hypernymy word = ".$hyprword." <br><br>Is for synset id ".$hyprsynid;
		echo "<strong><ins><font size='4' color='blue'>Hypernymy word</font></ins> = ".$hyprword." </strong><br><br>";
		
		$sql14 = mysql_query("SELECT * FROM tbl_all_words_gj WHERE word='$hyprword'");  
		$items14 = array();
		$count = 1;
		While($row14 = mysql_fetch_array($sql14))
		{  
			$cars14=array($row14['synset_id']);
			foreach($cars14 as $username14)
			{
				$items14[] = $username14;
			}
		}
		$unique_arr14 = array_unique($items14);
		$unique_array14  = array_values($unique_arr14);
		$c14 = count ($unique_array14);
		$count = 1;
		for ($x = 0; $x<$c14; $x++)
		{
			$sql15 = mysql_query("SELECT * FROM tbl_all_gujarati_synset_data WHERE synset_id='$unique_array14[$x]'");
			While($row15 = mysql_fetch_array($sql15))
			{
				echo $count.". Synset ID = ".$row15['synset_id']."<br> Synsets = ".$row15['synset']."<br> Gloss = ".$row15['gloss']."<br> POS Category = ".	$row15['category']."";
				echo "<br><br>";
				$count++;
			}
		}
		
	}
	else
	{
		//echo "The <font size='4' color='blue'><strong><ins>Hypernymy</ins><strong></font> relation for the given word is <b><font color='red'>NOT PRESENT</font></b><br><br>";
	}
	echo "<br><br>";
	
//---------------------------------------Hyponymy Code--------------------------------------------------------------------

	$sql21 = mysql_query("SELECT synset_id FROM tbl_all_words_gj WHERE word='$rword'");
	
	if($row21=mysql_fetch_array($sql21))
	{
		$hyposynid = $row21['synset_id'];
	}
	
	$sql22 = mysql_query("SELECT hyponymy_id FROM tbl_hyponymy WHERE synset_id='$hyposynid'");
	
	if(mysql_num_rows($sql22) > 0)
	{
		if($row22=mysql_fetch_array($sql22))
		{
			$hypoid = $row22['hyponymy_id'];
		}
	
		$sql23 = mysql_query("SELECT word FROM tbl_all_words_gj WHERE synset_id='$hypoid'");
	
		if($row23=mysql_fetch_array($sql23))
		{
			$hypoword = $row23['word'];
		}
	
		//echo "Hyponymy id = ".$hypoid. "<br><br> Hyponymy word = ".$hypoword." <br><br>Is for synset id ".$hyposynid;
		echo "<strong><ins><font size='4' color='#660099'>Hyponymy word</font></ins> = ".$hypoword." </strong><br><br>";
		
		$sql24 = mysql_query("SELECT * FROM tbl_all_words_gj WHERE word='$hypoword'");  
		$items24 = array();
		$count = 1;
		While($row24 = mysql_fetch_array($sql24))
		{  
			$cars24=array($row24['synset_id']);
			foreach($cars24 as $username24)
			{
				$items24[] = $username24;
			}
		}
		$unique_arr24 = array_unique($items24);
		$unique_array24  = array_values($unique_arr24);
		$c24 = count ($unique_array24);
		$count = 1;
		for ($x = 0; $x<$c24; $x++)
		{
			$sql25 = mysql_query("SELECT * FROM tbl_all_gujarati_synset_data WHERE synset_id='$unique_array24[$x]'");
			While($row25 = mysql_fetch_array($sql25))
			{
				echo $count.". Synset ID = ".$row25['synset_id']."<br> Synsets = ".$row25['synset']."<br> Gloss = ".$row25['gloss']."<br> POS Category = ".	$row25['category']."";
				echo "<br><br>";
				$count++;
			}
		}
	}
	else
	{
		//echo "The <font size='4' color='#660099'><strong><ins>Hyponymy</ins><strong></font> relation for the given word is <b><font color='red'>NOT PRESENT</font></b><br><br>";
	}
	echo "<br><br>";
//---------------------------------------Meronymy Code--------------------------------------------------------------------	

	$sql31 = mysql_query("SELECT synset_id FROM tbl_all_words_gj WHERE word='$rword'");
	
	if($row31=mysql_fetch_array($sql31))
	{
		$mersynid = $row21['synset_id'];
	}
	
	$sql32 = mysql_query("SELECT mero_component_object_id FROM tbl_mero_component_object WHERE synset_id='$mersynid'");
	
	if(mysql_num_rows($sql32) > 0)
	{
		if($row32=mysql_fetch_array($sql32))
		{
			$merid = $row32['mero_component_object_id'];
		}
	
		$sql33 = mysql_query("SELECT word FROM tbl_all_words_gj WHERE synset_id='$merid'");
	
		if($row33=mysql_fetch_array($sql33))
		{
			$merword = $row33['word'];
		}
	
		//echo "Meronymy id = ".$merid. "<br><br> Meronymy word = ".$merword." <br><br>Is for synset id ".$mersynid;
		echo "<strong><ins><font size='4' color='green'>Meronymy word</font></ins> = ".$merword." </strong><br><br>";
		
		$sql34 = mysql_query("SELECT * FROM tbl_all_words_gj WHERE word='$merword'");  
		$items34 = array();
		$count = 1;
		While($row34 = mysql_fetch_array($sql34))
		{  
			$cars34=array($row34['synset_id']);
			foreach($cars34 as $username34)
			{
				$items34[] = $username34;
			}
		}
		$unique_arr34 = array_unique($items34);
		$unique_array34  = array_values($unique_arr34);
		$c34 = count ($unique_array34);
		$count = 1;
		for ($x = 0; $x<$c34; $x++)
		{
			$sql35 = mysql_query("SELECT * FROM tbl_all_gujarati_synset_data WHERE synset_id='$unique_array34[$x]'");
			While($row35 = mysql_fetch_array($sql35))
			{
				echo $count.". Synset ID = ".$row35['synset_id']."<br> Synsets = ".$row35['synset']."<br> Gloss = ".$row35['gloss']."<br> POS Category = ".	$row35['category']."";
				echo "<br><br>";
				$count++;
			}
		}
	}
	else
	{
		//echo "The <font size='4' color='green'><strong><ins>Meronymy</ins><strong></font> relation for the given word is <b><font color='red'>NOT PRESENT</font></b><br><br>";
	}
	echo "<br><br>";
//---------------------------------------Holonymy Code--------------------------------------------------------------------

	$sql41 = mysql_query("SELECT synset_id FROM tbl_all_words_gj WHERE word='$rword'");
	
	if($row41=mysql_fetch_array($sql41))
	{
		$holosynid = $row41['synset_id'];
	}
	
	$sql42 = mysql_query("SELECT holo_component_object_id FROM tbl_holo_component_object WHERE synset_id='$hyprsynid'");
	
	if(mysql_num_rows($sql42) > 0)
	{
		if($row42=mysql_fetch_array($sql42))
		{
			$holoid = $row42['holo_component_object_id'];
		}
	
		$sql43 = mysql_query("SELECT word FROM tbl_all_words_gj WHERE synset_id='$holoid'");
	
		if($row43=mysql_fetch_array($sql43))
		{
			$holoword = $row43['word'];
		}
	
		//echo "Holonymy id = ".$holoid. "<br><br> Holonymy word = ".$holoword." <br><br>Is for synset id ".$holosynid;
		echo "<strong><ins><font size='4' color='#FF0099'>Holonymy word</font></ins> = ".$holoword." </strong><br><br>";
		
		$sql44 = mysql_query("SELECT * FROM tbl_all_words_gj WHERE word='$holoword'");  
		$items44 = array();
		$count = 1;
		While($row44 = mysql_fetch_array($sql44))
		{  
			$cars44=array($row44['synset_id']);
			foreach($cars44 as $username44)
			{
				$items44[] = $username44;
			}
		}
		$unique_arr44 = array_unique($items44);
		$unique_array44  = array_values($unique_arr44);
		$c44 = count ($unique_array44);
		$count = 1;
		for ($x = 0; $x<$c44; $x++)
		{
			$sql45 = mysql_query("SELECT * FROM tbl_all_gujarati_synset_data WHERE synset_id='$unique_array44[$x]'");
			While($row45 = mysql_fetch_array($sql45))
			{
				echo $count.". Synset ID = ".$row45['synset_id']."<br> Synsets = ".$row45['synset']."<br> Gloss = ".$row45['gloss']."<br> POS Category = ".	$row45['category']."";
				echo "<br><br>";
				$count++;
			}
		}
	}
	else
	{
		//echo "The <font size='4' color='#FF0099'><strong><ins>Holonymy</ins><strong></font> relation for the given word is <b><font color='red'>NOT PRESENT</font></b><br><br>";
	}
	echo "<br><br>";
//---------------------------------------Antonomy Code--------------------------------------------------------------------

	$sql51 = mysql_query("SELECT * FROM tbl_anto_gender WHERE synset_word='$rword'");
	
	if(mysql_num_rows($sql51) == 1)
	{ 
        if($row51 = mysql_fetch_array($sql51))
		{
			$antosynid=$row51['synset_id'];
			$antoid=$row51['anto_gender_id'];
			$antoword=$row51['anto_gender_word'];
			//echo "Antonymy id = ".$antoid. "<br><br> Antonymy word = ".$antoword." <br><br>Is for synset id ".$antosynid;
			echo "<strong><ins><font size='4' color='#880000'>Antonymy word</font></ins> = ".$antoword." </strong><br><br>";
			
			$sql54 = mysql_query("SELECT * FROM tbl_all_words_gj WHERE word='$antoword'");  
			$items54 = array();
			$count = 1;
			While($row54 = mysql_fetch_array($sql54))
			{  
				$cars54=array($row54['synset_id']);
				foreach($cars54 as $username54)
				{
					$items54[] = $username54;
				}
			}
			$unique_arr54 = array_unique($items54);
			$unique_array54  = array_values($unique_arr54);
			$c54 = count ($unique_array54);
			$count = 1;
			for ($x = 0; $x<$c54; $x++)
			{
				$sql55 = mysql_query("SELECT * FROM tbl_all_gujarati_synset_data WHERE synset_id='$unique_array54[$x]'");
				While($row55 = mysql_fetch_array($sql55))
				{
					echo $count.". Synset ID = ".$row55['synset_id']."<br> Synsets = ".$row55['synset']."<br> Gloss = ".$row55['gloss']."<br> POS Category = ".	$row55['category']."";
					echo "<br><br>";
					$count++;
				}	
			}	
		}
	}
	else
	{
		//echo "The <font size='4' color='#880000'><strong><ins>Antonymy</ins><strong></font> relation for the given word is <b><font color='red'>NOT PRESENT</font></b><br><br>";
	}
	echo "<br><br>";

	
	mysql_close($db);
?>

</html>