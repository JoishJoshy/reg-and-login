


<?php require "templates/header.php"; ?> 
<?php
session_start();
?>

<script>
function validate()
{
	
	
	var username=document.forms["login"]["username"].value;
	if(username=="")
	{
		alert("enter user name");
		document.forms["login"]["username"].focus();
		return false;
	}
	
	
	
	var password=document.forms["login"]["password"].value;
	if(password=="")
	{
		alert("enter password");
		document.forms["login"]["password"].focus();
		return false;
	}

	
	
		
	
	
}


</script>




<form method="POST" name="login" onsubmit="return validate()" action="logindb.php">
<table>
<tr>
<td>Username</td><td><input type="text" name="username"> </td>
</tr>
<tr>
<td>Password</td><td><input type="password" name="password"> </td>
</tr>
 
<td></td><td><input type="submit" name="login"value="login"> </td>
</tr>
</table>
</form>
New user?<a href="registration.php"> Register here </a>
</div>

<?php require "templates/footer.php"; ?>






