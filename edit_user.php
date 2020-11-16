<center><h3><b>EDIT USER</b></h3></center>
<?php	
	include_once("conn.php");
	include_once("header.php");
?>
<?php
	$id_edit = $_GET['id'];
	$query = "SELECT * FROM `users`  WHERE `id` = $id_edit";
	$user = $conn ->query($query);
	$row = $user ->fetchAll(PDO::FETCH_OBJ);

		foreach ($row as $u){
				$id = $u->id;
				$username = $u->username;
				$password = $u->password;
				$name = $u->Name;
				$surname = $u->Surname;
				$email = $u->eMail;
	}
		if (isset($_POST['submit'])) {
			$username_form = $_POST['username'];
			$password_form = md5($_POST['password']);
			$name_form = $_POST['name'];
			$surname_form = $_POST['surname'];
			$email_form = $_POST['email'];

			if (!empty($username_form ) AND !empty($password_form) AND !empty($name_form) AND !empty($surname_form)and !empty($email_form)) {
				$query = "UPDATE users 
							SET `username` =:username, 
							`password` =:password, 
							`Name` =:name, 
							`Surname` =:surname , 
							`eMail` =:email
				         WHERE id =$id_edit";
				$result = $conn->prepare($query);
				$result->execute(array(":username"=>$username_form,":password"=>$password_form, ":name"=>$name_form,":surname"=>$surname_form,":email"=>$email_form));
		?>
					<meta http-equiv="refresh" content="0;url='admin.php?action=show_users'"/>
		<?php
				 die();
			} else{
				echo "No field must be empty! <br>";
			}
		}
		?>
<a href="admin.php?action=show_users">List of users</a>
<hr>
<div class="jumbotron">
<form action="edit_user.php?id=<?php echo $id_edit; ?>" method="POST">
	*Username <input type="text" name="username" value="<?php echo $username; ?>"> <br>
	*Password <input type="password" name="password" value="<?php echo $password; ?>"> <br>
	*Name <input type="text" name="name" value="<?php echo $name ; ?>"> <br>
	*Surname <input type="text" name="surname" value="<?php echo $surname ; ?>"> <br>
	*Email <input type="text" name="email" value="<?php echo $email ; ?>"> <br>
	<input type="submit" name="submit" value="Edit">
</form>
</div>
<?php
require_once("recommended.php");
?>