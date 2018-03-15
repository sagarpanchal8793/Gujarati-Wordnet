<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
			 <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
			 <meta name="description" content="Gujarati WordNet">
        <meta name="author" content="">
        
        <!-- viewport settings -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" /></head>

<title align="center">Gujarati WordNet</title>
<link rel="stylesheet" type="text/css" href="css/proj.css">
<script>
            /*function showResult(str) {
            if (str.length==0) { 
            document.getElementById("livesearch").innerHTML="";
             document.getElementById("livesearch").style.border="0px";
            return;
            }
            if (window.XMLHttpRequest) {
              // code for IE7+, Firefox, Chrome, Opera, Safari
              xmlhttp=new XMLHttpRequest();
            } else {  // code for IE6, IE5
            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange=function() {
            if (xmlhttp.readyState==4 && xmlhttp.status==200) {
            document.getElementById("sagar").innerHTML=xmlhttp.responseText;
            document.getElementById("sagar").style.border="1px solid #A5ACB2";
            }
          }
            xmlhttp.open("GET","relations.php?q="+str,true);
            xmlhttp.send();
          }*/
</script>
  <head>
            <meta charset="utf-8">
			 <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta name="description" content="Gujarati WordNet">
        <meta name="author" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
		</head>
	<body>
	<header>
  
	<div class="header">
	<!--	<img id="inline" class="logo" src="images/somaiya1.jpg"/-->
		<h2 style="margin:38%" id="inline" class="title"> Gujarati WordNet </h2>
 
	<!--	<div id="inline">
			<img class="logo1" src="images/somaiya2.jpg"/>
		</div-->
		<br><br><br>
  </div>

  </header>
	<center><form action="wordfind.php" method='post'>
	<table align="center">
	<tr>
	<td><A HREF="#sagar">Relations</A> </td>
	<td>
		<select name='cat' width="20px" align="right">
			<option value='NOUN'>Noun</option>
			<option value='ADJECTIVE'>Adjective</option>
			<option value='VERB'>Verb</option>
			<option value='ADVERB'>Adverb</option>
			<option value="null">Show all</option>
			<option selected disabled hidden value=''>Select the category</option>
			</select>
			<button type="submit"size="5">Change</button></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td><a href="index.html">Search a New Word</a></td></tr></table>
			</form></center>
</body><br><br><br>

<?php header('Content-Type: text/html; charset=utf-8');
	include 'connect.php';
	session_start();
	//$_SESSION['word']=$_POST["word"];
	$word = $_SESSION['word'];
	//$word=$_GET["q"];
	
	$sql = mysqli_query($db, "SELECT * FROM tbl_all_words_gj WHERE word='$word'"); 
	//$sql = mysqli_query($db, "SELECT * FROM tbl_all_gujarati_synset_data WHERE synset like '$word%' ORDER BY category DESC"); 
	$items = array();
	$count = 1;
    While($row = mysqli_fetch_array($sql))
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
		if(isset($_POST["cat"])){
		$cat = $_POST["cat"];
		if($cat!="null"){
		$sql1 = mysqli_query($db, "SELECT * FROM tbl_all_gujarati_synset_data WHERE synset_id='$unique_array[$x]' and category='$cat'");}
		else{
		$sql1 = mysqli_query($db, "SELECT * FROM tbl_all_gujarati_synset_data WHERE synset_id='$unique_array[$x]'");}}
		else{
		$sql1 = mysqli_query($db, "SELECT * FROM tbl_all_gujarati_synset_data WHERE synset_id='$unique_array[$x]'");}
		While($row = mysqli_fetch_array($sql1))
		{
			echo $count.". Synset ID = ".$row['synset_id']."<br> Synsets = ".$row['synset']."<br> Gloss = ".$row['gloss']."<br> POS Category = ".$row['category']."";
			echo "<br><br>";
			$count++;
			
		}
	}
	mysqli_close($db);
?>
<!--button type="submit" value="<?php echo $_SESSION['word']; ?>" onclick="showResult(this.value)">Relations</button><div id="livesearch"></div-->

