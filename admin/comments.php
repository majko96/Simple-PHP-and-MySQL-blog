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
	<?php
	include "sidebar.php";
	 ?>
			<div class="container">


			<div class="blog">


			<div class="col-sm-12">

						<!-- Approve Comments -->
						<?php
						$sql = "SELECT * FROM comment  ORDER BY commentdate";
						$execution = mysqli_query($db, $sql) or die(mysqli_error($db));
						$postNo = 1;
						?>
							<h3 class="post-heading">Approved</h3>

							<div class="overflowTable">
							<table id="dtHorizontalExample" class="table table-striped table-bordered table-sm" >
								<thead class="thead-dark">
									<tr>
										<th>No.</th>
										<th>Date Added</th>
										<th>User Email</th>
										<th>Comment</th>
										<th>Action</th>
										<th>Details</th>
									</tr>
								</thead>
								<tbody>
									<?php
									while($result = mysqli_fetch_assoc($execution)){
										$commentid = $result['id'];
										$dateadded = $result['commentdate'];
										$commentemail = $result['email'];
										$commentcontent = $result['comment'];
										$post_id = $result['post_id'];
										?>
										<tr>
											<td><?php echo $postNo; ?></td>
											<td><?php echo $dateadded; ?></td>
											<td><?php echo $commentemail; ?></td>
											<td><?php echo $commentcontent; ?></td>
											<td><a onclick="return confirm('Are you sure?')" href="deletec.php?id=<?php echo $commentid;?>"><button class="btn btn-danger"><i class="fa fa-trash"></i></button></a></td>
											<td><a target="_blank" href="../single.php?id=<?php echo $post_id;?>"><button class="btn btn-info"><i class="fas fa-eye"></i>&nbsp;Live Preview</button></a></td>
										</tr>
										<?php
										$postNo++;
									}?>


								</tbody>
							</table>
						</div>
						<!-- Approve Comments ENDS -->






					</div>
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
