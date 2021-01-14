<!-- Simple PHP - MySQL - Bootstrap blogging system -->
<!DOCTYPE HTML>
<html lang="en">
<?php
require('db.php');
include "strings.php";
include "head.php";
 ?>
<body>
	<?php
	include "navbar.php";
	 ?>
	<!-- Class Blog = Main Div Except Footer -->
	<div class="blog">

		<!-- Main Section -->

			<!-- BLOG - Left Bottom Panel -->
			<div class="container">

				<div class="row">
					<div class="col-md-12 col-xs-12 title">
						<h1 class="text-blog"><?php echo $blogName; ?></h1>
						<p class="lead-para">- <a href="http://www.alphacode.co.in"><?php echo $hashTag; ?></a></p>
					</div>
					<div class="col-md-8 col-sm-12">
						<?php


              $limit = 4;
              /*How may adjacent page links should be shown on each side of the current page link.*/
              $adjacents = 2;
              if(isset($_GET['category'])){
                $sql = "SELECT COUNT(*) 'total_rows' FROM `post` WHERE category_name = '$_GET[category]'";
              }else{
                $sql = "SELECT COUNT(*) 'total_rows' FROM `post`";
              }
              $res = mysqli_fetch_object(mysqli_query($db, $sql));
              $total_rows = $res->total_rows;
              $total_pages = ceil($total_rows / $limit);



              if (isset($_GET['page']) && $_GET['page'] != "") {
                  $page = $_GET['page'];
                  $offset = $limit * ($page-1);
              } else {
                  $page = 1;
                  $offset = 0;
              }

              if ($total_pages <= (1+($adjacents * 2))) {
                  $start = 1;
                  $end   = $total_pages;
              } else {
                  if (($page - $adjacents) > 1) {
                      if (($page + $adjacents) < $total_pages) {
                          $start = ($page - $adjacents);
                          $end   = ($page + $adjacents);
                      } else {
                          $start = ($total_pages - (1+($adjacents*2)));
                          $end   = $total_pages;
                      }
                  } else {
                      $start = 1;
                      $end   = (1+($adjacents * 2));
                  }
              }

						if(isset($_GET['category'])){
							$query = "SELECT * FROM post WHERE category_name = '$_GET[category]' ORDER BY postDate DESC limit $offset, $limit ";
						}else{
							$query = "SELECT * FROM post ORDER BY postDate DESC limit $offset, $limit ";
						}

						$execution = mysqli_query($db, $query) or die(mysqli_error($db));
						if($execution){
							if(mysqli_num_rows($execution) > 0){
								while($result = mysqli_fetch_assoc($execution)){
									$result_id = $result['id'];
									//$result_date = $result['postDate'];
                  $result_date = DateTime::createFromFormat ( "Y-m-d H:i:s", $result["postDate"] );
									$result_title = $result['title'];
									$result_category = $result['category_name'];

									$result_image = $result['image'];

                  $str = strip_tags(html_entity_decode($result['content']));

                  //$s = html_entity_decode($result['content']);
                  $lim = 150;
                  if (mb_strlen($str,'UTF-8')>$lim)
                  {
                     $str = mb_substr($str, 0, $lim-3, 'UTF-8').'...';
                  }
									?>



									<div class="card blog_post mb-5">
										<img src="admin/Upload/Image/<?php echo $result_image; ?>" class="card-img-top blog-img" alt="">
										<div class="card-body">
											<h3 class="card-title"><?php echo htmlentities($result_title); ?></h3>
											<p class="card-text extraText"><hr><span><i class="far fa-edit"></i> <?php echo htmlentities($result_category); ?></span> <span>|</span> <span><i class="far fa-calendar-alt"></i> <?php echo $result_date->format('d.m.\&\\n\b\s\p\;Y, H:i'); ?></span></p> <br>
											<p class="card-text blogPara"><?php echo html_entity_decode($str); ?></p>
											<a href="single.php?id=<?php echo $result_id;?>" class="card-link btn readMore"><i class="fas fa-hand-point-right"></i><?php echo $readMore; ?></a>
										</div>
									</div>
									<?php
								}
							}else{
								echo "<span class='lead'>No results Found !!!</span>";
							}
						}else{

						}
						?>

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
						<div class="panel mb-5">
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

      <?php
      $cat = "";
        if(isset($_GET['category'])){
          $cat = "category=".$_GET['category']."&";
          //echo $cat;
        } ?>

			<!-- BLOG - Left Bottom Panel ENDS -->
		</div>
    <div class="mb-5">
    <?php if ($total_pages > 1) { ?>
<ul class="pagination pagination-sm justify-content-center">
<!-- Link of the first page -->
<li class='page-item <?php ($page <= 1 ? print 'disabled' : '')?>'>
  <a class='page-link' href='index.php?<?php echo$cat?>page=1'><<</a>
</li>
<!-- Link of the previous page -->
<li class='page-item <?php ($page <= 1 ? print 'disabled' : '')?>'>
  <a class='page-link' href='index.php?<?php echo$cat?>page=<?php ($page>1 ? print($page-1) : print 1)?>'><</a>
</li>
<!-- Links of the pages with page number -->
<?php for ($i=$start; $i<=$end; $i++) { ?>
<li class='page-item <?php ($i == $page ? print 'active' : '')?>'>
  <a class='page-link' href='index.php?<?php echo$cat?>page=<?php echo $i;?>'><?php echo $i;?></a>
</li>
<?php } ?>
<!-- Link of the next page -->
<li class='page-item <?php ($page >= $total_pages ? print 'disabled' : '')?>'>
  <a class='page-link' href='index.php?<?php echo$cat?>page=<?php ($page < $total_pages ? print($page+1) : print $total_pages)?>'>></a>
</li>
<!-- Link of the last page -->
<li class='page-item <?php ($page >= $total_pages ? print 'disabled' : '')?>'>
  <a class='page-link' href='index.php?<?php echo$cat?>page=<?php echo $total_pages;?>'>>>
  </a>
</li>
</ul>
<?php } ?>
</div>
		<!-- BLOG - Left Panel ENDS -->




		<!-- Main Section Ends -->
<div id="main">
	<?php
	include 'footer.php';
	 ?>
</div>

	</div>

	<script src="external/jquery/jquery.js"></script>
	<script src="jquery-ui.js"></script>


	<!-- Script Files -->
	<script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
