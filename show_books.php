<center><h3>SHOW BOOKS FROM LIBRARY</h3></center>
<?php
    require_once("header.php");
		$qUs = "SELECT * FROM `books`";
		$books_show = $conn ->query($qUs);
		$fbooks = $books_show ->fetchAll(PDO::FETCH_OBJ);
?>
		<table border="1">
			<tr>
				<th>ID</th>
				<th>TITLE</th>
				<th>AUTHOR</th>
				<th>PUBLISHER</th>
				<th>PUBLISHED ON</th>
				<th>GENRE</th>
				<th>ISBN</th>
				<th>NUMBER OF COPIES</th>
			</tr>
		<?php
			foreach ($fbooks as $book) {
		?>
			<tr>
				<td>
					<?php echo $book->id;?>
				</td>
				<td>
					<?php echo $book->Title;?>
				</td>
				<td>
					<?php echo $book->Author;?>
				</td>
				<td>
					<?php echo $book->Publisher_id;?>
				</td>
				<td>
					<?php echo $book->Published_on;?>
				</td>
				<td>
					<?php echo $book->Genre;?>
				</td>
				<td>
					<?php echo $book->ISBN;?>
				</td>		
				<td>
					<?php echo $book->Number_of_copies;?>
				</td>
			</tr>
					<?php
				}
			?>
		</table>
	

