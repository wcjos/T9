

<html>
<head>
<title>apachefriends.org cd collection</title>
<link href="xampp.css" rel="stylesheet" type="text/css">
</head>

<body>

&nbsp;<p>


<?
	/*
	*	Includes
	*/
	include_once("t9input.class.php");

	/*
	*	Database Conection
	*/

	if(!mysql_connect("localhost","root",""))
	{
		echo "<h2>".$TEXT['cds-error']."</h2>";
		die();
	}
	mysql_select_db("phonebook");
?>


<h2><?=$TEXT['cds-head1']?></h2>

<table border=0 cellpadding=0 cellspacing=0>
<tr bgcolor=#008B8B>

<td class=tabhead><br><b>First Name</b></td>
<td class=tabhead><br><b>Last Name</b></td>
<td class=tabhead><br><b>Phone</b></td>
<td class=tabhead><br><b>Delete</b></td>

</tr>


<?
	/**
	*
	*/
	if($_REQUEST['id_lastname']!="")
	{
		
		if($phonenumber=="")$phonenumber="NULL";
		
		$firstname=htmlentities($_REQUEST['id_firstname']);
		$lastname=htmlentities($_REQUEST['id_lastname']);
		$phonenumber=htmlentities($_REQUEST['id_phonenumber']);

		mysql_query("INSERT INTO contacts (firstName,lastName,phoneNumber) VALUES('$firstname','$lastname','$phonenumber');");
	}


	if($_REQUEST['action']=="del")
	{
		mysql_query("DELETE FROM contacts WHERE id=".round($_REQUEST['id']));
	}



	$result=mysql_query("SELECT id,firstName,lastName,phoneNumber FROM contacts ORDER BY lastName;");
	
	$i=0;
	while( $row=mysql_fetch_array($result) )
	{
		if($i>0)
		{
			echo "<tr valign=bottom>";
			
			echo "</tr>";
		}
		echo "<tr valign=center>";
		
		echo "<td class=tabval><b>".$row['firstName']."</b></td>";
		echo "<td class=tabval>".$row['lastName']."&nbsp;</td>";
		echo "<td class=tabval>".$row['phoneNumber']."&nbsp;</td>";
		echo "<td class=tabval><a onclick=\"return confirm('Are you sure?');\" href=index.php?action=del&id=".$row['id'].">Delete</span></a></td>";
		echo "<td class=tabval></td>";
		echo "</tr>";
		$i++;

	}

	echo "<tr valign=bottom>";
    
    echo "</tr>";



?>

</table>



<form action=index.php method=get>
<table border=0 cellpadding=0 cellspacing=0>
<tr><td>First Name:</td><td><input type=text size=30 name=id_firstname></td></tr>
<tr><td>LastName :</td><td> <input type=text size=30 name=id_lastname></td></tr>
<tr><td>Phone Number:</td><td> <input type=text size=5 name=id_phonenumber></td></tr>
<tr><td></td><td><input type=submit border=0 value="Add"></td></tr>

<tr><td>Phone Number:</td><td> <input type=text size=5 name=id_search></td></tr>
<tr><td></td><td><input type=submit border=0 value="Search"></td></tr>

<table border=0 cellpadding=0 cellspacing=0>

<tr bgcolor=#008B8B>

<td class=tabhead><br><b>First Name</b></td>
<td class=tabhead><br><b>Last Name</b></td>
<td class=tabhead><br><b>Phone</b></td>
<td class=tabhead><br><b>Delete</b></td>

<?
	if($_REQUEST[id_search]!="")
	{
		$query_Result=mysql_query("SELECT id,firstName,lastName,phoneNumber FROM contacts ORDER BY lastName;");

		
		$i=0;
		while( $row=mysql_fetch_array($query_Result) )
		{
			if($i>0)
			{
				echo "<tr valign=bottom>";
				echo "</tr>";
			}
			echo "<tr valign=center>";
			$fullnames.=$row['firstName']."|".$row['lastName']."|";
			$i++;
		}
		$o_t9input = new T9input();
		$input = $_REQUEST['id_search'];
		$o_t9input->addDB($fullnames, str_split($o_t9input->key[$input[0]]));
		$result = $o_t9input->translate($input);
		$result_lenght = sizeof($result);
		$result_count =0;
		
		$id_repeated = "";
		while($result_count < $result_lenght )
		{
			$current_value = $result[$result_count];
			$current_query = mysql_query("SELECT id,firstName,lastName,phoneNumber FROM contacts WHERE firstName = '$current_value' OR lastName = '$current_value'");
			while( $row=mysql_fetch_array($current_query) )
			{
				if($result_count>0)
				{
					echo "<tr valign=bottom>";
					
					echo "</tr>";
				}
				$id_current = $row['id'];
				
				if(	strpos($id_repeated,$id_current)!==false )
				{
				}
				else
				{
					echo "<tr valign=center>";
					echo "<td class=tabval><b>".$row['firstName']."</b></td>";
					echo "<td class=tabval>".$row['lastName']."&nbsp;</td>";
					echo "<td class=tabval>".$row['phoneNumber']."&nbsp;</td>";

					echo "<td class=tabval><a onclick=\"return confirm('Are you sure?');\" href=index.php?action=del&id=".$row['id'].">Delete</span></a></td>";
					echo "<td class=tabval></td>";
					echo "</tr>";
					
				}
				$id_repeated .= $row['id']."|";
			}
			$result_count++;

		}
	}

?>


</table>
</form>


</body>
</html>

