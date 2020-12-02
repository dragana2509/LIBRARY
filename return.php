<?php
	require_once("header.php");
	$id_user =$_SESSION['id'];
?>
<hr>
<?php
	if(isset($_POST['submit'])){
    	$id_book = $_POST['cbx_books'];
		$numberBooksForReturn = $_POST['number_books'];
		$query = "SELECT number_rented_books FROM rent WHERE book_id=:book_id AND user_id=:user_id";
		$statement = $conn->prepare($query);
		$statement->execute([
			":book_id"=>$id_book,
			":user_id"=>$id_user,
		]);
		$resultRentedBooks = $statement->fetch(PDO::FETCH_OBJ);

		if($resultRentedBooks == false){
			echo "You have not rented this book!";
		} else{
			$currentlyRented = $resultRentedBooks->number_rented_books;

			if($numberBooksForReturn > $currentlyRented){
				echo "You can not return more books than you rented!";
			} elseif($numberBooksForReturn < $currentlyRented){
				$qRent = "UPDATE rent
								SET `number_rented_books` =:number_rented_books
								WHERE user_id =:user_id
								AND book_id =:book_id"; 
				$params = [
					':number_rented_books'=>($currentlyRented - $numberBooksForReturn),
					':user_id'=>$id_user,
					':book_id'=>$id_book,
				];
				$stmt = $conn->prepare($qRent);
				$stmt->execute($params);
				echo "Thank you, you have " . ($currentlyRented - $numberBooksForReturn) . " more book(s) to return!";
			} else{
				$qRent = "DELETE FROM rent
								WHERE user_id =:user_id
								AND book_id =:book_id"; 
				$params =[
					':user_id'=>$id_user,
					':book_id'=>$id_book,
				];
				$stmt = $conn->prepare($qRent);
				$stmt->execute($params);
				echo "Thank you for returning all books!";

			} 
		}		
	}	
	$qBook = "SELECT id, Title FROM books ";
	$stmtBook = $conn->prepare($qBook);
	$stmtBook->execute();
	$books = $stmtBook->fetchAll();	
?>
<center><h3>RETURN A BOOK</h3></center>
<form method="POST" action="home.php?action=return" enctype="multipart/form-data"> 
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
	<input type="submit" name="submit" value="Return books">
</div>
</form>
<?php
require_once("recommended.php");
?>