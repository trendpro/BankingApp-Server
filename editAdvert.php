<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="mainStyleSheet.css">
<title>Create new Ad</title>
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
<form action="createNewAd.php" method="post">
            <section id="formDetail">
            	<h3>Edit Advert</h3>
                <table>
                	<tr>
                    	<td><label for="ad">Advert</label></td>
                        <td><input type="text" class="textField" name="ad" id="adName"/></td>
                    </tr>
                    <tr>
                    	<td><label for="ad_url">Advert URL</label></td>
                        <td><input type="text" class="textField" name="ad_url" id="adName" /></td>
                    </tr>
                    <tr>
                    	<td><label for="ad_category">Advert Category</label></td>
                        <td>
                        	<select  class="textField" name="ad_category" id="adName" >
                        		<option>1a</option>
                            	<option>1b</option>
                            	<option>2a</option>
                            	<option>2b</option>
                            	<option>3a</option>
                            	<option>3b</option>
                            	<option>4a</option>
                            	<option>4b</option>
                            	<option>g</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                    	<td><input type="submit" value="Create" /></td>
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