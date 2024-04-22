<?php
session_start();

include "./partials/header.php";
include "./partials/nav.php";
include "./partials/carousel.php";



?>
<h1>Home Page</h1>
<p><?php echo $_SESSION['name'] ?? '' ?></p>


<?php require "./partials/footer.php";
