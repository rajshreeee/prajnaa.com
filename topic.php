<?php 
	session_start();
	require ('connect.php');
	require ('comment.php');
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
	<?php
		if($_GET["id"]){
			$check = mysql_query("SELECT * FROM topics WHERE topic_id='".$_GET['id']."'");
			if(mysql_num_rows($check)){
				while ($row = mysql_fetch_assoc($check)){
					$check_u = mysql_query("SELECT * FROM users WHERE username='".$row['topic_creator']."'");
					while($row_u = mysql_fetch_assoc($check_u)){
						$user_id = $row_u['id'];
					}
					echo "<h1>".$row['topic_name']."</h1>";
					echo "<h5>By<a href='profile.php?id=$user_id'>".$row['topic_creator']."</a><br/>Date:".$row['date']."</h5>";
					echo "<br/>".$row['topic_content'];
				}
			}else{
				echo "Topic not found.";
			}
		}else{
				header("Location: index.php");
		}
		
	?>
	<body>
	
	
	<?php
		
			$check_uu = mysql_query("SELECT * FROM users WHERE username='".$_SESSION["username"]."'");
			while($row_uu = mysql_fetch_assoc($check_uu)){
				$user_idd = $row_uu['id'];
			}
		echo "<br><br><form method='POST' action='".setcomments($connect)."'>
		<input type='hidden' name='uid' value=$user_idd>
		<textarea name='message'></textarea>
		<br>
		<button type='submit' name='commentSubmit'>ADD A COMMENT</button>
		</form>";
	    
		
	?>
	<?php getcomments($connect);?>
	
	
	</body>
	
</html>
<?php
		
	}else{
		echo "You must be logged in.";
	}
?>