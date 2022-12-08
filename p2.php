<head>
    <title>Purchase Manage</title>
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
<link rel="stylesheet" href="main.css" type="text/css">
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
include 'bd.php';///oop class
$rno=$_GET['rno'];
$name=$_GET['name'];
$date=$_GET['date'];

$con=mysqli_connect("localhost","root","","cinv");//connection
$sql1 = "SELECT * FROM `vendor` WHERE `vendor`='$name'";
$q=mysqli_query($con,$sql1);
$row = mysqli_fetch_array($q);
$ph = $row[2];//phone
$add = $row[3];//add
$idi = $row[0];//vendor id
?>
<center>
        <h3>Purchase Manage</h3>
        <form method='POST'>
        <table id='customers'>
            <tr>
                <td>Reciving Date</td>
                <td><input type='text' name='date' value='<?php echo$date;?>'/>
            </tr>
            <tr>
                <td>Vendor Contact</td>
                <td><input type='number' name='ph' value='<?php echo$ph;?>'/>
            </tr>
            <tr>
                <td>Vendor Address</td>
                <td><input type='text' name='add' value='<?php echo$add;?>'/>
            </tr>
            <tr>
                <td><button style='width:100%' type='submit' name='back'>BACK</button></td>
                <td><button style='width:100%' type='submit' name='ok'>UPDATE</button></td>                
            </tr>
        </table>
    </form>
    </center>





<?php
        // insert method
        if(isset($_POST['ok']))
        {
             $ins = new bd();
             echo $ins->edit_pur($idi,$_POST['ph'],$_POST['add'],$_POST['date']);//edit id data
             header("location: purchase.php");
        }
        if(isset($_POST['back']))
        {
             header("location: purchase.php");
        }
?>