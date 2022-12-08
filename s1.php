<head>
    <title>Sale Master</title>
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
error_reporting(0);
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
include 'bd.php';///oop class

?>
<link rel="stylesheet" href="main.css" type="text/css">


<?php
$rno=$_GET['rno'];
$date=$_GET['date'];
$client=$_GET['client'];
$ph = $_GET['ph'];//contact
$add = $_GET['add'];//address
$con=mysqli_connect("localhost","root","","cinv");//connection



?>

<div id="show">
    <center>
    <h3>Sale Master</h3>
    <form method="POST">
        <table id="customers">
            <tr>
                <td>Receipt No</td>
                <td><input type='number' name='rno' value="<?php echo$rno; ?>" readonly/></td>
            </tr>
            <tr>
                <td>Reciving Date</td>
                <td><input style='width:100%' type="date" name="rdate" value="<?php echo$date;?>" min="1996-01-01" max="2025-10-27"></td>
            </tr>
            <tr>
                <td>Client Name</td>
                <td><input type='text' name='vendor' value="<?php echo$client; ?>" readonly/></td>
            </tr>
            <tr>
                <td>Client Contact</td>
                <td><input type='number' name='ph' value="<?php echo$ph; ?>" readonly/></td>
            </tr>
            <tr>
                <td>Client Address</td>
                <td><input type='text' name='add' value="<?php echo$add; ?>" readonly/></td>
            </tr>
            <tr>
                <th colspan="2">Sale List</th>
            </tr>
            <tr>
                <td>Item Name</td>
                <td><select style='width:100%' name="item" id="item">    
                <?php $con=mysqli_connect("localhost","root","","cinv");//connection
                      $sql="SELECT * FROM `item`";//query
                      $result2=mysqli_query($con,$sql);?>            
                <?php while ($row2=mysqli_fetch_array($result2)):; ?>
                <option value="<?php echo$row2[0];?>"><?php echo$row2[1];?></option>
                <?php endwhile;?>
            </select></td>
            </tr>

            <tr>
                <td>Item Sale Quntity</td>
                <td><input type='number' name='qun' placeholder="Item Quntity"/></td>
            </tr>
            <tr>
                <td>Item Sale Price</td>
                <td><input type='number' name='price' placeholder="Item Price"/></td>
            </tr>
            <tr>                
                <td colspan="2"><button style='width:100%' type="submit" name='ok'>ADD</button></td>
            </tr>
        </table>
    </form>
    </center>
</div>

<?php




if(isset($_POST['ok']))
{
    $ins = new bd();
    echo $ins->sd_ins($_POST['rno'],$_POST['item'],$_POST['price'],$_POST['qun']);//insert data bd class
    ///next item purchase list//////
}


?>




<center>
</table>
<table id="customers">
    <tr>
        <th>SNO</th>
        <th>ITEM</th>
        <th>PRICE</th>
        <th>QUNTITY</th>
        <th>AMOUNT</th>
    </tr>


<?php
$sql="SELECT a.item, a.price, b.item_qun, b.item_amt FROM `item` a INNER JOIN `sale_data` b ON a.id=b.item_id AND sale_id=$rno ORDER BY b.id DESC  ";
$result=$con->query($sql);
$no=1;
while($row=$result->fetch_assoc())
{
  echo"
  <tr>
    <td>".$no."</td>
    <td>".$row["item"]."</td>
    <td>".$_POST['price']."</td>
    <td>".$row["item_qun"]."</td>
    <td>".$row["item_amt"]."</td>
    </tr>
  ";
  $no++;
}
?>
</table>
<br>
<table>
    <tr>
        <td><button style='width:100%' type='submit' name='ok'><a href='sale.php'>Submit</a></button></td>

        <td><button onclick="window.print()">Print Recepit</button></td>
    </tr>
</table>
</center>