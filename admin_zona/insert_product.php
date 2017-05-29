<?php
	include ("../funkcije/config.php");
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Inserting product</title>
	<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
  <script>tinymce.init({ selector:'textarea' });</script>
</head>
<body bgcolor="white">

	<form action="insert_product.php" method="POST" enctype="multipart/form-data">
		<table align="center" width="750" bgcolor="#00cc66" border="2">
			<tr align="center">
				<td colspan="8"><h2>Insert new post here</h2></td>
			</tr>
			<tr>
				<td align="right"><b>Product Title:</b></td>
				<td><input type="text" name="product_title" size="60" required /></td>
			</tr>
			<tr>
				<td align="right"><b>Product Category:</b></td>
				<td>
					<select name="product_cat">
						<option>Select a category</option>
								<?php
								global $connection;
								$upit = "SELECT * FROM categories";
								$query = mysqli_query($connection, $upit);

								while ($row_cats = mysqli_fetch_array($query)) {
									$cat_id = $row_cats['cat_id'];
									$cat_title = $row_cats['cat_title'];

									echo "<option value='$cat_id'>$cat_title</option>";
								}
								?>
					</select>
				</td>
			</tr>
			<tr>
				<td align="right"><b>Product Brand:</b></td>
				<td>
					<select name="product_brand">
						<option>Select a category</option>
								<?php
								global $connection;
								$upit = "SELECT * FROM brands";
								$query = mysqli_query($connection, $upit);

								while ($row_brand = mysqli_fetch_array($query)) {
									$brand_id = $row_brand['brand_id'];
									$brand_title = $row_brand['brand_title'];

									echo "<option value='$brand_id'>$brand_title</option>";
								}
								?>
					</select>
				</td>
			</tr>
			<tr>
				<td align="right"><b>Product Image:</b></td>
				<td><input type="file" name="product_image"/></td>
			</tr>
			<tr>
				<td align="right"><b>Product Price:</b></td>
				<td><input type="text" name="product_price" required/></td>
			</tr>
			<tr>
				<td align="right"><b>Product Decsription:</b></td>
				<td><textarea name="product_desc" cols="20" rows="10"></textarea></td>
			</tr>
			<tr>
				<td align="right"><b>Product Keywords:</b></td>
				<td><input type="text" name="product_keywords" size="50" required/></td>
			</tr>
			<tr align="center">
				
				<td colspan="8"><input type="submit" name="insert_post" value="Insert Now" /></td>
			</tr>
		</table>

	</form>
</body>
</html>
<?php 
	if (isset($_POST['insert_post'])) {
		//getting the text data from the fields
		$product_title = $_POST['product_title'];
		$product_cat = $_POST['product_cat'];
		$product_brand = $_POST['product_brand'];
		$product_price = $_POST['product_price'];
		$product_desc = $_POST['product_desc'];
		$product_keywords = $_POST['product_keywords'];
		//getting the image from the field
		$product_image = $_FILES['product_image']['name'];	
		$product_image_tmp = $_FILES['product_image']['tmp_name'];

		move_uploaded_file($product_image_tmp, "product_images/$product_image");


		$insert_product = "INSERT INTO products (product_cat, product_brand, product_title, product_price, product_desc, product_image, product_keywords) VALUES ('$product_cat', '$product_brand', '$product_title', '$product_price', '$product_desc', '$product_image', '$product_keywords' )";
		$insert_pro = mysqli_query($connection, $insert_product);

		if ($insert_pro) {
			echo "<script>alert('Product has been inserted')</script>";
			echo "<script>window.open('insert_product.php', '_self')</script>";
		}
	}
 ?>