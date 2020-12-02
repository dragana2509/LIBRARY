<?php
	$qUs = "SELECT u.*, r.number_rented_books FROM `users` u
	LEFT JOIN rent r ON u.id=r.user_id";
	$statement = $conn->prepare($qUs);
	$statement->execute();
?>
	<table border="1">
		<tr>
			<th>ID</th>
			<th>USERNAME</th>
			<th>NAME</th>
			<th>SURNAME</th>
			<th>EMAIL</th>
			<th>RENTED BOOKS</th>
		</tr>
<?php
	while ($u = $statement->fetch(PDO::FETCH_OBJ)) {
?>
	<tr>
		<td>
			<a href="admin.php?action=profile&pid=
				<?php echo $u->id; ?>">
				<?php echo $u->id;?>
			</a>
		</td>
		<td>
			<a href="admin.php?action=profile&pid=
				<?php echo $u->id; ?>">
				<?php echo $u->username;?>
			</a>
		</td>
		<td>
			<a href="admin.php?action=profile&pid=
				<?php echo $u->id; ?>">
				<?php echo $u->Name;?>
			</a>
		</td>
		<td>
			<a href="admin.php?action=profile&pid=
				<?php echo $u->id; ?>">
				<?php echo $u->Surname;?>
			</a>
		</td>
		<td>
			<a href="admin.php?action=profile&pid=
				<?php echo $u->id; ?>">
				<?php echo $u->eMail;?>
			</a>
		</td>
		<td>
			<a href="admin.php?action=profile&pid=
				<?php echo $u->user_id; ?>">
				<?php echo $u->number_rented_books;?>
			</a>
		</td>
	</tr>
<?php
	}
	
?>
	</table>
