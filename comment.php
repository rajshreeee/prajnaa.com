<?php
$jad=0;
FUNCTION setcomments($connect)
{  
  if(isset($_POST['commentSubmit']))
  { $uid=$_POST['uid'];
	$post_id=$_GET['id'];
    $message=$_POST['message'];
    $sqld=mysql_query("INSERT INTO chat(uid,message,post_id) VALUES('$uid','$message','$post_id')");
    if(!$sqld)
	{
		echo "Datas coulnot be inserted";
	}
}
}
FUNCTION getcomments($connect)
{
	$post_id=$_GET['id'];
	$result=mysql_query("SELECT * FROM chat WHERE post_id='$post_id'");
	
	while($row=mysql_fetch_assoc($result)){
		
			$iod=$row['uid'];
			
			   $resultl=mysql_query("SELECT * FROM users WHERE id='$iod'");
			   if($rowl=mysql_fetch_assoc($resultl))
			   {
				   
			   echo  "<img src='$rowl[profile_pic]' width='50' height='50'>";
			   echo $rowl['username']."<br>";
			   echo nl2br($row['message'])."<br>";
			  
			   }
		
	
	  
        
	     echo "<form class='delete-button' method='POST' action='".deletecomments($connect)."'>
		<input type='hidden' name='cid' value='".$row['cid']."'>
		<button  name='commentDelete'>Delete</button>
		</form><form class='edit-button' method='POST' action='editcomment.php'>
		<input type='hidden' name='cid' value='".$row['cid']."'>
		<input type='hidden' name='uid' value='".$row['uid']."'>
		<input type='hidden' name='message' value='".$row['message']."'>
		<button>Edit</button>
		</form>
		<form class='reply-button' method='POST' action='reply.php'>
		<input type='hidden' name='cid' value='".$row['cid']."'>
	    <input type='hidden' name='uid' value='".$_SESSION['id']."'>
        <button>Reply</button>
		</form>";
		
	   
	}
}
FUNCTION editcomments($connect)
{
  if(isset($_POST['commentSubmit']))
  { $cid=$_POST['cid'];
    $uid=$_POST['uid'];
    $message=$_POST['message'];
    $sqlda=mysql_query("UPDATE chat SET message='$message' WHERE cid='$cid'" );
	if(!$sqlda)
	{
		echo "Datas coulnot be edited";
	}
	header("Location:topic.php");
  }
}
FUNCTION  deletecomments($connect)
{
  if(isset($_POST['commentDelete']))
  { $cid=$_POST['cid'];
    $sqlda=mysql_query("DELETE FROM chat WHERE cid='$cid'" );
	 if(!$sqlda)
	{
		echo "Datas coulnot be deleted";
	}
	header("Location:post.php");
  }
}
FUNCTION setreply($connect)
{  
  if(isset($_POST['commentReply']))
  { 
    $uid=$_POST['uid'];
    $message=$_POST['message'];
	$reply_id=$_POST['cid'];
	$GLOBALS['jad']=$reply_id;
	$sqld=mysql_query("INSERT INTO chat(uid,message,replyid) VALUES('$uid','$message','$reply_id')");
	$_SESSION['cid']=$uid;
    if(!$sqld)
	{
		echo "Datas coulnot be inserted";
	}
  header("Location:topic.php");
}
FUNCTION getreply($connect)
   { $reply_id=$_SESSION['cid'];
	$sql="SELECT * FROM chat WHERE replyid='$reply_id'";
	$result=mysql_query($sql);
	while($row=mysql_fetch_assoc($result))
	{  $iod=$row['uid'];
       $sqll="SELECT * FROM users WHERE id='$iod'";
       $resultl=mysql_query($sqll);
	   if($rowl=mysql_fetch_assoc($resultl))
	   {
       echo "<div class='comment-box'><p>" ;
	   echo $rowl['username']."<br>";
	   echo nl2br($row['message'])."<br>";
	   echo "</p>";
	   if(isset($_SESSION['id']))
	   {  
         if($_SESSION['id']==$rowl['id'])
		 { 
	     echo "
		<form class='edit-button' method='POST' action='editcomment.php'>
		<input type='hidden' name='cid' value='".$row['cid']."'>
		<input type='hidden' name='uid' value='".$row['uid']."'>
		<input type='hidden' name='message' value='".$row['message']."'>
		<button>Edit</button>
		</form>";
		}
}
	   echo "</div>";
	   }
    }
}

}