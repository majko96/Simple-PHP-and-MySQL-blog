<?php
require('db.php');
session_start();
if(!isset($_SESSION['user_id']))
{
	header("Location:index.php");
}
?>
<?php
$pid = $_GET["post_id"];

if(isset($_POST['post-update']))
{

	$title = mysqli_real_escape_string($db, $_POST['postTitle']);
	$category = mysqli_real_escape_string($db, $_POST['postCategory']);
	$content = mysqli_real_escape_string($db, $_POST['postContent']);
	$image = $_FILES['postFile']['name'];
	$author = $_SESSION['name'];
	$updateImage = $image;

	if(empty($image)){
		$updateImage = $_POST['currentImage'];
		$newImage = false;
	}
	$imageDirectory = "Upload/Image/" . basename($_FILES['postFile']['name']);
	$sql = "UPDATE post SET title = '$title', category_name = '$category', author = '$author', image = '$updateImage', content = '$content' WHERE id = '$_POST[idFromUrl]' ";
	$execution = mysqli_query($db, $sql) or die(mysqli_error($db));
	if($execution){
		move_uploaded_file($_FILES['postFile']['tmp_name'], $imageDirectory);
		echo '<script>alert("POST UPDATED SUCCESSFULLY")</script>';
		header("Location: dashboard.php");
	}
	else{
		echo '<script>alert("SOMETHING WENT WRONG PLEASE TRY AGAIN")</script>';
		header("Location: dashboard.php");
	}
}
elseif(isset($_GET['post_id'])){
	if(!empty($_GET['post_id'])){
		$sql = "SELECT * FROM post WHERE id = '$_GET[post_id]'";
		$execution = mysqli_query($db, $sql) or die(mysqli_error($db));
		if(mysqli_num_rows($execution)>0){
			if($result = mysqli_fetch_assoc($execution)){
				$result_id = $result['id'];
				$result_date = $result['postDate'];
				$result_title = $result['title'];
				$result_category = $result['category_name'];
				$result_author = $result['author'];
				$result_image = $result['image'];
				$result_content = $result['content'];
			}
		}
	}
}else{
	header("Location: dashboard.php");
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

						<!-- Add Post Form -->
						<h3 class="post-heading">UPDATE POST</h3>

						<form action="editpost.php" method="POST" enctype="multipart/form-data">
							<fieldset>
								<div class="form-group">
									<label for="postTitle">TITLE</label>
									<input type="text" name="postTitle" id="postname" class="form-control" placeholder="Add New Title" value="<?php echo $result_title; ?>">
								</div>

								<div class="row">


								<div class="form-group col-sm-6">
									<label>Current Category : <?php echo htmlentities($result_category); ?></label><br>
									<label for="postCategory">CHANGE CATEGORY</label>
									<select name="postCategory" class="form-control" id="postCategory" value="<?php echo $result_category ?>">
										<?php
										$sql = "SELECT name FROM category";
										$execution = mysqli_query($db, $sql) or die(mysqli_error($db));
										$selected = "";
										while($row = mysqli_fetch_assoc($execution)){
											if($result_category === $row['name']){
												?>
												<option selected="selected"><?php echo htmlentities($row['name']) ?></option>
												<?php
											}else{
												?>
												<option><?php echo htmlentities($row['name']) ?></option>
												<?php
											}
										}
										?>
									</select>
								</div>

								<div class="form-group col-sm-6 upload">
									<label>Existing Image: <br><img src="Upload/Image/<?php echo $result_image; ?>" style="width: 100px;"></label><br>
									<label for="postFile">UPDATE IMAGE</label>
									<input type="file" name="postFile" id="postfile" class="form-control">
								</div>
								</div>

								<div class="form-group">
									<label for="postContent">EXISTING CONTENT</label>
									<textarea name="postContent" id="postContent" class="form-control" cols="30" rows="10"><?php echo $result_content;?></textarea>
								</div>
								<input type="hidden" name = "idFromUrl" value="<?php echo $_GET['post_id']; ?>">
								<input type="hidden" name = "currentImage" value="<?php echo $result_image; ?>">
								<div class="form-group">
									<input type="submit" name="post-update" class="btn btn-info" value="UPDATE">
								</div>
							</fieldset>
						</form>

						<!-- Add Post Form ENDS -->


					</div>
				</div>
			</div>
		</div>
		<!-- Sidebar ENDS -->

	</div>

	<script type="text/javascript">

		function IsValidPostName(postname){
			if(postname == ""){
				return false;
			}
			else{
				return true;
			}
		}


		function IsValidFile(file){
			var validextension = new Array("jpg", "png", "jpeg", "gif");
			var fileextension = file.split('.').pop().toLowerCase();

			for (var i = 0; i <= validextension.length; i++) {
				if (validextension[i] == fileextension) {
					return true;
				}
			}
			return false;
		}
		function IsValidPostContent(postcontent){
			if(postcontent == ""){
				return false;
			}
			else{
				return true;
			}
		}


		function ValidPost(){
			var postname = document.getElementById("postname").value;
			var file = document.getElementById("postfile").value;
			var postcontent = document.getElementById("postcontent").value;

			if(!IsValidPostName(postname)){
				alert("Post Title Required");
			}
			if(!IsValidFile(file)){
				alert("Invalid File selected");
			}
			if(!IsValidPostContent(postcontent)){
				alert("Content Field Empty");
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
