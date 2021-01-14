<!-- Simple PHP - MySQL - Bootstrap blogging system -->
<?php
require "db.php";

$sql = "SELECT * FROM comment WHERE post_id = '$_GET[id]'";
$execution = mysqli_query($db, $sql) or die(mysqli_error($db));
if(mysqli_num_rows($execution)>0){
  while($comment = mysqli_fetch_assoc($execution)){
    $c_email = $comment['email'];
    $c_comment = $comment['comment'];
    //$c_date = $comment['commentdate'];
    $new_datetime = DateTime::createFromFormat ( "Y-m-d H:i:s", $comment["commentdate"] );
    ?>
