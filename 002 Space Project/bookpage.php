<?php
require_once('class/booking.php'); //This line includes our other file called booking.php. If this file does not exist, further code wont be run. Use Include instead of require.
$booking = new CM(); //This line makes a variable for our Content Manager. Then we can use the variable to run functions inside booking.php
if(isset($_POST['btn-submit'])){ //This "function" Collects data, that the client user has been filling in text fields.
	$name 			= strip_tags($_POST['txt-firstname']);
	$lastname 		= strip_tags($_POST['txt-lastname']);
	$status 		= strip_tags($_POST['select-lifestat']);
	$destination 	= strip_tags($_POST['select-destination']);
	$tickets 		= strip_tags($_POST['select-ticket']);
	
	if ($name=="" || $lastname=="") { //This function checks that everything has been entered correctly.
		$error = "Provide name and lastname"; //If no name or last name. Write a message about it.
	}
	else{ // else the code will move on and send the variables over to our booking.php / content manager, who then posts the data into our SQL database.
		try{
			if ($booking->apply_booking($name, $lastname, $status, $destination, $tickets)) {
				# code...
			}
			
		}
		catch(PDOExeption $e){ //Catch any form of errors, if any, warn us about it.
			echo $e->getMessage();
		}
	}
} //PHP ending.
?> 
<!DOCTYPE html>
<html>
<head>
	<title>Milky Cruise</title> <!-- Title - shows in top tap when browsing -->
	<meta charset="utf-8">
	<link rel="stylesheet" href="css/main.css"> <!-- Link our css to our html page. CSS is the file that sets the design of the website -->
</head>
<body background="/img/SpaceElevator.jpg"> <!-- Here we set our background image. This should be done in CSS for the same background on all. But we wanna give it a Twist -->
	<div class="top-nav" id="topNavigation"> <!-- Header for links to the other parts of our website. This can be but in a separate file for better managing. but for simplicity we put it here -->
		<a href="index.php">Home Page</a> <!-- Index site. is a must for all websites, bcuz this is what the browser will look for as the first thing, when reaching a site -->
		<a href="bookpage.php">Book your flight</a> <!-- Booking site -->
		<a href="resavations.php">See live reservations</a> <!-- Reforestations -->
	</div>

	<div class="post-wrapper"> 
		<div>
		<form method="post" class="form">
			<label for="fname">First Name</label> <!-- This is a form. A form can gather data from users, and send it to other parts of the website with a POST function -->
			<input type="text" name="txt-firstname" id="fname" placeholder="Your name here"> <!-- To get data, we must create some input fields for the data -->
																							<!-- Naming and setting content type is a must. remember -->
			<label for="lname">Last Name</label>
			<input type="text" name="txt-lastname" id="lname" placeholder="Last name goes here">

            <label for="status">Life Status</label>								<!-- This is a dropdown box, where the user needs to select an option -->
            <select id="status" name="select-lifestat">							<!-- We are able to put as many parameters in here -->
                <option value="Single">Single</option>							<!-- Should we make a form for testing of people to make a score of ability to get to space? -->
                <option value="Sarried">Married</option>
                <option value="Selation">In relationship</option>
                <option value="Seperated">Separated</option>
            </select>

            <label for="destination">Pick your destination</label>
            <select id="destination" name="select-destination">
                <option value="Mars">Mars</option>
                <option value="Saturn">Saturn</option>
                <option value="Earth">Around Earth</option>
            </select>

            <label for="tickets">Number of people attending</label>
            <select id="tickets" name="select-ticket">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
            </select>

            <input type="submit" name="btn-submit" value="Submit">  <!-- Now the submit button rounds it all up, and tells the PHP code, to collect the data and send it to booking.php -->
		</form>
	</div>
	</div>
</body>
</html>