<!DOCTYPE html>
<head>
<link rel="stylesheet" type="text/css" href="Stylesheets/HTML5DoctorCSSReset.css"  />
<script type="text/javascript" src="scripts/jquery-1.7.2.js">
</script>
<script type="text/javascript">
	$(function(){
		$('#coolMenu').find('> li').hover(function(){
			$(this).find('ul')
			.removeClass('NoJS')
			.stop(true, true).slideToggle('fast');
		});
	});
</script>

<link rel="stylesheet" type="text/css" href="spryStyle.css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>CSS Spry</title>
</head>

<body>

<section id="spryMenu">
	<ul id="coolMenu">
    	<li><a href="#">Admins</a>
        	<ul class="NoJS">
            	<li><a href="#">Create new Admin</a></li>
                <li><a href="#">View Admin</a></li>
                <li><a href="#">Edit Admin</a></li>
                <li><a href="#">Delete Admin</a></li>
            </ul>
        </li>
        <li><a href="#">Exchange rates</a>
        	<ul class="NoJS">
        		<li><a href="#">Create new Exchange rate</a></li>
                <li><a href="#">View Exchange rates</a></li>
                <li><a href="#">Edit Exchange rate</a></li>
                <li><a href="#">Delete Exchange rate</a></li>
           	</ul>
        </li>
        <li><a href="#">FDR</a>
        	<ul class="NoJS">
                <li><a href="#">Create new FDR</a></li>
                <li><a href="#">View FDR</a></li>
                <li><a href="#">Edit FDR</a></li>
                <li><a href="#">Delete FDR</a></li>
           	</ul>
        </li>
        <li><a href="#">Sharelisting</a>
        	<ul class="NoJS">
                <li><a href="#">Create new Sharelisting</a></li>
                <li><a href="#">View Sharelisting</a></li>
                <li><a href="#">Edit Sharelisting</a></li>
                <li><a href="#">Delete Sharelisting</a></li>
           	</ul>
        </li>
        <li><a href="#">Android users</a>
        	<ul class="NoJS">
            	<li><a href="#">Create new Android user</a></li>
                <li><a href="#">View Android user</a></li>
                <li><a href="#">Edit Android user</a></li>
                <li><a href="#">Delete Android user</a></li>
            </ul>
        </li>
        <li><a href="#">Adverts</a>
        	<ul class="NoJS">	
                <li><a href="#">Create new Advert</a></li>
                <li><a href="#">View Adverts</a></li>
                <li><a href="#">Edit Adverts</a></li>
                <li><a href="#">Delete Adverts</a></li>
        	</ul>
        </li>
    </ul>
</section>

</body>
</html>
