<!DOCTYPE html>
<html>
<meta charset="utf-8">
			 <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
			 <meta name="description" content="Gujarati WordNet">
        <meta name="author" content="">
        
        <!-- viewport settings -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" /></head>
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
            document.getElementById("livesearch").innerHTML=xmlhttp.responseText;
            document.getElementById("livesearch").style.border="1px solid #A5ACB2";
            }
          }
            xmlhttp.open("GET","wordfind.php?q="+str,true);
            xmlhttp.send();
          }*/
</script>

<?php header('Content-Type: text/html; charset=utf-8');
	include 'connect.php';
	session_start();
	$word = $_POST["word"];
	//$word=$_GET["q"];
	/*$sql = mysql_query("SELECT * FROM words WHERE engwords='$engword'");
	if(mysql_num_rows($sql) == 1)
	{
		while($row = mysql_fetch_array($sql))
		{
			$word =$row['gujwords'];*/
			$_SESSION['word'] = $word;
			header('Location:wordfind.php');
		/*}
	}
	else
	{
		echo"<script>
			alert('Word is not Present......Please provide another word');
			window.location.href='index.html';
			</script>";
	}*/
?>

<!--input type="text" value="<?php echo $_SESSION['word']; ?>" onkeyup="showResult(this.value)">
<div id="livesearch"></div-->
</html>



					


  

