<?php
session_start();
$uname=$_POST['username']; 
$_SESSION['loginuser']=$uname;
if (isset($_POST['login']))


{
    if ((isset($_POST['username']))and (isset($_POST['password']))) 
	{
		
        
	    try  
			
		{
			$host       = "localhost";
			$username   = "root";
			$password   = "";
			$dbname     = "task1";
			$dsn        = "mysql:host=$host;dbname=$dbname";
			$options    = array(
						PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
								);	
			$connection = new PDO($dsn, $username, $password, $options);
			$sql = "SELECT * 
                        FROM users
                        WHERE Username=:username and Password=:password";

			$username = $_POST['username'];
			$password=$_POST['password'];

			$statement = $connection->prepare($sql);
			$statement->bindParam(':username', $username, PDO::PARAM_STR);
			$statement->bindParam(':password', $password, PDO::PARAM_STR);
			$statement->execute();

			$result = $statement->fetchAll();
		
			if ($result && $statement->rowCount() > 0)
			{
				
				echo $_SESSION['loginuser']."<br>";
			    echo "logged in successfully";
				
				
				
				
			}
			
			else
			{
				echo"incorrect username or password";
			}
			
			
	    }
     
		catch(PDOException $error) 
		{
        echo $sql . "<br>" . $error->getMessage();
		}
	
	}
	else
	{
		echo "server side error";
	}
}
?>
