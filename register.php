<html>
<head><title> Register an account </title></head>
<body>
	<form action="register.php" method="POST">
		Username:<input type="text" name="username">
		<br/>Password: <input type="password" name="password">
		<br/>Confirm password:<input type="password" name="repassword">
		<br/>Email:<input type="text" name="email">
		<br/><input type="submit" name="submit" value="Register"> or <a href="login.php">Login</a>
	</form>
</body>
<?php
require('connect.php');
$username = @$_POST['username'];
$password = @$_POST['password'];
$repass = @$_POST['repassword'];
$email = @$_POST['email'];
$date = date ("Y-m-d");
$pass_en = sha1($password);
if(isset($_POST['submit'])){
	if($username && $password && $repass && $email) {
		if(strlen($username)>=5 && strlen($username) <25 && strlen($password)>6){
			if($repass == $password) {
				if($query = mysql_query("INSERT INTO users (`id`, `username`, `password`, `email`, `date`) VAlUES('','".$username."','".$pass_en."','".$email."','".$date."')")){
					echo "You have been registered. Click <a href='login.php'>here</a> to login";
				}else{
					echo "Failure.";
				}
			}else{
				echo "Passwords do not match.";
			}
	   }else{
			if(strlen($username)<5 || strlen($username)>25){
				echo "Username must be between 5 and 25 characters.";
			}
			if(strlen($password)<6){
				echo "Password must be longer than 6 characters";
			}
		}
	} else {
		echo "Please fill in all the fields.";
	}
}
?>
</html>