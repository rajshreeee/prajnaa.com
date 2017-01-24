<?php 
	session_start();
	require ('connect.php');
	if(@$_SESSION["username"]){
?>
<html>
	<head>
	<title> Home page </title>
	</head>
	
	<body>
	<?php include ("header.php");
	echo "<center><h1>Members</h1>";
	$check = mysql_query("SELECT * FROM users");
	$rows = mysql_num_rows($check);
	while($row = mysql_fetch_assoc($check)){
		$id = $row['id'];
		echo "<a href='profile.php?id=$id'>".$row['username']."</a><br/>";
	}
	echo "</center>";
	?>
	
	</body>
	
</html>
<?php
	if(@$_GET['action'] == "logout"){
			
		
			session_destroy();
			header("Location: login.php");
	}
	
	}else{
		echo "You must be logged in.";
	}
?>