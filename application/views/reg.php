<!DOCTYPE html>
<html>
<head>
	<title>registration form</title>
</head>
<body>
	<h1>Registration Form</h1>
	
	<form method="post" action="<?php echo base_url()?>main1/regi">
	<table>
		<tr><td>First Name</td><td><input type="text" name="fname" size="25"></td></tr>
		<tr><td>Last Name</td><td><input type="text" name="lname"></td></tr>
		<tr><td>Mobile Number</td><td><input type="text" name="phno"></td></tr>
		<tr><td>EmailId</td><td><input type="email" name="email"></td></tr>
		<tr><td>User Name</td><td><input type="text" name="uname"></td></tr>
		<tr><td>Password</td><td><input type="password" name="password"></td></tr>
		<tr><td></td><td><input type="submit" name="submit"></td></tr>
	</table>
	</form>

</body>
</html>