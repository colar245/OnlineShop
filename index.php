<?php 
	include("funkcije/functions.php");
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Prodaja komponenti | SteD</title>
	<link rel="stylesheet" type="text/css" href="styles/style.css" media="all">
</head>
<body>
		<!--*************POSAVANJE CELE STRANICE********************-->
		<div class="okvirStranice">
		<!--******************HEADER*********************-->
			<div class="okvirHeader">
				<ul id="meniLista" style="list-style-type: none; color:">
					<li><a href="#">Contact Us</a></li>
					<li><a href="cart.php">Sopping Cart</a></li>
					<li><a href="#">Sign Up</a></li>
					<li><a href="kupac-korisnik/my_account.php">My Account</a></li>
					<li><a href="all_products.php">All Products</a></li>
					<li><a href="index.php">Home</a></li>
				</ul>
				<div id="searchHeader">
					<form action="result.php" method="GET">
						<input id="search" type="text" name="search" placeholder="Search..." />
						<input class="dugme" type="submit" name="submit" value="Search"/>
					</form>
				</div>
			</div>
			<!--***************BODY**************************-->
			<div class="okvirBody">
				<div id="meni">
					<div id="meni_title">Categories</div>
					<ul id="cats">
						<?php getCats(); ?>
					</ul>
					<div id="meni_title">Brands</div>
					<ul id="cats">
						<?php getBrands(); ?>
					</ul>


				</div>
<!--*****************************SADRZAJ STRANICE I PRIKAZIVANJE PROIZVODA*******************-->				
		<div id="sadrzaj">
					<?php cart(); ?>
					<div id="shopping_cart">

						<span style="float:right; font-size: 18px;padding: 5px;line-height: 40px;">Welcome Guest!<b style="color: #111111;"> Shopping cart -</b> Total items: <?php total_items(); ?> Total price: <?php total_price(); ?><a href="cart.php"><img  style="height: 40px;width:40px; float: right;margin-left: 10px;" src="shopping cart.png"></a>


						</span>
					</div>
					<div id="products_box">
						<?php getPro(); ?>
						<?php getCatPro(); ?>
						<?php getBrandPro(); ?>
					</div>
		</div>
			</div>
			<!--**************FOOTER**********************-->
			<div class="okvirFooter">
					<div id="copyright">&copy Stefan Aleksic & Lazar Mladenovic 2016</div>
					<?php echo $ip=getIp(); ?>

			</div>
		</div>
</body>
</html>