<!-- Simple PHP - MySQL - Bootstrap blogging system -->
<?php
require('db.php');

if(isset($_POST['submit'])){
	if(!empty($_POST['submit'])){
		date_default_timezone_set('Asia/Manila');
		$postid = $_POST['id'];
		$email = $_POST['email'];
		$comment = $_POST['comment'];
		$comment1 = addslashes($comment);
		$sql = "INSERT INTO comment (email, comment, post_id) VALUES ('$email', '$comment1', '$postid')";
		$execution = mysqli_query($db, $sql) or die(mysqli_error($db));
		if($execution){
			header("Location: single.php?id=$postid");
		}
		else{
			echo '<script>alert("Something Went Wrong!!!")</script>';
		}

	}
}
?>
