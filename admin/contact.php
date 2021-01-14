<?php
require('db.php');
session_start();
if(!isset($_SESSION['user_id']))
{
	header("Location:index.php");
}
?>

<?php
if(isset($_GET['delete_contact'])){
	if(!empty($_GET['delete_contact'])){
		$sql = "DELETE FROM contact WHERE id = '$_GET[delete_contact]'";
		$execution = mysqli_query($db, $sql) or die(mysqli_error($db));
		if($execution){
			echo '<script>alert("CONTACT DELETED SUCCESSFULLY")</script>';
			header("Location: contact.php");
		}
		else{
			echo '<script>alert("SOMETHING WENT WRONG PLEASE TRY AGAIN")</script>';
			header("Location: contact.php");
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

						<!-- Approve Comments -->
						<?php
						$sql = "SELECT * FROM contact ORDER BY contactdate";
						$execution = mysqli_query($db, $sql) or die(mysqli_error($db));
						$postNo = 1;
						?>
							<h3 class="post-heading">Contact Details</h3>

							<div class="overflowTable">
							<table id="dtHorizontalExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
								<thead class="thead-dark">
									<tr>
										<th>No.</th>
										<th>Date Added</th>
										<th>Name</th>
										<th>Email</th>
										<th>Phone Number</th>
										<th>Message</th>
										<th>Call / Email / Delete</th>
									</tr>
								</thead>
								<tbody>
									<?php
									while($result = mysqli_fetch_assoc($execution)){
										$commentid = $result['id'];
										$dateadded = $result['contactdate'];
										$contactname = $result['name'];
										$contactemail = $result['email'];
										$contactphone = $result['phone'];
										$message = $result['message'];
										?>
										<tr>
											<td><?php echo $postNo; ?></td>
											<td><?php echo $dateadded; ?></td>
											<td><?php echo $contactname; ?></td>
											<td><?php echo $contactemail; ?></td>
											<td><?php echo $contactphone; ?></td>
											<td><?php echo $message; ?></td>
											<td><a href="tel: <?php echo $contactphone; ?>"><button class="btn btn-info"><i class="fas fa-mobile-alt"></i></button></a> | <a href="mailto: <?php echo $contactemail; ?>"><button class="btn btn-primary"><i class="far fa-envelope"></i></button></a> | <a href="contact.php?delete_contact=<?php echo $commentid;?>"><button class="btn btn-danger"><i class='far fa-trash-alt'></i></button></a> </td>
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
