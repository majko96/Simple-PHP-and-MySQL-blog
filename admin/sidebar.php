<?php
$activePage = basename($_SERVER['PHP_SELF'], ".php");

 ?>
<div class="sidebar" >

    <!-- Navbar section -->


      <ul id="side-menu" class="nav nav-pills navig">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <li class="<?= ($activePage == 'dashboard') ?  'active':''; ?>"><a href="dashboard.php" class="nav-link links-sidebar"><i class="fas fa-columns"></i>&nbsp; DASHBOARD</a></li>
        <li class="<?= ($activePage == 'newpost') ?  'active':''; ?>"><a href="newpost.php" class="nav-link links-sidebar"><i class="fas fa-list-alt"></i>&nbsp; NEW POSTS</a></li>
        <li class="<?= ($activePage == 'category') ?  'active':''; ?>"><a href="category.php" class="nav-link links-sidebar"><i class="fas fa-tags"></i>&nbsp; CATEGORIES</a></li>
        <li class="<?= ($activePage == 'users') ?  'active':''; ?>"><a href="users.php" class="nav-link links-sidebar"><i class="fas fa-user-tie"></i>&nbsp; MANAGE USERS</a></li>
        <li class="<?= ($activePage == 'comments') ?  'active':''; ?>"><a href="comments.php" class="nav-link links-sidebar"><i class="fas fa-comments"></i>&nbsp; COMMENTS</a></li>
        <li class="<?= ($activePage == 'contact') ?  'active':''; ?>"><a href="contact.php" class="nav-link links-sidebar"><i class="fas fa-comments"></i>&nbsp; REQUESTS</a></li>
        <li><a target="_blank" href="../index.php" class="nav-link links-sidebar"><i class="fab fa-blogger-b"></i>&nbsp; LIVE BLOG</a></li>
        <li><a href="logout.php" class="nav-link links-sidebar"><i class="fas fa-sign-out-alt"></i>&nbsp; LOGOUT</a></li>
      </ul>
    </div>



    <!-- Content Section -->
    <nav class="navbar navbar-expand-md navbar-light bg-dark">
      <button class="openbtn" onclick="openNav()">&#9776; Menu</button>
    </nav>


    <script type="text/javascript">
    window.onload = function myFunction(){
    var w = screen.width;
    if (w>=1380){
      document.getElementById("side-menu").style.width = "250px";
    }else{
      document.getElementById("side-menu").style.width = "0";
    }
    }

    /* Set the width of the sidebar to 250px and the left margin of the page content to 250px */
    function openNav() {
    document.getElementById("side-menu").style.width = "250px";
    }

    /* Set the width of the sidebar to 0 and the left margin of the page content to 0 */
    function closeNav() {
    document.getElementById("side-menu").style.width = "0";
    }
    </script>
