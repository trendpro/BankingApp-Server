<!doctype html>
<html>
<?php
	//include db handler
    require_once 'include/DB_Functions.php';
    $db = new DB_Functions();
	$error_msg ="";
	
	if(isset($_POST['username']))
	{
		$user = $_POST['username'];
		$pass = md5($_POST['password']);
		
		
		$result = $db->adminLogin($user,$pass);
		//check for login info
		if($result != false)
		{
			//valid login login credentials
			while($row = mysql_fetch_array($result))
			{
				//$expire = time()+60*60*24*1;//cookies valid for one day only
				//setcookie("username",$row['Username'],$expire);
			}
			header('Location: http://localhost/eserver/account.php');
		}
		else
		{
			//invalid login credentials
			$error_msg =  "Invalid Login Credentials!";
		}
	}
	
?>
<head>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="mainStyleSheet.css">
<title>Login</title>
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
    <form method="post" action="index.php">
            <section id="formDetail">
            	<h3>Login to the server</h3>
                <table>
                	<tr>
                    	<td><label for="username">Username <span>*</span> </label></td>
                        <td><input type="text" name="username" class="textField" placeholder="enter your username" /></td>
                    </tr>
                    <tr>
                    	<td><label for="password">Password <span>*</span></label></td>
                        <td><input type="password" name="password" class="textField" placeholder="enter your password" /></td>
                    </tr>
                    <tr>
                    	<td id="error_msg"><strong><?php  if($error_msg !=""){ echo $error_msg;}?></strong></td>
                    </tr>
               		<tr>
                    	<td><input type="submit" value="login" /></td>
                        <td><input type="reset" value="clear" /></td>
                    </tr> 
                	
                </table>
          	</section>
   	</form>
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