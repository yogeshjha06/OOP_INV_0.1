<head>
    <title>Vendor Master</title>
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
   
$con=mysqli_connect("localhost","root","","cinv");//connection
include 'bd.php';

?>
<link rel="stylesheet" href="main.css" type="text/css">
<h3>Vendor Master</h3>
<form method='POST' onsubmit="return validate();">
    <table id='customers'>
        <tr>
            <td>Vendor Name</td>
            <td><input type='text' placeholder='Vendor Name' name='ven' required/></td>
        </tr>
        <tr>
            <td>Vendor Contact</td>
            <td><input type='number' minlength='10'  id='size' autocomplete="off" placeholder='Vendor Contact' name='ph'/></td>
        </tr>
        <tr>
            <td>Vendor Address</td>
            <td><input type='text' placeholder='Vendor Address' name='add'/></td>
        </tr>
        
        <tr>
            <td colspan='2'><button style='width:100%' type='submit' name='ok'>ADD VENDOR</button></td>
        </tr>
    </table>
</form>
</center>
<script>
function validate() 
{
 // check if input is bigger than 3
    var value = document.getElementById('size').value;

    if (value.length ==10) 
    {
        return true;
    }
    else
    {
        alert("Invalid Contact");
        return false;
    }
}
</script>

<?php
/////////////////////////////////////

$ins = new bd();//object of main bd class
if(isset($_POST['ok']))//trigger
    echo $ins->vendor_ins($_POST['ven'],$_POST['ph'],$_POST['add']);//insert data
?>


<?php

$sql = "SELECT * FROM `vendor`  ORDER BY id DESC";
$result=$con->query($sql);
$no=1;
echo"
<center>
<table id='customers'>
<tr>
    <th>SN</th>
    <th>VENDOR</th>
    <th>CONTACT</th>
    <th>ADDRESS</th>
    <th colspan='2'>ACTION</th>
</tr>";
while($row=$result->fetch_assoc())
{
echo"

<tr>
    <td>".$no."</td>
    <td>".$row["vendor"]."</td>
    <td>".$row["contact"]."</td>
    <td>".$row["address"]."</td>
    <td> <button style='width:100%'><a href='http://localhost/oop/bd.php?id=$row[id]&n=2'>Delete</a></button></td>       
    <td> <button style='width:100%'><a href='http://localhost/oop/vendor1.php?address=$row[address]&vendor=$row[vendor]&contact=$row[contact]&id=$row[id]'>Edit</a></button></td>  

</tr>

";
$no++;
}
echo"
</table>
</center>";

?>