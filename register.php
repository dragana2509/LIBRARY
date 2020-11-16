<?php
	$err = "";
	if(isset($_POST['submit_reg'])){
		
		if(!empty($_POST['username'])){
			$UserName = "SELECT * FROM `users` WHERE `username`= :username";
			$users= $conn->prepare($UserName);
			$users->execute(array(
						':username'=>$_POST['username']
							));
			
			if($users->rowCount()){
				$err .="username already exists, please choose other! <br>";
			} else {
				$username = $_POST['username'];
			}
		} else {
			$err .="- You must enter your username! <br>";
		}	

		if(!empty($_POST['pass'])){
			
		} else {
			$err .="- You must enter your password! <br>";
		}	
		if(!empty($_POST['Repass'])){
			
		} else {
			$err .="- You must repeat your password! <br>";
		}	

		if(!empty($_POST['pass']) && !empty($_POST['Repass'])){
			if($_POST['pass'] == $_POST['Repass']){
				$password = md5($_POST['pass']);
			} else {
				$err .="Your passwords must be the same! <br>";
			}
		}
		if(!empty($_POST['name'])){
			$name = $_POST['name'];
		} else {
			$err .="- You must enter your name! <br>";
		}	
		if(!empty($_POST['surname'])){
			$surname = $_POST['surname'];
		} else {
			$err .="- You must enter your surname! <br>";
		}	

		if(!empty($_POST['eMail'])){
			$UserName = "SELECT * FROM `users` WHERE `eMail`=:eMail";
			$users = $conn->prepare($UserName);
			$users->execute(array(
						':eMail'=>$_POST['eMail']
							));
			if($users->rowCount()){
				$err .="eMail already exists, please choose other! <br>";
			} else {
				$eMail = $_POST['eMail'];
			}
		} else {
			$err .="- You must enter your email! <br>";
		}	

		if(!empty($_FILES['avatar']['tmp_name'])){
			// detektovanje imena slike i privremeni naziv
			$folder = "Pictures_registration/";
			$folder = $folder . basename($_FILES['avatar']['name']);
			$tmpName = $_FILES['avatar']['tmp_name'];
			$part_name = pathinfo($_FILES['avatar']['name']);
			$ext = $part_name['extension'];
			//provera extenzije da li je jpg png gif if natredbom

			//random name za profilne slike
			$first =rand(1,100000);
			$second =rand(1,100000);
			$third =rand(1,100000);
			$rand_name = $first ."-" .$second . "-" .$third .".".$ext;
			$final = "Pictures_registration/" .$rand_name;
		} else{
			$err .="Upload profile picture! ";
		}
		if($err <> ""){
			echo $err ;
		} else {
			if(move_uploaded_file($tmpName, $final)){
					$queryUsers = "INSERT INTO `users` 
							SET `username`=:username,
							 `password` =:password,
							 `name`=:name,
							 `surname`=:surname,
							 `eMail`=:eMail,
							 `avatar`=:avatar
					";
					$statement = $conn->prepare($queryUsers);
					$statement->execute(array(
							':username'=>$username,
							':password'=>$password,
							':name'=>$name,
							'surname'=>$surname,
							':eMail'=>$eMail,
							':avatar'=>$final
					));
				} else {
					$qUsers = "INSERT INTO `users` 
							SET `username`=:username,
							 `password` =:password,
							 `name`=:name,
							 `surname`=:surname,
							 `eMail`=:eMail,
							 `avatar`=:avatar
					";
					$stmt = $conn->prepare($qUsers);
					$stmt->execute(array(
							':username'=>$username,
							':password'=>$password,
							':name'=>$name,
							'surname'=>$surname,
							':eMail'=>$eMail,
							':avatar'=>"Pictures_registration/default.png"
					));
				}
			echo "Successfully signed in";
			header("Location:index.php?action=login");
		}	
	}
?>

<form method="POST", action="index.php?action=register" enctype="multipart/form-data"> 
	<table>
		<tr>
			<td>
				Username:
			</td>
			<td>
				<input type="text" name="username"/>
			</td>

		</tr>
		<tr>
			<td>
				Password:
			</td>
			<td>
				<input type="password" name="pass"/>
			</td>

		</tr>
		<tr>
			<td>
				RePassword:
			</td>
			<td>
				<input type="password" name="Repass"/>
			</td>

		</tr>
		<tr>
			<td>
				Name:
			</td>
			<td>
				<input type="text" name="name"/>
			</td>

		</tr>
		<tr>
			<td>
				Surname:
			</td>
			<td>
				<input type="text" name="surname"/>
			</td>

		</tr>
		<tr>
			<td>
				eMail:
			</td>
			<td>
				<input type="text" name="eMail"/>
			</td>

		</tr>
		<tr>
			<td>
				Profile Photo:
			</td>
			<td>
				<input type="file" name="avatar" id="avatar"/>
			</td>

		</tr>
		<tr>
			<td>
				<input type="submit" name="submit_reg", value="Sign up" />
			</td>
		</tr>
	</table>
</form>