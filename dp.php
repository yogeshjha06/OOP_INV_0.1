<head>
    <title>Date Vise Purchase</title>
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
<form method="post">
    <table>
        <tr>
            <td>From Date</td>
            <td><input style='width:100%' type="date" name="date1" value="2022-10-28" min="1999-05-19" max="2025-10-28"></td>
        </tr>
    </table>
</form>

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
        <th>DATE</th>
    </tr>

<?php

$sql="SELECT c.date, a.item, a.price, b.item_qun, b.item_amt, b.master_id FROM `item` a INNER JOIN `purchase_data` b ON a.id=b.item_id INNER JOIN  purchase_master c ON  
b.master_id = c.rno AND c.date='$_POST[date]' ORDER BY b.id DESC  ";
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
    <td>".$row["date"]."</td>
    </tr>
  ";
  $no++;
}
?>
</table>
</center>