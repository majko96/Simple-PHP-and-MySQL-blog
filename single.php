<!-- Simple PHP - MySQL - Bootstrap blogging system -->

<!DOCTYPE HTML>
<html lang="en" ng-app="single">
<?php
include "head.php";
require('db.php');
include "strings.php";
if(isset($_GET['id'])){
	$post_id = $_GET['id'];
	$post_title = "";
	$sql = "SELECT * FROM post WHERE id = '$post_id'";
	$execution = mysqli_query($db, $sql) or die(mysqli_error($db));
	if($title = mysqli_fetch_assoc($execution)){
		$post_title = $title['title'];
	}
}
 ?>
<body>
	<?php
	include "navbar.php";
	 ?>
	<!-- Class Blog = Main Div Except Footer -->
	<div class="blog">

			<!-- BLOG - Left Bottom Panel -->
			<div class="container">
				<div class="row">
					<div class="col-md-12 title">
						<h1 class="text-blog"><?php echo $post_title; ?></h1>
						<p class="lead-para">- <a href="http://www.alphacode.co.in"><?php echo $hashTag; ?></a></p>
					</div>
					<div class="col-md-8 col-sm-12">
						<?php

						if(isset($_GET['id'])){



							$query = "SELECT * FROM post WHERE id = '$_GET[id]'";
							$execution = mysqli_query($db, $query) or die(mysqli_error($db));
							if(mysqli_num_rows($execution)>0){
								while($result = mysqli_fetch_assoc($execution)){
									$id = $result['id'];
									$result_date = DateTime::createFromFormat ( "Y-m-d H:i:s", $result["postDate"] );
									$title = $result['title'];
									$category = $result['category_name'];
									$image = $result['image'];
									$content = $result['content'];
									?>
									<div class="card blog_post mb-5" id="comments">
										<img src="admin/Upload/Image/<?php echo $image; ?>" class="card-img-top blog-img" alt="">
										<div class="card-body">
											<h3 class="card-title"><?php echo htmlentities($title); ?></h3>
											<p href="#" class="card-text extraText"><hr><span><i class="far fa-edit"></i> <?php echo htmlentities($category); ?></span> <span>|</span> <span><i class="far fa-calendar-alt"></i>  <?php echo $result_date->format('d.m.\&\\n\b\s\p\;Y, H:i');?></span></p></br>
											<div id="mainText">
												<?php echo htmlspecialchars_decode(stripslashes($content)); ?>
											</div>

											<!-- <a href="#" class="card-link btn btn-info readMore"><i class="fas fa-hand-point-right"></i> Read More</a> -->
										</div>
									</div>
									<?php
								}
							}
						}
						?>




								<?php

								$sql = "SELECT * FROM comment WHERE post_id = '$_GET[id]'";
								$execution = mysqli_query($db, $sql) or die(mysqli_error($db));
								if(mysqli_num_rows($execution)>0){

									echo'<div class="panel-heading mb-3">
										<h4>'; echo $comm; echo'</h4>
									</div>';

									while($comment = mysqli_fetch_assoc($execution)){
										$c_email = $comment['email'];
										$c_comment = $comment['comment'];
										//$c_date = $comment['commentdate'];
										$new_datetime = DateTime::createFromFormat ( "Y-m-d H:i:s", $comment["commentdate"] );
										?>

							<div class="row">
								<div class="col-12">
									<div class="card card-white post mb-3">
										<div class="post-heading">
							    	<div class="float-left image">
							        <img src="http://bootdey.com/img/Content/user_1.jpg" class="img-circle avatar" alt="user profile image">
							    	</div>
							    	<div class="float-left meta">
							        <div class=" h5">
							            <p><?php echo $c_email;?></p><small class="text-muted"><?php echo $new_datetime->format('d. m. Y, H:i
													'); ?></small>
							        </div>
							    	</div>
									</div>
										<div class="post-description"><hr>
							    		<p><?php echo $c_comment?></p>
										</div>
									</div>
								</div>
							</div>
									<?php
									}
								}
								?>

						<div class="comment-section mb-5">
							<form method="POST" action="commentpost.php" name="comment">
								<fieldset>
									<div class="panel-heading">
										<h4><?php echo $newCom; ?></h4>
									</div>

									<div class="form-group">
										<input type="text" name="email" id="email"  placeholder=<?php echo $formStr[0]; ?> class="form-control mt-3"  required>
									</div>
									<div class="form-group">
										<textarea name="comment" id="comment" placeholder=<?php echo $formStr[1]; ?> class="form-control" cols="20" rows="5" required></textarea>
									</div>
									<input type="hidden" name="id" id="comID" value="<?php echo $_GET['id']; ?>">
									<div class="form-group text-center">
										<input type="submit" name="submit" value=<?php echo $addButton ?> class="btn readMore mb-5">
									</div>
								</fieldset>
							</form>
						</div>
					</div>


					<div class="col-md-4 col-xs-12">


						<!-- Recent Post -->
						<div class="panel mb-5">
							<div class="panel-heading">
								<h4><?php echo $nevestPosts; ?></h4>
							</div>
							<div class="panel-body">
								<?php
								$sql = "SELECT * FROM post ORDER BY postDate DESC LIMIT 5";
								$execution = mysqli_query($db, $sql) or die(mysqli_error($db));
								while($recent = mysqli_fetch_assoc($execution)){
									$id = $recent['id'];
									?>
									<ul class="recent">
										<li class="recent-items"><a href="single.php?id=<?php echo $id;?>"><?php echo $recent['title']; ?></a></li>
									</ul>
									<?php
								}
								?>
							</div>
						</div>

						<!-- Categories -->
						<div class="panel mbb">
							<div class="panel-heading">
								<h4><?php echo $cat; ?></h4>
							</div>
							<div class="panel-body">
								<?php
								$sql = "SELECT name FROM category";
								$execution = mysqli_query($db, $sql) or die(mysqli_error($db));
								while($category = mysqli_fetch_assoc($execution)){
									?>
									<ul class="recent">
										<li class="recent-items"><a href="index.php?category=<?php echo $category['name'];?>"><?php echo $category['name']; ?></a></li>
									</ul>
									<?php
								}
								?>

							</div>
						</div>
					</div>
				</div>
			</div>


			<!-- BLOG - Left Bottom Panel ENDS -->
		</div>
		<!-- BLOG - Left Panel ENDS -->


		<!-- Main Section Ends -->

		<?php
		include "footer.php";
		 ?>
	</div>

	<!-- Script Files -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
