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
include 'bd.php';

?>
<link rel="stylesheet" href="main.css" type="text/css">






<center>
<h3>Sale Master</h3>
<div id="abc">
<form method='POST' onsubmit="return validate();">
    <table id="customers">
        <tr>
            <td>Receipt No</td>
            <td><input type='number' maxlength="6" placeholder='Receipt No' name='rno' required/></td>
        </tr>
        <tr>
            <td>Reciving Date</td>
            <td><input style='width:100%' type="date" name="date" value="2022-10-27" min="2018-01-01" max="2025-10-27"></td>
        </tr>
        <tr>
            <td>Custommer Name</td>
            <td><input type="text" placeholder="Enter Client Name" name ="client"/></td>
        </tr>
        <tr>
            <td>Custommer Contact</td>
            <td><input type='number' id = 'size' placeholder='Receipt No' name='ph' /></td>
        </tr>
        <tr>
            <td>Custommer Address</td>
            <td><input type='text' id = 'size' placeholder='Receipt No' name='add' /></td>
        </tr>
        <tr>
            <td colspan='2'><button style='width:100%' type="submit" name='pro'>Proceed</button></td>
        </tr>
    </table>
</form>
</div>
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
        alert("Contact is invalid");
        return false;
    }
}
</script>



<?php
  if(isset($_POST['pro']))
  {
    $ins = new bd();
    echo $ins->sale_ins($_POST['rno'],$_POST['date'],$_POST['client'],$_POST['ph'],$_POST['add']);
    header("location: s1.php?date=$_POST[date]&rno=$_POST[rno]&client=$_POST[client]&ph=$_POST[ph]&add=$_POST[add]");
  }
?>



<CENTER>
<table id="customers">
<tr>
        <th>SNO</th>
        <th>RECEPIT NO</th>
        <th>DATE OF SALE</th>
        <th>CLIENT</th>
        <th>AMOUNT</th>
        <th colspan="2">ACTION</th>
    </tr>
<?php
$con=mysqli_connect("localhost","root","","cinv");//connection
$sql="SELECT * FROM  `sale_master` ORDER BY id DESC";
$result=$con->query($sql);
$no=1;
while($row=$result->fetch_assoc())
{
  echo"
  <tr>
    <td>".$no."</td>
    <td>".$row["rno"]."</td>
    <td>".$row["date"]."</td>
    <td>".$row["client"]."</td>
    <td>".$row["amount"]."</td>
    <td> <button><a href='http://localhost/oop/bd.php?id=$row[rno]&n=4'>Delete</a></button></td>       
    <td> <button><a href='s2.php?date=$row[date]&name=$row[client]&rno=$row[rno]&ph=$row[ph]&add=$row[add]'>Edit</a></button></td>    
    </tr>
  ";
  $no++;
}

?>
</table>
</CENTER>