<head>
    <title>Item Master</title>
</head>

<center>
<form method="POST">
    <button type="submit" name="i">Item</button>
    <button type="submit" name="v">Vendor</button>
    <button type="submit" name="p">Purchase</button>
    <button type="submit" name="s">Sale</button>
    <button type="submit" name="r">Report</button>
</form>
<?php
if(isset($_POST['i']))
    header("location: item.php");
else if(isset($_POST['v']))
    header("location: vendor.php");
else if(isset($_POST['p']))
    header("location: purchase.php");
else if(isset($_POST['s']))
    header("location: sale.php");
else if(isset($_POST['r']))
    header("location: report.php");
/////////////////////////////////////
error_reporting(0);
include 'bd.php';
?>
<link rel="stylesheet" href="main.css" type="text/css">

<h3>Item Master</h3>
<form method='POST' onsubmit="return validate();">
    <table id='customers'>
        <tr>
            <td>Item Name</td>
            <td><input type='text' autocomplete="off" placeholder='Item Name' name='item' required/></td>
        </tr>
        <tr>
            <td>Item Price</td>
            <td><input type='number' maxlength='6'  id='size' autocomplete="off" placeholder='Item Price' name='price'/></td>
        </tr>
        <tr>
            <td colspan='2'><button style='width:100%' type='submit' name='ok'>ADD</button></td>
        </tr>
    </table>
</form>
</center>
<script>
function validate() 
{
 // check if input is bigger than 3
    var value = document.getElementById('size').value;

    if (value.length <= 6 && value.length > 0) 
    {
        return true;
    }
    else
    {
        alert("Amount size is invalid");
        return false;
    }
}
</script>









<?php
  $ins = new bd();

  if(isset($_POST['ok']))
    echo $ins->ins_item($_POST['item'],$_POST['price']);//insert data



    $con=mysqli_connect("localhost","root","","cinv");//connection
    $sql = "SELECT * FROM `item` ORDER BY id DESC";
    $result=$con->query($sql);
    $no=1;
    echo"
    <center>
    <table id='customers'>
    <tr>
        <th>SN</th>
        <th>ITEM</th>
        <th>PRICE</th>
        <th colspan='2'>ACTION</th>
    </tr>";
    while($row=$result->fetch_assoc())
    {
    echo"
    
    <tr>
        <td>".$no."</td>
        <td>".$row["item"]."</td>
        <td>".$row["price"]."</td>
        <td> <button style='width:100%'><a href='http://localhost/oop/bd.php?id=$row[id]&n=1'>Delete</a></button></td>       
        <td> <button style='width:100%'><a href='http://localhost/oop/item1.php?item=$row[item]&price=$row[price]&id=$row[id]'>Edit</a></button></td>  
  
    </tr>
    
    ";
    $no++;
    }
    echo"
    </table>
    </center>";
?>