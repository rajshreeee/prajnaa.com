<?php
SESSION_START();
include 'connect.php';
include 'comment.php';

?>
<Html>
<Head>
<link rel="stylesheet" type="text/css" href="proj.css">
<link rel="stylesheet" type="text/css" href="project.css">
</Head>
<Body>
<br>
<br>
<?php
$cid=$_POST['cid'];
$uid=$_POST['uid'];
$_SESSION['cid']=$cid;
echo "<form method='POST' action='".setreply($connect)."'>
   <input type='hidden' name='cid' value=".$cid.">
   <input type='hidden' name='uid' value=".$uid.">
   <textarea name='message'></textarea>
   <br>
   <button type='submit' name='commentReply'>Replies</button>
   </form>";
  getreply($connect);
  echo "Click <a href='my1.php'>Here</a> to go back";
 ?>
</Body>
</Html>
