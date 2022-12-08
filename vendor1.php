<head>
    <title>Vendor Manage</title>
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

$id=$_GET["id"];
$add=$_GET["address"];
$ph=$_GET["contact"];
$name=$_GET["vendor"];
?>
<link rel="stylesheet" href="main.css" type="text/css">

<center>
        <h3>Vendor Manage</h3>
        <form method='POST' onsubmit='return validate();'>
            <table id="customers">
                <tr>
                <td>Vendor Name</td>
                <td><input type='text' value='<?php echo$name?>' name='ven' required/></td>
                </tr>
                <tr>
                    <td>Vendor Contact</td>
                    <td><input type='number' minlength='10'  id='size' autocomplete='off' value='<?php echo$ph?>' name='ph'/></td>
                </tr>
                <tr>
                    <td>Vendor Address</td>
                    <td><input type='text' value='<?php echo$add?>' name='add'/></td>
                </tr>
                
                <tr>
                    <td><button style='width:100%' type='submit' name='back'>BACK</button></td>
                    <td><button style='width:100%' type='submit' name='ok'>EDIT VENDOR</button></td>
                </tr>
            </table>
        </form>
        </center>

        <script>
function validate() 
{
    var value = document.getElementById('size').value;

    if (value.length ==10) 
    {
        return true;
    }
    else
    {
        alert('Contact size is invalid');
        return false;
    }
}
</script>

<?php
    if(isset($_POST['back']))
    {
        header("location: vendor.php");
    }
    if(isset($_POST['ok']))
    {
        $ins = new bd();
        echo $ins->edit_vendor($id,$_POST['ven'],$_POST['ph'],$_POST['add']);//edit id data
        header("location: vendor.php");
    }
?>