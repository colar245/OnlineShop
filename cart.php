<?php 
session_start();
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
		<div id="sadrzaj" style="background-color: white;">
					<?php cart(); ?>
					<div id="shopping_cart">

						<span style="float:right; font-size: 18px;padding: 5px;line-height: 40px;">Welcome Guest!<b style="color: #ffa64d;"> Shopping cart -</b> Total items: <?php total_items(); ?> Total price: <?php total_price(); ?><a href="cart.php"><img  style="height: 40px;width:40px; float: right;margin-left: 10px;" src="shopping cart.png"></a>


						</span>
					</div>
					<div id="products_box" style="background-color: white;">
					<br>
						<form action="" method="POST" enctype="multipart/form-data">
							<table align="center" width="700" bgcolor="skyblue">
								
								<tr> <!--Table rows-->
									<th>Remove</th> <!--Table heading-->
									<th>Product(s)</th>
									<th>Quantity</th>
									<th>Total Price</th>
								</tr>
								<?php 
								$total = 0;

								$ip = getIp();

								$sel_price = "SELECT * FROM cart WHERE ip_add = '$ip'";

								$run_price = mysqli_query($connection, $sel_price);

								while ($p_price = mysqli_fetch_array($run_price)) {
									
									$pro_id = $p_price['p_id'];

									$pro_price = "SELECT * FROM products WHERE product_id = '$pro_id'";

									$run_pro_price = mysqli_query($connection, $pro_price);

									while ($pp_price = mysqli_fetch_array($run_pro_price)) {
										
										$product_price = array($pp_price['product_price']);
										$product_title = $pp_price['product_title'];
										$product_image = $pp_price['product_image'];

										$single_price = $pp_price['product_price'];

										$values = array_sum($product_price);

										$total += $values;
								
								//echo "<b style='text-decoration:underline;'>$$total</b>";
								?>
								<tr align="center">
									<td><input type="checkbox" name="remove[]" value="<?php echo $pro_id ?>" /></td>
									<td><?php echo $product_title ?><br>
									<img src="admin_zona/product_images/<?php echo $product_image ?>" width="60" height="60"/></td>
									<td><input type="text" size="4" name="qty"/></td>
									<?php 
										if (isset($_POST['update_cart'])) {
											$qty = $_POST['qty'];
											$update_qty = "UPDATE cart SET qty = '$qty'";
											$run_update_qty = mysqli_query($connection, $update_qty);

											$_SESSION['qty']=$qty;

										}
									 ?>
									<td><?php echo "$" . $single_price ?></td>
								</tr>


								<?php } } ?>
								<tr align="right">
									<td colspan="3"><b>Sub Total:</b></td>
									<td ><?php echo "$" . $total ?></td>
								</tr>

								<tr align="center">
									<td colspan="2"><input type="submit" name="update_cart" value="Update Cart"></td>
									<td><input type="submit" name="continue" value="Continue Shopping"></td>
									<td><button><a href="checkout.php" style="text-decoration: none;color: black;">Checkout</a></button></td>
								</tr>
							</table>
						</form>
						<?php 
							global $connection;
							$ip = getIp();
							if (isset($_POST['update_cart'])) {
								foreach ($_POST['remove'] as $remove_id) {
									$delete_product = "DELETE FROM cart WHERE p_id = '$remove_id' AND ip_add = '$ip'";
									$run_delete = mysqli_query($connection, $delete_product);
									if ($run_delete) {
										echo "<script>window.open('cart.php','_self')</script>";
									}
								}
							}
							if (isset($_POST['continue'])) {
								echo "<script>window.open('index.php','_self')</script>";
							}
						 ?>
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