<?php //This is for establishing a connection for the database which contains all bookings.
class Database
{   
    private $host = "localhost";
    private $db_name = "space_db";
    private $username = "db_user";          //Here i declare all the variables used to make the connection, instead of typing them directly into the function
    private $password = "kL0wGJQUXQgsKKs9"; //by doing that we can switch from prototype database to online database with ease.
    public $conn;
     
    public function dbConnection(){     //First we declare the function
	    $this->conn = null;            //then we reset the current conn if there should be any.
        try{                           
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password); //then we declare conn to our connection.
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
        }
		catch(PDOException $e){                                           //Catch failures.
            echo "Connection error: " . $e->getMessage();
        }         
        return $this->conn;                                                //Return the connection for further use in other parts of the website. 
    }
}
?>