<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="mainStyleSheet.css">
<title>Create new Share lisiting</title>
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
	
	if(isset($_POST['companyName']) && isset($_POST['lastTradedPrice']) && isset($_POST['previousPrice']))
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
		'<form action="createAShareListing.php" method="post">
            <section id="formDetail">
            	<h3>Create a share listing</h3>
                <table>
                	<tr>
                    	<td><label for="companyName">Company Name</label></td>
                        <td><input type="text" name="companyName" id="companyName" class="textField" /></td>
                  	</tr>
                    <tr>
                    	<td><label for="lastTradedPrice">Last traded price</label></td>
                        <td><input type="text" name="lastTradedPrice" id="lastTradedPrice" class="textField" /></td>
                    </tr>
                    <tr>
                    	<td><label for="previousPrice">PreviousPrice</label></td>
                        <td><input type="text" name="previousPrice" id="previousPrice" class="textField" /></td>
                    </tr>
                    <tr>
                    	<td><input type="submit" value="Create" /></td>
                        <td><input type="reset" value="Cancel" /></td>
                    </tr>
                    
                	
                </table>
          	</section>
   	</form>';

	}
	
	function processForm()
	{
		$db = new DB_Functions();
		$error_msg ="";
	
		//validate user input
		if($_POST['companyName'] == "")
		{
			printForm();
			echo "Invalid Company Name.\n";
			return;
		}
		else if($_POST['lastTradedPrice'] == "")
		{
			printForm();
			echo "Invalid Last Traded Price Value.\n";
			return;
		}
		else if($_POST['previousPrice'] == "")
		{
			printForm();
			echo "Invalid Previous Price Value.\n";
			return;
		}
		
		
		//save data to table
		$change = $_POST['lastTradedPrice'] - $_POST['previousPrice'];
		
		$result = $db->addShareListingEntry($_POST['companyName'],$_POST['lastTradedPrice'],$_POST['previousPrice'],$change);
		
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