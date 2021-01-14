<!-- Simple PHP - MySQL - Bootstrap blogging system -->
<?php
include "strings.php";
 ?>
<nav class="navbar navbar-expand-md navbar-light bg-dark">
  <a class="navbar-brand" href="index.php"><?php echo $navBarFavIcon; ?><?php echo $navbarBrand; ?></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="index.php"><?php echo $navbar[0] ;?></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="index.php"><?php echo $navbar[1] ;?></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="index.php"><?php echo $navbar[2] ;?></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="index.php"><?php echo $navbar[3] ;?></a>
      </li>
    </ul>
  </div>
</nav>
