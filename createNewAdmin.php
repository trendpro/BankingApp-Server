<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="mainStyleSheet.css">
<title>Create new admin</title>
</head>

<body>
<section id="wrapper">

<section id="header">
	<section id="logo">
    </section>
    <section id="text">
    	<h2>Equity Bank Android server</h2>
    </section>
</section>

<section id="content">
<?php
	//Include database handler
	require_once 'include/DB_Functions.php';
	
	if(isset($_POST['adminname']) && isset($_POST['idNo']) && isset($_POST['password']) && isset($_POST['username']))
	{
		processForm();
	}
	else
	{
		printForm();
	}
		
	function printForm()
	{
		echo
		'<form action="createNewAdmin.php" method="post">
            <section id="formDetail">
            	<h3>Create a new Admin</h3>
                <table>
                	<tr>
                    	<td><label for="adminname">Admin name</label></td>
                        <td><input type="text" name="adminname" id="adminName" class="textField" /></td>
                    </tr>
					<tr>
                    	<td><label for="username">Username</label></td>
                        <td><input type="text" name="username" id="adminName" class="textField" /></td>
                    </tr>
                    <tr>
                    	<td><label for="idNo">ID Number</label></td>
                        <td><input type="text" class="textField" name="idNo" id="idNo" /></td>
                    </tr>
                    <tr>
                    	<td><label for="password">Password</label></td>
                        <td><input type="password" name="password" id="password" class="textField" /></td>
                    </tr>
                    <tr>
                    	<td><label for="passwordConfirm">Confirm Password</label></td>
                        <td><input type="password" name="passwordConfirm" id="passwordConfirm" class="textField" /></td>
                    </tr>
                    <tr>
                    	<td><input type="submit" value="Submit" /></td>
                        <td><input type="reset" value="Clear" /></td>
                    </tr> 
                	
                </table>
          	</section>
   	</form> ';

	}
	
	function processForm()
	{
		$db = new DB_Functions();
		$error_msg ="";
	
		//validate user input
		if($_POST['adminname'] == "")
		{
			printForm();
			echo "Invalid Name.\n";
			return;
		}
		else if($_POST['idNo'] == "")
		{
			printForm();
			echo "Invalid IdNo.\n";
			return;
		}
		else if($_POST['password'] == "")
		{
			printForm();
			echo "Invalid Password.\n";
			return;
		}
		else if($_POST['password'] != $_POST['passwordConfirm'])
		{
			printForm();
			echo "Passwords do not match!\n";
			return;
		}
		else if($_POST['username'] == "")
		{
			printForm();
			echo "Invalid Username.\n";
			return;
		}
		
		//save data to table
		$result = $db->administratorSignUp($_POST['username'],md5($_POST['password']),$_POST['idNo'],$_POST['adminname']);
		
		if(!$result == false)
		{
			//data was successfully saved to database
			header('Location: http://localhost/eserver/account.php');
		}
		else
		{ 
			$error_msg ="Data could not be saved in database.\n";
			printForm();
		}
		
	}
?>
    
</section>

<footer>
	<section id="logo">
    </section>
    <section id="text">
    	<p>Your listening caring partner</p>
    </section>
</footer>
</section>

</body>
</html>