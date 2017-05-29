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
					<div id="shopping_cart">

						<span style="float:right; font-size: 18px;padding: 5px;line-height: 40px;">Welcome Guest!<b style="color: #ffa64d;"> Shopping cart -</b> Total items: Total price:<a href="cart.php"><img  style="height: 40px;width:40px; float: right;margin-left: 10px;" src="shopping cart.png"></a>


						</span>
					</div>
					<div id="products_box">
						<?php 
								
									global $connection;

									$get_pro = "SELECT * FROM products";


									$run_pro = mysqli_query($connection, $get_pro);

									while ($row_pro = mysqli_fetch_array($run_pro)) {
										$pro_id = $row_pro['product_id'];
										$pro_cat = $row_pro['product_cat'];
										$pro_brand = $row_pro['product_brand'];
										$pro_title = $row_pro['product_title'];
										$pro_price = $row_pro['product_price'];
										//$pro_desc = $row_pro['product_desc'];
										$pro_image = $row_pro['product_image'];
										//$pro_id = $row_pro['product_id'];
										echo "
											<div id='single_product'>
												<h3>$pro_title</h3>
												<img src='admin_zona/product_images/$pro_image' width='200' height='200'/>
												<p><b> $$pro_price </b></p>
												<a href='details.php?pro_id=$pro_id' style='float:left;'>Details</a>
												
												<a href='index.php?add_cart=$pro_id'><button style ='float:right;'>Add to Cart</button></a>
											</div>
										";
											}/*while zatvoreno*/
									
						 ?>
					</div>
		</div>
			</div>
			<!--**************FOOTER**********************-->
			<div class="okvirFooter">
					<div id="copyright">&copy Stefan Aleksic & Lazar Mladenovic 2016</div>

			</div>
		</div>
</body>
</html>