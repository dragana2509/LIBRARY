<hr>
<center><h3><b>DELETE USER</b></h3></center>
<?php	
	include_once("conn.php");
	include_once("header.php");
?>
<hr>
<?php
	$id_edit = $_GET['id'];
	$query = "SELECT * FROM `users`  WHERE `id` = $id_edit";
	$user = $conn->query($query);
	$row = $user->fetchAll(PDO::FETCH_OBJ);
	
		foreach ($row as $u){
	 		$id = $u->id;
			$username = $u->username;
			$password = $u->password;
			$name = $u->Name;
			$surname = $u->Surname;
			$email = $u->eMail;
		}
			if(isset($_POST['delete'])) {
				if($username == "admin"){
					echo "You can not delete admin! <br>";
				}else{
					$query = " DELETE FROM `users`  WHERE id =$id_edit";
					$result = $conn->prepare($query);
					$result->execute(array(":id"=>$id_edit));
				?>
				 	<meta http-equiv="refresh" content="0;url='admin.php?action=show_user_admin'"/>
				 <?php
				 die();
				}
			} elseif(isset($_POST['cancel'])) {
			 	?>
				 	<meta http-equiv="refresh" content="0;url='admin.php?action=show_user_admin'"/>
			<?php
			 die();
			 ?>
			<a href="admin.php?action=show_user_admin">List of users</a>
		<?php
			} else{
		?>
			<form action="delete_user.php?id=<?php echo $id_edit; ?>" method="POST">
				<h1>DELETE USER</h1>
					<?php
					echo "Are you sure you want to delete selected user?  <br>";
					?>
				<input type="submit" name="delete" value="Delete"> <input type="submit" name="cancel" value="Cancel">
			</form>
<?php
	}
include_once("recommended.php");
?>