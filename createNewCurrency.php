<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="mainStyleSheet.css">
<title>Create new currency Rate</title>
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
	
	if(isset($_POST['currency']) && isset($_POST['buyingRate']) && isset($_POST['sellingRate']))
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
		'<form action="createNewCurrency.php" method="post">
            <section id="formDetail">
            	<h3>Create new Exchange rate</h3>
                <table>
                	<tr>
                    	<td><label for="currency">Currency</label></td>
                        <td><input type="text" name="currency" id="currency" class="textField" /></td>
                    </tr>
                    <tr>
                    	<td><label for="buyingRate">Buying rate</label></td>
                        <td><input type="text" name="buyingRate" id="buyingRate" class="textField" /></td>
                    </tr>
                    <tr>
                    	<td><label for="sellingRate">Selling rate</label></td>
                        <td><input type="text" name="sellingRate" id="sellingRate" class="textField" /></td>
                    </tr>
                    <tr>
                    	<td><input type="submit" value="Create" /></td>
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
		if($_POST['currency'] == "")
		{
			printForm();
			echo "Invalid Currency Entered.\n";
			return;
		}
		else if($_POST['buyingRate'] == "")
		{
			printForm();
			echo "Invalid Buying Rate.\n";
			return;
		}
		else if($_POST['sellingRate'] == "")
		{
			printForm();
			echo "Invalid Selling Rate.\n";
			return;
		}
		
		
		//save data to table
		$result = $db->addExchangeRate($_POST['currency'],$_POST['buyingRate'],$_POST['sellingRate']);
		
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