<?php
	$err1 ="";
	if(isset($_POST['submit_login'])){
		if(!empty($_POST['username'])){
			$qUserName="SELECT * FROM `users` WHERE `username`=:username";
			$user = $conn -> prepare($qUserName);
			$user ->execute(array(
				':username'=> $_POST['username']));
			//prebrojavanje username u bazi
			if ($user->rowCount()>=2) {
				$err1 .="Error, please contact admin!<br>";
			} elseif ($user->rowCount()==0){
				$err1 .="Username does not exist, please make a <a href = 'index.php?action=register'>Registration!</a><br>";
			}
		} else{
			$err1 .="Username is required!<br>";
		}

		if(!empty($_POST['pass']) && empty($err1)){
			$qAccount = "SELECT * FROM `users` WHERE `username`= :username AND `password`=:pass";
			$statement = $conn->prepare($qAccount);
			$statement ->execute(array(
					':username'	=> $_POST['username'], ':pass' =>md5($_POST['pass'])));
			//prebrojavanje username   - passworda u bazi
			if($statement->rowCount()==1){
				//ne postoji greska vrsi se prijava
				$user = $statement->fetch();
				$_SESSION['id'] = $user['id'];
				if($user['username'] =="admin"){
					header("Location:admin.php");
				} else{
					header("Location:home.php");
				}
			} elseif ($user->rowCount()>=2) {
				$err1 .="Error, please contact admin!<br>";
			} else{
				$err1 .="Username/Password is not correct, please try again! <br>";
			}
		} else{
			$err1 .="Password is required!<br>";
		}
		if(!empty($err1)){
			echo $err1;
		}
	}	
?>
<form method="POST", action="index.php?action=login">
	<h3>Login form</h3>
	Username: <br>
	<input type="text" name="username"> <br>
	Password: <br>
	<input type="password" name="pass"><br>
	<input type="submit" role="button" class="btn btn-primary" name="submit_login" value="Log In">
</form>