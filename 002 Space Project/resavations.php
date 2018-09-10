<?php
require_once('class/booking.php'); //Requires the booking.php so that we can make use of our class.
$booking = new CM();  //This line makes a variable for our Content Manager. Then we can use the variable to run functions inside booking.php
?> <!-- end of PHP -->
<!DOCTYPE html>
<html>
<head>
	<title>Space Odessy</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="css/main.css"> <!-- Links out site and stylesheet together. -->
    <style>
        background-image: url("../img/SpaceElevator.jpg") !important;
    </style>
</head>
<body background="/img/SpaceWalking.jpg">
	<div class="top-nav" id="topNavigation"> <!-- header explained in bookpage.php -->
		<a href="index.php">Home Page</a>
		<a href="bookpage.php">Book your flight</a>
		<a href="resavations.php">See live reservations</a>
	</div>

	<div class="post-wrapper"> 
		<table id="customers"> <!-- Now this is interesting. This creates our table for our reservations lists. -->
            <tr>
            <th>Name</th>
            <th>Status</th>
            <th>Destination</th> <!-- First we create our top indexing row, where we define what is in what row/column -->
            <th>Tickets</th>
            </tr>
            <?php $booking->post_booking(); ?>  <!-- This calls for the interesting function from booking.php that posts all the reservations made on the site -- I suggest u GoTo booking.php and read my comments there for further explaining . -->
        </table>
	</div>
</body>
</html>