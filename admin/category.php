<?php
require('db.php');
session_start();
if(!isset($_SESSION['user_id']))
{
	header("Location:index.php");
}
?>
<?php
if(isset($_POST['submit']))
{
	date_default_timezone_set('Asia/Manila');
	$time = time();
	$dateTime = strftime('%Y-%m-%d', $time);
	$category = mysqli_real_escape_string($db, $_POST['categoryName']);
	$categoryLength = strlen[$category];
	$admin = $_SESSION['name'];

	if(empty($category)){
		echo '<script>alert("All Fields must be fill out")</script>';
		header("Location: category.php");
	}

	else{
		$query = "INSERT INTO category (catdate, name, owner) VALUES ('$dateTime', '$category', '$admin')";
		$execution = mysqli_query($db, $query) or die(mysqli_error($db));
		if($execution){
			echo '<script>alert("CATEGORY ADDED SUCCESSFULLY")</script>';
			header("Location: category.php");
		}
		else{
			echo '<script>alert("SOMETHING WENT WRONG PLEASE TRY AGAIN")</script>';
			header("Location: category.php");
		}
	}
}

if(isset($_GET['delete_attempt'])){
	if(!empty($_GET['delete_attempt'])){
		$sql = "DELETE FROM category WHERE id = $_GET[delete_attempt]";
		$execution = mysqli_query($db, $sql) or die(mysqli_error($db));
		if($execution){
			echo '<script>alert("CATEGORY DELETED SUCCESSFULLY")</script>';
			header("Location: category.php");
		}
		else{
			echo '<script>alert("SOMETHING WENT WRONG PLEASE TRY AGAIN")</script>';
			header("Location: category.php");
		}
	}
}
include "../head.php";
 ?>
<body>
	<!-- Class Blog = Main Div Except Footer -->
	<?php
	include "sidebar.php";
	 ?>
			<div class="container">


			<div class="blog">


			<div class="col-sm-12">

						<!-- Add Category -->
						<h3 class="post-heading">MANAGE CATEGORY</h3>

						<form action="category.php" method="POST" enctype="multipart/form-data" name="categoryform">
							<fieldset>
								<div class="form-group">
									<label for="postTitle">NAME</label>
									<input type="text" name="categoryName" id="categoryName" class="form-control" placeholder="Add New Title" required>
								</div>

								<div class="form-group">
									<input type="submit" name="submit" class="btn btn-info" value="ADD" ng-disabled = "categoryform.$invalid">
								</div>
							</fieldset>
						</form>
						<!-- Add Category ENDS -->

						<h3 class="post-heading">CATEGORY LIST</h3>
						<div class="overflowTable">
						<table id="dtHorizontalExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
							<thead class="thead-dark">
								<tr>
									<th>No.</th>
									<th>Name</th>
									<th>Date Added</th>
									<th>Added By</th>
									<th>Delete</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$num = 1;
								$sql = "SELECT * FROM category ORDER BY id DESC";
								$execution = mysqli_query($db, $sql) or die(mysqli_error($db));
								while($result = mysqli_fetch_assoc($execution)){
									$cat_id = $result['id'];
									$cat_dateTime = $result['catdate'];
									$cat_name = $result['name'];
									$cat_admin = $result['owner'];
									echo "
										<tr>
											<td>$num</td>
											<td>$cat_name</td>
											<td>$cat_dateTime</td>
											<td>$cat_admin</td>
											<td><a href='category.php?delete_attempt=$cat_id'><button class='btn btn-danger'><i class='far fa-trash-alt'></i></button></a></td>
										</tr>
									";
									$num++;
								}
								?>

							</tbody>
						</table>


					</div>
				</div>
				</div>
			</div>
		</div>
		<!-- Sidebar ENDS -->

	</div>

	<script type="text/javascript">

		function IsValidCatName(catname){
			if(catname == ""){
				return false;
			}
			else{
				return true;
			}
		}


		function ValidCat(){
			var catname = document.getElementById("catname").value;

			if(!IsValidCatName(catname)){
				alert("Category Title Required");
			}

			else{
				alert("Thankyou");
			}
		}
	</script>

	<!-- Script Files -->
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
