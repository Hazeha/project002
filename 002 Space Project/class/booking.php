<?php

/**
 * Class for making, posting and calculating bookings
 * First we Require our connection file, so we are able to access our database.
 * This is not something we have learned yet on EASJ
 */
require_once('class/connection.php');
class CM 	//Then we create a class. This one we call CM for Content Manager.
{			//This class can then be used to access the same functions over and over again, on multiple pages on your website.
	private $conn;	//We declare our connection variable as private, since we dont want this to be accessed outside of our class. (security)
	public function __construct(){ //Then we create a function that creates the connection for the database.
		$database = new database();
		$db = $database->dbConnection();
		$this->conn = $db;
	}
	public function runQuery($sql){
		$stmt = $this->conn->prepare($sql);
		return $stmt;
	}
	public function apply_booking($name, $lastname, $status, $destination, $tickets){
		try{
			$stmt = $this->conn->prepare("INSERT INTO booking_tb (name,lastname,status,destination,tickets) VALUES(:bname, :blastname, :bstatus, :bdestination, :btickets)");
			$stmt->bindparam(":bname", $name);							//This is our function that gets data from the _POST method from bookpage and sends data into our database. 
			$stmt->bindparam(":blastname", $lastname);					//When the function gets the data, it prepares the database to receive the data.
			$stmt->bindparam(":bstatus", $status);						//Then we strip the data and bind it to the right columns.
			$stmt->bindparam(":bdestination", $destination);			//When the statement ($stmt) has all the data, it will execute the data onto the database tables.
			$stmt->bindparam(":btickets", $tickets);

			$stmt->execute();

			return $stmt;
		}
		catch(PDOExeptionn $e){											//Catch any errors and shot it out the screen through your head and into the cd-rom and bluescreen your MAC.
			echo $e->getMessage();
		}
	}
	public function post_booking(){																//This function posts all the current resavations in the database table.
		$stmt = $this->conn->prepare("SELECT * FROM booking_tb ORDER BY date ASC");				//it's actually quite simple. The function selects all data in the table booking_tb
		$stmt->execute();																		//Then executes the statement.
		$booking = $stmt->fetchAll();															//Then it's fetching all the rows and columns in the booking_tb.
		foreach ($booking as $post) {											//So... For each row/data/booking it will echo/print the data for that row, before going on to the next row.
			echo'<tr>															
			<td>'. $post["name"] . ' ' . $post["lastname"] .'</td>
			<td>'. $post["status"].'</td>
			<td>'. $post["destination"].'</td>
			<td>'. $post["tickets"].'</td>
			</tr>';
		}																		//So, For each $booking made, make a $post - then this $post can be used as an array to specify which of 																			the data to be printed.
	}
}
?>