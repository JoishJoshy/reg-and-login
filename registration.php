<?php

if (isset($_POST['submit'])) 
	{
		require "../config.php";
		require "../common.php";
		$fname ="";
		$name="";
		$email ="";
		$psw ="";
		$mob ="";
		
		$statement="";
	
	
		if (empty($_POST["username"])) 
		{
			?> <script> alert("Name is required"); </script> <?php		
		}
		else 
		{
			$uname = $_POST["username"];
		}
		if (empty($_POST["name"])) 
		{
			?> <script> alert("Name is required"); </script> <?php
		}
		else 
		{
			$name = $_POST["name"];
		}
		if (empty($_POST["email"])) 
		{
			?> <script> alert("email is required"); </script> <?php
		}
		else 
		{
			$email = $_POST["email"];
			if (!preg_match("/([w-]+@[w-]+.[w-]+)/",$email)) 
			{
				$email_e = "Invalid email format";
			}
		}
		if (empty($_POST["password"])) 
		{
			?> <script> alert("password is required"); </script> <?php
			
		}
		else 
		{
			$psw =$_POST["password"];
		}
		if (empty($_POST["mobile"])) 
		{
			?> <script> alert("mobile number is required"); </script> <?php
		}
		else 
		{
			$mob = $_POST["mobile"];
		}
	


if(($uname!="") and ($name!="") and ($email!="") and ($psw!="") and ($mob!="") )
	{
		
	try 
	{
        $connection = new PDO($dsn, $username, $password, $options);
  
        $new_user = array(
            "username" => $_POST['username'],
            "name"  => $_POST['name'],
            "email"     => $_POST['email'],
            "password"       => $_POST['password'],
            "mobile"  => $_POST['mobile'],
		
        );
		$sql = "SELECT * FROM users WHERE username = :username or email=:email";
        $statement= $connection->prepare($sql);
        $statement->bindValue(':username',$_POST['username']);
		$statement->bindValue(':email',$_POST['email']);
         $statement->execute();

if($row = $statement->fetch(PDO::FETCH_ASSOC)) 
{
$usernameExists = 1;
} 
else 
{
$usernameExists = 0;
}
$statement->closeCursor();
if ($usernameExists) 
{
  ?> <script> alert("username already Exist"); </script> <?php
}
         else
{     





		

        $sql = sprintf(
                "INSERT INTO %s (%s) values (%s)",
                "users",
                implode(", ", array_keys($new_user)),
                ":" . implode(", :", array_keys($new_user))
        );
        
        $statement = $connection->prepare($sql);
        $statement->execute($new_user);
    }
	}
	catch(PDOException $error) 
	{
        echo $sql . "<br>" . $error->getMessage();
    }
	
	}
    
	}
?>

<?php require "templates/header.php"; ?>
<script>
    function check()
    {
        var username=document.forms["form"]["username"];
        var name=document.forms["form"]["name"];
        var email=document.forms["form"]["email"];
		var password=document.forms["form"]["password"];
		var mobile=document.forms["form"]["mobile"];
		
        if(username.value=="")
        {
            alert("Enter a Valid User Name");
            document.forms["form"]["username"].focus();
				return false;
        }
        if(username.length<4)
        {
            alert("Enter a Valid User Name");
            document.forms["form"]["Username"].focus();
            return false;
        }
        if(name.value=="")
        {
            alert("Enter a Valid Name");
            document.forms["form"]["name"].focus();
            return false;
        }
        if(name.length<4)
        {
            alert("Enter a Valid Name");
            document.forms["form"]["name"].focus();
            return false;
        }
		
        var email=document.form.email.value;  
        var atposition=email.indexOf("@");  
        var dotposition=email.lastIndexOf(".");     
        if (atposition<1 || dotposition<atposition+2 || dotposition+2>=email.length)
        {  
            alert("Please enter a valid e-mail address "); 
			document.forms["form"]["email"].focus();			
            return false;  
        }  
	    if(password=="" )
		{
			alert("enter a password ");
			document.forms["form"]["password"].focus();
			return false;
		}
		if(password.length<6 )
		{
			alert("enter a valid password ");
			document.forms["form"]["password"].focus();
			return false;
		}
		if(mobile=="" )
		{
			alert("please enter ur mobile number ");
			document.forms["form"]["mobile"].focus();
			return false;
		}
		if(mobile.length<10 )
		{
			alert("please enter valid mobile number ");
			document.forms["form"]["mobile"].focus();
			return false;
		}
        
    }
</script>

<?php if (isset($_POST['submit']) && $statement) { ?>
    <blockquote><?php echo $_POST['username']; ?> successfully added.</blockquote>
<?php } ?>

<h2>Add a user</h2>

<form method="post" name="form" onsubmit="return check()">
    <label for="username">User Name</label>
    <input type="text" name="username" id="username">
    <label for="name">Name</label>
    <input type="text" name="name" id="name">
    <label for="email">Email Address</label>
    <input type="text" name="email" id="email">
    <label for="password">password</label>
    <input type="password" name="password" id="password">
    <label for="mobile">Mobile</label>
    <input type="text" name="mobile" id="mobile">
    <input type="submit" name="submit" value="Submit">
</form>

<a href="index.php">Back to home</a>

<?php require "templates/footer.php"; ?>
