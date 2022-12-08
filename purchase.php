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
include 'bd.php';

?>
<link rel="stylesheet" href="main.css" type="text/css">


<center>
<h3>Purchase Master</h3>
<div>
<form method='POST' onsubmit="return validate();">
    <table id="customers">
        <tr>
            <td>Receipt No</td>
            <td><input type='number' id = 'size' placeholder='Receipt No' name='rno' required/></td>
        </tr>
        <tr>
            <td>Reciving Date</td>
            <td><input style='width:100%' type="date" name="rdate" value="2022-10-28" min="1999-05-19" max="2025-10-28"></td>
        </tr>
        <tr>
            <td>Vendor Name</td>
            <td><select style='width:100%' name="client" id="client">    
                <?php $con=mysqli_connect("localhost","root","","cinv");//connection
                      $sql="SELECT * FROM `vendor`";//query
                      $result2=mysqli_query($con,$sql);?>            
                <?php while ($row2=mysqli_fetch_array($result2)):; ?>
                <option value="<?php echo$row2[0];?>"><?php echo$row2[1];?></option>
                <?php endwhile;?>
            </select></td>
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

    if (value.length <= 6 && value.length > 0) 
    {
        return true;
    }
    else
    {
        alert("Recepit size is invalid");
        return false;
    }
}
</script>

<?php
/////////////////////////////////////

  if(isset($_POST['pro']))
  {
    $ins = new bd();
    echo $ins->pm_ins($_POST['rno'],$_POST['rdate'],$_POST['client']);//insert data bd class
    ///next item purchase list//////
    header("location: p1.php?date=$_POST[rdate]&rno=$_POST[rno]&vendor=$_POST[client]");
  }
?>
<CENTER>
<table id="customers">
<tr>
        <th>SNO</th>
        <th>RECEPIT NO</th>
        <th>DATE OF PURCHASE</th>
        <th>VENDOR</th>
        <th>AMOUNT</th>
        <th colspan="2">ACTION</th>
    </tr>
<?php
$con=mysqli_connect("localhost","root","","cinv");//connection
$sql="SELECT a.vendor, b.rno, b.date, b.final_amount FROM `vendor` a INNER JOIN `purchase_master` b ON a.id=b.vendor_id ORDER BY b.id DESC";
$result=$con->query($sql);
$no=1;
while($row=$result->fetch_assoc())
{
  echo"
  <tr>
    <td>".$no."</td>
    <td>".$row["rno"]."</td>
    <td>".$row["date"]."</td>
    <td>".$row["vendor"]."</td>
    <td>".$row["final_amount"]."</td>
    <td> <button><a href='http://localhost/oop/bd.php?id=$row[rno]&n=3'>Delete</a></button></td>       
    <td> <button><a href='p2.php?date=$row[date]&name=$row[vendor]&rno=$row[rno]'>Edit</a></button></td>    
    </tr>
  ";
  $no++;
}

?>
</table>
</CENTER>