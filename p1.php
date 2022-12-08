<head>
    <title>Purchase Master</title>
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
$name=$_GET['vendor'];
$con=mysqli_connect("localhost","root","","cinv");//connection

$sql = "SELECT `vendor`, `contact`, `address` FROM `vendor` WHERE `id`=$name";
$result = mysqli_query($con,$sql);
$row = mysqli_fetch_array($result);
$vendor = $row[0];//vendor name
$ph = $row[1];//contact
$add = $row[2];//address


?>

<div id="show">
    <center>
    <h3>Purchase Master</h3>
    <form method="POST">
        <table id="customers">
            <tr>
                <td>Receipt No</td>
                <td><input type='number' name='rno' value="<?php echo$rno; ?>"readonly/></td>
            </tr>
            <tr>
                <td>Reciving Date</td>
                <td><input style='width:100%' type="date" name="rdate" value="<?php echo$date;?>" min="1996-01-01" max="2025-10-27"></td>
            </tr>
            <tr>
                <td>Vendor Name</td>
                <td><input type='text' name='vendor' value="<?php echo$vendor; ?>"readonly/></td>
            </tr>
            <tr>
                <td>Vendor Contact</td>
                <td><input type='number' name='ph' value="<?php echo$ph; ?>"readonly/></td>
            </tr>
            <tr>
                <td>Vendor Address</td>
                <td><input type='text' name='add' value="<?php echo$add; ?>"readonly/></td>
            </tr>
            <tr>
                <th colspan="2">Purchase List</th>
            </tr>
            <tr>
                <td>Item</td>
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
                <td>Item Quntity</td>
                <td><input type='number' name='qun' placeholder="Item Quntity"/></td>
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
    echo $ins->pd_ins($_POST['rno'],$_POST['item'],$_POST['qun']);//insert data bd class
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
$sql="SELECT a.item, a.price, b.item_qun, b.item_amt FROM `item` a INNER JOIN `purchase_data` b ON a.id=b.item_id AND master_id=$rno ORDER BY b.id DESC  ";
$result=$con->query($sql);
$no=1;
while($row=$result->fetch_assoc())
{
  echo"
  <tr>
    <td>".$no."</td>
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
<table>
    <tr>
        <td><button style='width:100%' type='submit' name='ok'><a href='purchase.php'>Submit</a></button></td>

        <td><button onclick="window.print()">Print Recepit</button></td>
    </tr>
</table>
</center>