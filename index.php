<?php 
	session_start();
	require ('connect.php');
	if(@$_SESSION["username"]){
?>
<html>
	<head>
	<title> Home page </title>
	</head>
	<?php include ("header.php");?>
	
	<center>
		
	<a href = "post.php"><button> Post topic</button></a>
	<br/>
	<br/>
	<?php echo '<table border="1px;">'; ?>
		<tr>
			<td>
			<span>ID</span>
			</td>
			<td width="400px;" style="text-align: center;">
			Name
			</td>
			<td width="80px;" style="text-align: center;">
			Creator
			</td>
			<td width="80px;" style="text-align: center;">
			Date
			</td>
		</tr>
	
	</center>
	<body>
	
	</body>
	
</html>
<?php
	$check = mysql_query("SELECT * FROM topics");
	if (mysql_num_rows($check)!=0){
		while($row = mysql_fetch_assoc($check)){
			$id = $row['topic_id'];
			echo "<tr>";
			echo "<td>".$row['topic_id']."</td>";
			echo "<td><a href='topic.php?id=$id'>".$row['topic_name']."</a></td>";
			echo "<td>".$row['topic_creator']."</td>";
			echo "<td>".$row['date']."</td>";
			echo "</tr>";

		}
	}else{
		echo "No topics found";
	}
	echo "</table>";
	if(@$_GET['action'] == "logout"){
			
			session_destroy();
			header("Location: login.php");
	}
	
	}else{
		echo "You must be logged in.";
	}
?>