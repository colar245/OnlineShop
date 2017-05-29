<?php 
	//konekcija sa bazom
include("config.php");
	//getting the categories

	//getting the user ip addres
function getIp() {
    $ip = $_SERVER['REMOTE_ADDR'];
 
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
 
    return $ip;
}

	//getting the total items
function total_items() {

	if (isset($_GET['add_cart'])) {
		
		global $connection;

		$ip = getIp();

		$get_items = "SELECT * FROM cart WHERE ip_add = '$ip'";

		$run_items = mysqli_query($connection, $get_items);

		$count_items = mysqli_num_rows($run_items);
		}
		else {

			global $connection;
			$ip = getIp();

			$get_items = "SELECT * FROM cart WHERE ip_add = '$ip'";

			$run_items = mysqli_query($connection, $get_items);

			$count_items = mysqli_num_rows($run_items);
		}
		echo "<b style='text-decoration:underline;'>$count_items</b>";
}
	//getting the total price of the items in the cart
function total_price() {
	global $connection;

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

			$values = array_sum($product_price);

			$total += $values;
		}
	}
	echo "<b style='text-decoration:underline;'>$$total</b>";
}


function cart() {
	if (isset($_GET['add_cart'])) {
		global $connection;
		$ip = getIp();
		$pro_id = $_GET['add_cart'];

		$check_pro = "SELECT * FROM cart WHERE ip_add = '$ip' AND p_id = '$pro_id'";

		$run_check = mysqli_query($connection, $check_pro);

		if (mysqli_num_rows($run_check) > 0) {
			echo "";
		}
		else {
			$insert_pro = "INSERT INTO cart (p_id, ip_add) VALUES ('$pro_id', '$ip')";//ispravljeno

			$run_pro = mysqli_query($connection, $insert_pro);

			echo "<script>window.open('index.php','_self')</script>";
		}
	}
}




function getCats(){
	global $connection;
	$upit = "SELECT * FROM categories";
	$query = mysqli_query($connection, $upit);

	while ($row_cats = mysqli_fetch_array($query)) {
		$cat_id = $row_cats['cat_id'];
		$cat_title = $row_cats['cat_title'];

		echo "<li><a href='index.php?cat=$cat_id'>$cat_title</a></li>";
	}
}

function getBrands(){
	global $connection;
	$upit = "SELECT * FROM brands";
	$query = mysqli_query($connection, $upit);

	while ($row_cats = mysqli_fetch_array($query)) {
		$brand_id = $row_cats['brand_id'];
		$brand_title = $row_cats['brand_title'];

		echo "<li><a href='index.php?brand=$brand_id'>$brand_title</a></li>";
	}
}

function getPro() {

	if (!isset($_GET['cat'])) {
		if (!isset($_GET['brand'])) {
			
		
	

	global $connection;

	$get_pro = "SELECT * FROM products order by RAND() LIMIT 0,6";

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
		}/*if-brand zatvoreno*/
	}/*if-cat zatvoreno*/

}/*funkcija zatvoreno*/




function getCatPro() {

	if (isset($_GET['cat'])) {
		
			$cat_id = $_GET['cat'];
		
	

	global $connection;

	$get_cat = "SELECT * FROM products WHERE product_cat='$cat_id'";

	$run_cat_pro = mysqli_query($connection, $get_cat);

	$count_cats = mysqli_num_rows($run_cat_pro);

	if ($count_cats==0) {
		echo "<h2 style='padding:20px;'>There is no product in this category!</h2>";

	} else {

	
	while ($row_cat_pro = mysqli_fetch_array($run_cat_pro)) {
		$pro_id = $row_cat_pro['product_id'];
		$pro_cat = $row_cat_pro['product_cat'];
		$pro_brand = $row_cat_pro['product_brand'];
		$pro_title = $row_cat_pro['product_title'];
		$pro_price = $row_cat_pro['product_price'];
		//$pro_desc = $row_pro['product_desc'];
		$pro_image = $row_cat_pro['product_image'];
		//$pro_id = $row_pro['product_id'];

		
		

		echo "
			<div id='single_product'>
				<h3>$pro_title</h3>
				<img src='admin_zona/product_images/$pro_image' width='200' height='200'/>
				<p><b> $$pro_price </b></p>
				<a href='details.php?pro_id=$pro_id' style='float:left;'>Details</a>
				
				<a href='index.php?pro_id=$pro_id'><button style ='float:right;'>Add to Cart</button></a>
			</div>
		";
				
			}/*while zatvoreno*/
		}/*else zatvoreno*/
	}/*if-cat zatvoreno*/

}/*funkcija zatvoreno*/


function getBrandPro() {

	if (isset($_GET['brand'])) {
		
			$brand_id = $_GET['brand'];
		
	

	global $connection;

	$get_brand = "SELECT * FROM products WHERE product_brand='$brand_id'";

	$run_brand_pro = mysqli_query($connection, $get_brand);

	$count_brands = mysqli_num_rows($run_brand_pro);

	if ($count_brands==0) {
		echo"<h2 style='padding:20px;'>There is no product in this category!</h2>";
	}
	else {


	while ($row_brand_pro = mysqli_fetch_array($run_brand_pro)) {
		$pro_id = $row_brand_pro['product_id'];
		$pro_cat = $row_brand_pro['product_cat'];
		$pro_brand = $row_brand_pro['product_brand'];
		$pro_title = $row_brand_pro['product_title'];
		$pro_price = $row_brand_pro['product_price'];
		//$pro_desc = $row_pro['product_desc'];
		$pro_image = $row_brand_pro['product_image'];
		//$pro_id = $row_pro['product_id'];
		echo "
			<div id='single_product'>
				<h3>$pro_title</h3>
				<img src='admin_zona/product_images/$pro_image' width='200' height='200'/>
				<p><b> $$pro_price </b></p>
				<a href='details.php?pro_id=$pro_id' style='float:left;'>Details</a>
				
				<a href='index.php?pro_id=$pro_id'><button style ='float:right;'>Add to Cart</button></a>
			</div>
		";
			}/*while zatvoreno*/
		}/*else zatvoreno*/
	}/*if-brand zatvoreno*/

}/*funkcija zatvoreno*/
 ?>
