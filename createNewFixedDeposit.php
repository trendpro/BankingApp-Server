<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="mainStyleSheet.css">
<title>Create new FDR</title>
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
	
	if(isset($_POST['rangeFrom']) && isset($_POST['rangeTo']) && isset($_POST['1MonthPa']) && isset($_POST['3MonthPa']) && isset($_POST['6MonthPa']) && isset($_POST['1YearPa']))
	{
		processForm();
	}
	else
	{
		printForm();
	}
	
	/*
	 * Displays a for for user input
	 */	
	function printForm()
	{
		echo
		  '<form action="createNewFixedDeposit.php" method="post">
            <section id="formDetail">
            	<h3>Create New Fixed Deposit Rate</h3>
                <table>
                	<tr>
                    	<td><label for="rangeFrom">Range from</label></td>
                        <td><input type="text" name="rangeFrom" id="rangeFrom" class="textField" /></td>
                    </tr>
                    <tr>
                    	<td><label for="rangeTo">Range To</label></td>
                        <td><input type="text" name="rangeTo" id="rangeTo" class="textfield"/></td>
                    </tr>
                    <tr>
                    	<td><label for="1MonthPa">1 Month Pa</label></td>
                        <td><input type="text"name="1MonthPa" id="1MonthPa" class="textfield"/></td>
                    </tr>
                    <tr>
                    	<td><label for="3MonthPa">3 Month Pa</label></td>
                        <td><input type="text"name="3MonthPa" id="3MonthPa" class="textfield"></td>
                    </tr>
                    <tr>
                    	<td><label for="6MonthPa">6 Month Pa</label></td>
                        <td><input type="text"name="6MonthPa" id="6MonthPa" class="textfield"/></td>
                    </tr>
                    <tr>
                    	<td><label for="1YearPa">1 Year Pa</label></td>
                        <td><input type="text"name="1YearPa" id="1YearPa" class="textfield"/></td>
                    </tr>
                    <tr>
                    	<td><input type="submit" value="Create" /></td>
                    </tr>
                    <tr>
                    	<td></td>
                        <td></td>
                    </tr>
                	
                </table>
          	</section>
   	</form>';

	}
	
	function processForm()
	{
		$db = new DB_Functions();
	
		//validate user input
		if($_POST['rangeFrom'] == "")
		{
			printForm();
			echo "Invalid From Range.\n";
			return;
		}
		else if($_POST['rangeTo'] == "")
		{
			printForm();
			echo "Invalid Invalid Range To.\n";
			return;
		}
		else if($_POST['1MonthPa'] == "")
		{
			printForm();
			echo "Invalid 1 month pa Value.\n";
			return;
		}
		else if($_POST['3MonthPa'] == "")
		{
			printForm();
			echo "Invalid 3 month pa Value.\n";
			return;
		}
		else if($_POST['6MonthPa'] == "")
		{
			printForm();
			echo "Invalid 6 month pa Value.\n";
			return;
		}
		else if($_POST['1YearPa'] == "")
		{
			printForm();
			echo "Invalid 1 Year pa Value.\n";
			return;
		}
		
		//save data to table
		$result = $db->addFixedDepositRate($_POST['rangeFrom'],$_POST['rangeTo'],$_POST['1MonthPa'],$_POST['3MonthPa'],$_POST['6MonthPa'],$_POST['1YearPa']);
		
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
		
	}//end of processForm();
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