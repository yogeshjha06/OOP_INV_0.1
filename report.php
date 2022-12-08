<head>
    <title>Report Master</title>
</head>

<center>
<form method="POST">
    <button type="submit" name="i">Item</button>
    <button type="submit" name="v">Vendor</button>
    <button type="submit" name="p">Purchase</button>
    <button type="submit" name="s">Sale</button>
    <button type="submit" name="r">Report</button>
</form>
</center>
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
$con=mysqli_connect("localhost","root","","cinv");//connection
?>
<link rel="stylesheet" href="main.css" type="text/css">
<center>
<table id="customers">
    <tr>
        <th colspan="3">STOCK REPORT</th>
    </tr>
    <tr>
    <th>SNO</th>
    <th>ITEM</th>
    <th>STOCK</th>
    </tr>
    <?php
$sql="SELECT * FROM `item` WHERE status=1 AND qun>0";
$result=$con->query($sql);
$no=1;
while($row=$result->fetch_assoc())
{
  echo"
  <tr>
    <td>".$no."</td>
    <td>".$row["item"]."</td>
    <td>".$row["qun"]."</td>
    </tr>
  ";
  $no++;
}
?>
</table>
<br>
<table id="customers">
    <tr>
        <th colspan="6">PURCHASE REPORT</th>
    </tr>
    <tr>
        <th>SNO</th>
        <th>RECEPIT NO</th>
        <th>ITEM</th>
        <th>ITEM PRICE</th>
        <th>ITEM QUNTITY</th>
        <th>PURCHASE AMOUNT</th>
    </tr>

<?php
$sql="SELECT a.item, a.price, b.item_qun, b.item_amt, b.master_id FROM `item` a INNER JOIN `purchase_data` b ON a.id=b.item_id ORDER BY b.id DESC  ";
$result=$con->query($sql);
$no=1;
while($row=$result->fetch_assoc())
{
  echo"
  <tr>
    <td>".$no."</td>
    <td>".$row["master_id"]."</td>
    <td>".$row["item"]."</td>
    <td>".$row["price"]."</td>
    <td>".$row["item_qun"]."</td>
    <td>".$row["item_amt"]."</td>
    </tr>
  ";
  $no++;
}
?>

</table>
<br>
<table id="customers">
    <tr>
        <th colspan="6">SALE REPORT</th>
    </tr>
    <tr>
        <th>SNO</th>
        <th>RECEPIT NO</th>
        <th>ITEM</th>
        <th>ITEM PRICE</th>
        <th>ITEM QUNTITY</th>
        <th>PURCHASE AMOUNT</th>
    </tr>

<?php
$sql="SELECT a.item, a.price, b.item_qun, b.item_amt, b.sale_id FROM `item` a INNER JOIN `sale_data` b ON a.id=b.item_id ORDER BY b.id DESC  ";
$result=$con->query($sql);
$no=1;
while($row=$result->fetch_assoc())
{
  echo"
  <tr>
    <td>".$no."</td>
    <td>".$row["sale_id"]."</td>
    <td>".$row["item"]."</td>
    <td>".$row["price"]."</td>
    <td>".$row["item_qun"]."</td>
    <td>".$row["item_amt"]."</td>
    </tr>
  ";
  $no++;
}
?>

</table>

<br>
<button onclick="window.print()">Print Recepit</button>
</center>