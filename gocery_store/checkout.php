<?php 
session_start();

$conn = mysqli_connect('rerun', 'potiro', 'pcXZb(kL', 'poti');
if (!$conn){
  die('Could not connect: ' . mysql_error());
}

$cart = $_SESSION['cart'];
if (!empty($_GET) && empty($_POST)) {
    $cart[$_GET['product_id']] += $_GET['quantity'];
    $_SESSION['cart'] = $cart;
}
//vr_dump($_SESSION);

?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<style>
body{
     background-color:rgba(248,81,122,.95);
 }
	.main{
    margin: auto;
    height: auto;
    display: block;
    text-align:center;
    font-family:sans-serif;
    color:#AFEEEE;
}
    #cart{
    white-space: auto;
    margin: auto;
    height: auto;
    width:100%;
    color:white;
    font-family:sans-serif;
    text-align: center;
    }

    .cdetails{
    margin: auto;
    height: auto;
    display: block;
    text-align:center;
    font-family:sans-serif;
    color:#AFEEEE;
    }
    #CustomerDetails{
    margin: auto;
    height: auto;
    width: 200px;
    text-align:center;
    font:sans-serif;
    color:white;

    }
</style>
<body>
	<div class="main">
	<h1 align="center" >Confirmation</h1>
        <br>
        <table id="cart">
            <thead>
                <tr>
                    <th scope="col">Product Name</th>
                    <th scope="col">Price Per Unit</th>
                    <th scope="col">Product Quantity</th>
                    <th scope="col">Purchase Quantity</th>
                    <th scope="col">Total Price</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($cart as $product_id => $quantity) {
                    $query_string = "select * from products where product_id = $product_id ";
                    $result=mysqli_query($conn,$query_string);
                    $row = mysqli_fetch_row($result);
                    echo "<tr>";
                    echo "<td>".$row[1]."</td>";
                    echo "<td>".$row[2]."</td>";
                    echo "<td>".$row[3]."</td>";
                    echo "<td>".$quantity."</td>";
                    echo "<td>".$row[2] * $quantity."</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    <div class="cdetails">
    <h1 align="center" >Customer Details</h1>
    <br>

<form action="mail.php" method="get">	
<table id="CustomerDetails">
    <tr><td>Name:</td>
    <td> <input type="text" id="input-name">
    </td> <td><p style="color:#AFEEEE">*</p > </td></tr>

    <tr><td>Address:</td>
        <td> <input type="text" id="input-address">
        </td><td><p style="color:#AFEEEE">*</p > </td></tr>

    <tr><td>Suburb:</td>
        <td> <input type="text" id="input-suburb">
        </td><td><p style="color:#AFEEEE">*</p > </td></tr>

    <tr><td>State:</td>
        <td> <input type="text" id="input-state">
        </td><td><p style="color:#AFEEEE">*</p > </td></tr>

    <tr><td>Country:</td>
    	<td> <input type="text" id="input-country">
    	</td><td><p style="color:#AFEEEE">*</p > </td></tr>

    	<tr><td>Email:</td>
    		<td> <input type="email"  name='email' id="input-email">
    		</td><td><p style="color:#AFEEEE">*</p > </td></tr>

    		<tr>
    			<td colspan="3"><input type="submit" value="Purchase" id="btn-Purchase"></td>

    		</tr>
    	</table>
</form>




</body>
</html>



