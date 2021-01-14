<?php
require('db.php');
session_start();
if(!isset($_SESSION['user_id']))
{
	header("Location:index.php");
}
?>
<?php
$id=$_GET["id"];
if(isset($_SESSION['user_id']))
{

	$sql = "DELETE FROM comment WHERE id = '$id'";
	$execution = mysqli_query($db, $sql) or die(mysqli_error($db));
  header("Location: comments.php");
}else{
  header("Location:index.php");
}
