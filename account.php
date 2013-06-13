<!doctype html>
<html>
<html lang="en-US" />
<head>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="Stylesheets/HTML5DoctorCSSReset.css">
<link rel="stylesheet" type="text/css" href="spryStyle.css" />
<link rel="stylesheet" type="text/css" href="mainStyleSheet.css">
<script type="text/ecmascript" src="scripts/jquery-1.7.2.js"></script>
<script type="text/javascript">
var jq=jQuery.noConflict();
jq(document).ready(function(){
jq("#slideShow section:gt(0)").hide();
		setInterval(function(){
			jq("#slideShow > section:first-child").fadeOut(4000)
			.next().fadeIn(4000)
			.end().appendTo("#slideShow");
	}, 10000);
	});
</script>

<script type="text/javascript">
	jq(function(){
		jq('#coolMenu').find('> li').hover(function(){
			jq(this).find('ul')
			.removeClass('NoJS')
			.stop(true, true).slideToggle('fast');
		});
	});
</script>


<style type="text/css">
	/*#header{
		margin-bottom: 400px;*/
	}
</style>
<title>Account</title>
</head>

<body>
    <section id="wrapper">
        <section id="header">
        <section id="logo">
        </section>
        <section id="text">
            <h2>Equity Bank Android server</h2>
        </section>
    	<section id="logOut">
                <p><a href="index.php"> Logout</a></p>
            </section>
    </section>


<section id="slideNavWrapper">
   	<section id="spryMenu">
        <ul id="coolMenu">
            <li><a href="#">Admins</a>
                <ul class="NoJS">
                    <li><a href="createNewAdmin.php">Create new Admin</a></li>
                    <li><a href="#">View Admin</a></li>
                    <li><a href="editAdmin.php">Edit Admin</a></li>
                    <li><a href="deleteAdmin.php">Delete Admin</a></li>
                </ul>
            </li>
            <li><a href="#">Exchange rates</a>
                <ul class="NoJS">
                    <li><a href="createNewCurrency.php">Create new Exchange rate</a></li>
                    <li><a href="#">View Exchange rates</a></li>
                    <li><a href="editCurrencyRate.php">Edit Exchange rate</a></li>
                    <li><a href="deleteCurrency.php">Delete Exchange rate</a></li>
                </ul>
            </li>
            <li><a href="#">FDR</a>
                <ul class="NoJS">
                    <li><a href="createNewFixedDeposit.php">Create new FDR</a></li>
                    <li><a href="#">View FDR</a></li>
                    <li><a href="editFixedDepositRate.php">Edit FDR</a></li>
                    <li><a href="DeleteFixeddeposit rate.php">Delete FDR</a></li>
                </ul>
            </li>
            <li><a href="#">Sharelisting</a>
                <ul class="NoJS">
                    <li><a href="createAShareListing.php">Create new Sharelisting</a></li>
                    <li><a href="#">View Sharelisting</a></li>
                    <li><a href="editShareListing.php">Edit Sharelisting</a></li>
                    <li><a href="deleteShareListing.php">Delete Sharelisting</a></li>
                </ul>
            </li>
            <li><a href="#">Android users</a>
                <ul class="NoJS">
                    <li><a href="viewAndroidUsers.php">View Android user</a></li>
                </ul>
            </li>
            <li><a href="#">Adverts</a>
                <ul class="NoJS">	
                    <li><a href="createNewAd.php">Create new Advert</a></li>
                    <li><a href="#">View Adverts</a></li>
                    <li><a href="editAdvert.php">Edit Adverts</a></li>
                    <li><a href="deleteAd.php">Delete Adverts</a></li>
                </ul>
            </li>
        </ul>
    </section>

    <section id="slideShow">
        <section class="intro1">
                <img src="Graphics/images/top.jpg" />
        </section>
        <section class="intro2">
               <img src="Graphics/images/top2.jpg" />
        </section>
        <section class="intro3">
               <img src="Graphics/images/top5.jpg" />
        </section>
        <section class="intro2">
               <img src="Graphics/images/top3.jpg" />
        </section>
    </section>
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