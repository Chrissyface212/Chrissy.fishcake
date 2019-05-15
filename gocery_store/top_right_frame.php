<?php
session_start();

$conn = mysqli_connect('rerun', 'potiro', 'pcXZb(kL', 'poti');
if (!$conn)
{
  die('Could not connect: ' . mysql_error());
}

$id = $_GET['product_id'];
$query_string = "select * from products where product_id = $id ";
$result=mysqli_query($conn,$query_string);
$_SESSION['product_id'] = $id;
$row = mysqli_fetch_row($result);
mysqli_close($conn);
?>


<!DOCTYPE html>
<html>
<head>
  <title>Product details</title>
</head>
<style>
*{
  margin:0px;
  padding:0px;
}
body{
  background-color:#792f8a;
}

.table{
  white-space: auto;
  width: 92%;
  margin: auto;
  padding: auto; 
  height: auto;
  display: block;
  text-align:center;
  font-family:sans-serif;
  color: white;
}
.main{
  width: 100%;
  margin: auto;
  height: auto;
  display: block;
  text-align: center;
  font-family:sans-serif;
  color: #AFEEEE;
}
.submit{
  font:width: 100%;
  margin: auto;
  height: auto;
  text-align: center;
  font-family:sans-serif;
  color: white;

}


</style>
<script type="text/javascript">
  function check_quantity(quantity)
  {
    qua_num=document.quantityform.quantity.value;
    if (qua_num == "" || qua_num == 0)
    {
      window.alert("Please enter the required quantity");
      return false;

    }
    if (qua_num > quantity)
    {
      window.alert("The required quantity is unavaliable");
      return false;

    }
    if (isNaN(qua_num))
    {
      window.alert("Please enter a valid quantity");
      return false;

    }

    return true;
  }
</script>
<body>

  <div class="main">
    <h1 align="center">Detail</h1>
    <br><br>

    <div class="table">
      <table width=100%>
        <tr>
          <th>Product ID</th>
          <th>Product Name</th>
          <th>Unit Price ($)</th>
          <th>Unit Quantity</th>
          <th>In Stock</th>
          <th>Quantity</th>
        </tr>
        <?php 
        echo "<tr>";
        echo "<td>".$row[0]."</td>";
        echo "<td>".$row[1]."</td>";
        echo "<td>".$row[2]."</td>";
        echo "<td>".$row[3]."</td>";
        echo "<td>".$row[4]."</td>";
        echo "<td><input id=\"quantity\" type=\"text\" value=\"1\" /></td>";
        echo "</tr>";
        ?>
      </table>
      <br>
      <div id="submit" onclick="handleSubmit()">
          <input type="submit" value="Add">
        </div>
    </div>
    <script type="text/javascript">
    function handleSubmit() {
      var quantity=parseInt(document.getElementById("quantity").value);
      console.log(quantity);
      if (isNaN(quantity) || quantity < 1) {
        return alert("Add atleast one item to the cart");
      }
      if (quantity > 20) {
        return alert("Can not add more then 20 to cart");
      }
      var url = "bottom_right_frame.php?product_id=<?php echo $id ?>&quantity="+quantity;
      parent.bottom_right_frame.location.href = url;
    }
  </script>

  </body>
  </html>