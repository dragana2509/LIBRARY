<?php
	$qUs = "SELECT * FROM `users`";
	$user = $conn ->query($qUs);
	$fUs = $user ->fetchAll(PDO::FETCH_OBJ);
?>
	<table border="1">
		<tr>
			<th>ID</th>
			<th>USERNAME</th>
			<th>NAME</th>
			<th>SURNAME</th>
			<th>BOOK TITLE</th>
			<th>PUBLISHER</th>
			<th>RENTED BOOKS</th>
			<th>EMAIL</th>
		</tr>
<?php
	foreach ($fUs as $u) {
?>
	<tr>
		<td>
			<a href="admin.php?action=profile&pid=
				<?php echo $u ->id; ?>">
				<?php echo $u->id;?>
			</a>
		</td>
		<td>
			<a href="admin.php?action=profile&pid=
				<?php echo $u ->id; ?>">
				<?php echo $u->username;?>
			</a>
		</td>
		<td>
			<a href="admin.php?action=profile&pid=
				<?php echo $u ->id; ?>">
				<?php echo $u->Name;?>
			</a>
		</td>
		<td>
			<a href="admin.php?action=profile&pid=
				<?php echo $u ->id; ?>">
				<?php echo $u->Surname;?>
			</a>
		</td>
		<td>
			<a href="admin.php?action=profile&pid=
				<?php echo $u ->id; ?>">
				<?php echo $u->Book_title;?>
			</a>
		</td>
		<td>
			<a href="admin.php?action=profile&pid=
				<?php echo $u ->id; ?>">
				<?php echo $u->Publisher;?>
			</a>
		</td>
		<td>
			<a href="admin.php?action=profile&pid=
				<?php echo $u ->id; ?>">
				<?php echo $u->Rented;?>
			</a>
		</td>
		<td>
			<a href="admin.php?action=profile&pid=
				<?php echo $u ->id; ?>">
				<?php echo $u->eMail;?>
			</a>
		</td>
	</tr>
<?php
	}
?>
	</table>