<A NAME="sagar"></A>
<?php
	include 'connect.php';
	//session_start();
$rword = $_SESSION['word'];
//$rword=$_GET["q"];
//-----------------------Hypernymy Code--------------------------------------------------------------------------------	
	echo "<br><br>";
	echo "Relations of wordnet...<br><br>";
	
	$sql11 = mysqli_query($db, "SELECT synset_id FROM tbl_all_words_gj WHERE word='$rword'");
	
	if($row11= mysqli_fetch_array($sql11))
	{
		$hyprsynid = $row11['synset_id'];
	}

	$sql12 = mysqli_query($db, "SELECT hypernymy_id FROM tbl_hypernymy WHERE synset_id='$hyprsynid'");
	
	if(mysqli_num_rows($sql12) > 0)
	{
		if($row12=mysqli_fetch_array($sql12))
		{
			$hyprid = $row12['hypernymy_id'];
		}
	
		$sql13 = mysqli_query($db, "SELECT word FROM tbl_all_words_gj WHERE synset_id='$hyprid'");
	
		if($row13=mysqli_fetch_array($sql13))
		{
			$hyprword = $row13['word'];
		}
		//echo"Hypernymy id = ".$hyprid. "<br><br> Hypernymy word = ".$hyprword." <br><br>Is for synset id ".$hyprsynid;
		echo "<strong><ins><font size='4' color='blue'>Hypernymy word</font></ins> = ".$hyprword." </strong><br><br>";
		
		$sql14 = mysqli_query($db, "SELECT * FROM tbl_all_words_gj WHERE word='$hyprword'");  
		$items14 = array();
		$count = 1;
		While($row14 = mysqli_fetch_array($sql14))
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
			$sql15 = mysqli_query($db, "SELECT * FROM tbl_all_gujarati_synset_data WHERE synset_id='$unique_array14[$x]'");
			While($row15 = mysqli_fetch_array($sql15))
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

	$sql21 = mysqli_query($db, "SELECT synset_id FROM tbl_all_words_gj WHERE word='$rword'");
	
	if($row21=mysqli_fetch_array($sql21))
	{
		$hyposynid = $row21['synset_id'];
	}
	
	$sql22 = mysqli_query($db, "SELECT hyponymy_id FROM tbl_hyponymy WHERE synset_id='$hyposynid'");
	
	if(mysqli_num_rows($sql22) > 0)
	{
		if($row22=mysqli_fetch_array($sql22))
		{
			$hypoid = $row22['hyponymy_id'];
		}
	
		$sql23 = mysqli_query($db, "SELECT word FROM tbl_all_words_gj WHERE synset_id='$hypoid'");
	
		if($row23=mysqli_fetch_array($sql23))
		{
			$hypoword = $row23['word'];
		}
	
		//echo "Hyponymy id = ".$hypoid. "<br><br> Hyponymy word = ".$hypoword." <br><br>Is for synset id ".$hyposynid;
		echo "<strong><ins><font size='4' color='#660099'>Hyponymy word</font></ins> = ".$hypoword." </strong><br><br>";
		
		$sql24 = mysqli_query($db, "SELECT * FROM tbl_all_words_gj WHERE word='$hypoword'");  
		$items24 = array();
		$count = 1;
		While($row24 = mysqli_fetch_array($sql24))
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
			$sql25 = mysqli_query($db, "SELECT * FROM tbl_all_gujarati_synset_data WHERE synset_id='$unique_array24[$x]'");
			While($row25 = mysqli_fetch_array($sql25))
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

	$sql31 = mysqli_query($db, "SELECT synset_id FROM tbl_all_words_gj WHERE word='$rword'");
	
	if($row31=mysqli_fetch_array($sql31))
	{
		$mersynid = $row21['synset_id'];
	}
	
	$sql32 = mysqli_query($db, "SELECT mero_component_object_id FROM tbl_mero_component_object WHERE synset_id='$mersynid'");
	
	if(mysqli_num_rows($sql32) > 0)
	{
		if($row32=mysqli_fetch_array($sql32))
		{
			$merid = $row32['mero_component_object_id'];
		}
	
		$sql33 = mysqli_query($db, "SELECT word FROM tbl_all_words_gj WHERE synset_id='$merid'");
	
		if($row33=mysqli_fetch_array($sql33))
		{
			$merword = $row33['word'];
		}
	
		//echo "Meronymy id = ".$merid. "<br><br> Meronymy word = ".$merword." <br><br>Is for synset id ".$mersynid;
		echo "<strong><ins><font size='4' color='green'>Meronymy word</font></ins> = ".$merword." </strong><br><br>";
		
		$sql34 = mysqli_query($db, "SELECT * FROM tbl_all_words_gj WHERE word='$merword'");  
		$items34 = array();
		$count = 1;
		While($row34 = mysqli_fetch_array($sql34))
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
			$sql35 = mysqli_query($db, "SELECT * FROM tbl_all_gujarati_synset_data WHERE synset_id='$unique_array34[$x]'");
			While($row35 = mysqli_fetch_array($sql35))
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

	$sql41 = mysqli_query($db, "SELECT synset_id FROM tbl_all_words_gj WHERE word='$rword'");
	
	if($row41=mysqli_fetch_array($sql41))
	{
		$holosynid = $row41['synset_id'];
	}
	
	$sql42 = mysqli_query($db, "SELECT holo_component_object_id FROM tbl_holo_component_object WHERE synset_id='$hyprsynid'");
	
	if(mysqli_num_rows($sql42) > 0)
	{
		if($row42=mysqli_fetch_array($sql42))
		{
			$holoid = $row42['holo_component_object_id'];
		}
	
		$sql43 = mysqli_query($db, "SELECT word FROM tbl_all_words_gj WHERE synset_id='$holoid'");
	
		if($row43=mysqli_fetch_array($sql43))
		{
			$holoword = $row43['word'];
		}
	
		//echo "Holonymy id = ".$holoid. "<br><br> Holonymy word = ".$holoword." <br><br>Is for synset id ".$holosynid;
		echo "<strong><ins><font size='4' color='#FF0099'>Holonymy word</font></ins> = ".$holoword." </strong><br><br>";
		
		$sql44 = mysqli_query($db, "SELECT * FROM tbl_all_words_gj WHERE word='$holoword'");  
		$items44 = array();
		$count = 1;
		While($row44 = mysqli_fetch_array($sql44))
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
			$sql45 = mysqli_query($db, "SELECT * FROM tbl_all_gujarati_synset_data WHERE synset_id='$unique_array44[$x]'");
			While($row45 = mysqli_fetch_array($sql45))
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

	$sql51 = mysqli_query($db, "SELECT * FROM tbl_anto_gender WHERE synset_word='$rword'");
	
	if(mysqli_num_rows($sql51) == 1)
	{ 
        if($row51 = mysqli_fetch_array($sql51))
		{
			$antosynid=$row51['synset_id'];
			$antoid=$row51['anto_gender_id'];
			$antoword=$row51['anto_gender_word'];
			//echo "Antonymy id = ".$antoid. "<br><br> Antonymy word = ".$antoword." <br><br>Is for synset id ".$antosynid;
			echo "<strong><ins><font size='4' color='#880000'>Antonymy word</font></ins> = ".$antoword." </strong><br><br>";
			
			$sql54 = mysqli_query($db, "SELECT * FROM tbl_all_words_gj WHERE word='$antoword'");  
			$items54 = array();
			$count = 1;
			While($row54 = mysqli_fetch_array($sql54))
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
				$sql55 = mysqli_query($db, "SELECT * FROM tbl_all_gujarati_synset_data WHERE synset_id='$unique_array54[$x]'");
				While($row55 = mysqli_fetch_array($sql55))
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

	
	mysqli_close($db);
?>
</div>
<br><br>
</html>