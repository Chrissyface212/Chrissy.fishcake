<?php
session_start();

/*ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
ini_set('display_errors', 1);
*/
$conn = mysqli_connect('rerun', 'potiro', 'pcXZb(kL', 'poti');
if (!$conn){
  die('Could not connect: ' . mysql_error());
}
if (!empty($_POST)) {
    if ($_POST['submit'] == 'clear') {
        $_SESSION['cart'] = array();
    } else if ($_POST['submit'] == 'Checkout') {

    }
}
$cart = $_SESSION['cart'];
if (!empty($_GET) && empty($_POST)) {
    $cart[$_GET['product_id']] += $_GET['quantity'];
    $_SESSION['cart'] = $cart;
}
//var_dump($_SESSION);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Checkout</title>
</head>
<style>
*{
    margin:0px;
    /*padding:0px;*/
}
body{
    background-color:#C71585
}
.main{
    width: 100%;
    margin: auto;
    height: auto;
    display: block;
    text-align:center;
    font-family:sans-serif;
    color: #AFEEEE;

}
#cart{
    white-space: auto;
    margin: auto;
    height: auto;
    width:98%;
    color:white;
    font-family:sans-serif;
    text-align:center;
}

.button{
    font-size: 13px;
    border: 1px solid #d1a3ac;
    color: black;
    background: white;
    padding: 2px 8px 3px;
    border-radius: 4px;
    text-decoration: none;
}

</style>
<body>
    <div class="main">
        <h1>Shopping cart</h1>
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
            </thead>
            <tbody id="tableBody">
            </tbody>
        </table>
        <br><br>
        <form method="post">
            <input type="submit" value="clear" name="submit" id="clearButton" class="button">
            <a href="./checkout.php" target="_blank"  class="button">
                submit

            </a>
        </form>
    </div>

</body>
</html>