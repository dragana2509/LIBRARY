<?php 
require_once("header.php");
require_once("user_menu.php");
 ?>
<div class="jumbotron">
	<?php
		$qUs = "SELECT * FROM `books`";
		$users = $conn->query($qUs);
		$fUs = $users->fetchAll(PDO::FETCH_OBJ);
	?>
	<table border="1" >
		<tr>
			<th>ID</th>
			<th>TITLE</th>
			<th>AUTHOR</th>
			<th>PUBLISHER</th>
			<th>PUBLISHED ON</th>
			<th>GENRE</th>
			<th>ISBN</th>
			<th>NUMBER OF PAGES</th>
			<th>NUMBER OF COPIES</th>
			<th>PICTURE</th>
		</tr>
	<?php
		foreach ($fUs as $u) {
	?>
		<tr>
			<td>
				<?php echo $u->id;?>
			</td>
			<td>
				<a href="home.php?action=rent">
				<?php echo $u->Title;?>
				</a>		
			</td>
			<td>
				<?php echo $u->Author;?>
			</td>
			<td>
				<?php echo $u->Publisher_id;?>
			</td>
			<td>
				<?php echo $u->Published_on;?>
			</td>
			<td>
				<?php echo $u->Genre;?>
			</td>
			<td>
				<?php echo $u->ISBN;?>
			</td>
			<td>
				<?php echo $u->Number_of_pages;?>
			</td>
			<td>
				<?php echo $u->Number_of_copies;?>
			</td>
			<td>
				<a href="home.php?action=rent"><?php echo "<img src='". $u->Avatar ."' width='200'> <br>";?></a>
			</td>
		</tr>
<?php
	}
?>
	</table>				
