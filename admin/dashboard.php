<?php
require('db.php');
session_start();
if(!isset($_SESSION['user_id']))
{
	header("Location:index.php");
}

include "../head.php";
 ?>
<body>
	<!-- Class Blog = Main Div Except Footer -->


		<!-- Sidebar -->



			<?php
			include "sidebar.php";
			 ?>
					<div class="container">


					<div class="blog">


					<div class="col-sm-12">

						<?php
						$sql = "SELECT * FROM post ORDER BY postDate DESC";
						$exec = mysqli_query($db, $sql) or die(mysqli_error($db));
						$postNo = 1;
						if(mysqli_num_rows($exec) < 1){
							?>
							<p>You Have 0 Post for the Moment</p>
							<a href="newpost.php" class="btn btn-info">ADD POST</a>
							<?php
						}
						else
						{
							?>

							<h3 class="post-heading">DASHBOARD</h3>
							<div class="overflowTable">

							<table id="dtHorizontalExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
								<thead class="thead-dark">
									<tr>
										<th>Post Date</th>
										<th>Title</th>
										<th>Author</th>
										<th>Category</th>
										<th>Action</th>
										<th>Details</th>
									</tr>
								</thead>
								<tbody>
									<?php
									while ($result = mysqli_fetch_assoc($exec)){
										$post_id = $result['id'];
										$post_date = $result['postDate'];
										$post_title = $result['title'];
										$post_category = $result['category_name'];
										$author = $result['author'];
										$image = $result['image'];
										?>

										<tr>
											<td><?php echo $post_date;?></td>
											<td>
												<?php
												if(strlen($post_title) > 20){
													echo substr($post_title, 0, 20) . '....';
												}else{
													echo $post_title;
												}
												?></td>
											<td><?php echo $author;?></td>
											<td><?php echo $post_category;?></td>
											<td><a href="editpost.php?post_id=<?php echo $post_id;?>"><button class="btn btn-warning"><i class="far fa-edit"></i></button></a> | <a href="deletepost.php?post_id=<?php echo $post_id;?>"><button class="btn btn-danger"><i class="far fa-trash-alt"></i></button></a></td>
											<td><a target="_blank" href="../single.php?id=<?php echo $post_id;?>"><button class="btn btn-info"><i class="fas fa-eye"></i>&nbsp;Live Preview</button></a></td>
										</tr>
										<?php $postNo++;
									} ?>

								</tbody>
							</table>
						</div>
						<?php
					}

						?>




					</div>

			</div>
		</div>
		<!-- Sidebar ENDS -->

	</div>





	<!-- Script Files -->
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>




</body>
</html>
