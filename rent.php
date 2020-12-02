<?php
	require_once("header.php");
	$id_user =$_SESSION['id'];
?>
<hr>
<?php
	$q = "SELECT id, Title FROM books ";
	$stmt = $conn->prepare($q);
	$stmt->execute();
	$books = $stmt->fetchAll();
	
    if(isset($_POST['submit'])){
    	$id_book = $_POST['cbx_books'];
		$q = "SELECT id, Title, Publisher_id, Number_of_copies FROM books WHERE id=:id_book"; 
		$qData = [
			":id_book"=>$id_book
		];
		$stmt = $conn->prepare($q);
		$stmt->execute($qData);
		$bookInfo = $stmt->fetch(PDO::FETCH_OBJ);

		$q2 = "SELECT SUM(number_rented_books) AS `total_rented` FROM `rent` WHERE `book_id`=:id_book";
		$stmt1=$conn->prepare($q2);
		$stmt1->execute(array(
			":id_book"=>$id_book
		));
		$resultRented = $stmt1->fetch();
		$alreadyRented = $resultRented[0];
		
		if($alreadyRented > $bookInfo->Number_of_copies){
			echo "You can't rent new books until you return the rented books!";
		} else{
			$newBooksToRent = $_POST['number_books'];
			
			if($newBooksToRent > $bookInfo->Number_of_copies - $alreadyRented){
				echo " There are not enough avaliabe books";

			} else{
				$q1 = "SELECT `number_rented_books` FROM `rent` WHERE `user_id`= :user_id AND `book_id`=:book_id";
				$statement = $conn->prepare($q1);
				$statement->execute(array(
					":user_id"=>$id_user,
					":book_id"=>$id_book
				)); 
				$result = $statement->fetch(PDO::FETCH_OBJ);
				
				
				if($result != false){
					$query = "UPDATE rent SET `number_rented_books` =:new_rent_number
										WHERE `user_id`= :user_id 
										AND `book_id`=:book_id";
										$statement = $conn->prepare($query);
						$statement->execute(array(
									":new_rent_number"=>$newBooksToRent + $result->number_rented_books,
									":user_id"=>$id_user,
									":book_id"=>$id_book
								));
				} else{
					$query = "INSERT INTO rent SET 
										`number_rented_books` =:new_rent_number,
										`user_id`= :user_id,
										`book_id`=:book_id";
					$statement = $conn->prepare($query);
					$statement->execute(array(
								":new_rent_number"=>$newBooksToRent,
								":user_id"=>$id_user,
								":book_id"=>$id_book
					));
				}
				echo "Rented successfully!";
		}
	}
}	
?>
<center><h3>RENT A BOOK</h3></center>
<form method="POST" action="home.php?action=rent" enctype="multipart/form-data"> 
	<div>Choose the book:
		<select id="cbx_books" name="cbx_books">
			<option value="0">Choose the book</option>
			<?php foreach ($books as $book){ ?>
				<option value="<?php echo $book['id']; ?>"><?php echo $book['Title']; ?></option>
			<?php } ?>
		</select>
	</div>
	<div>How many books:
		<input type="text" name="number_books" value="0"> <br>
		<input type="submit" name="submit" value="Rent a book">
	</div>
</form>
<?php
require_once("recommended.php");
?>