<head>
    <title>Item Manage</title>
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
$item=$_GET["item"];
$price=$_GET["price"];
?>
<link rel="stylesheet" href="main.css" type="text/css">
<center>
        <h3>Item Manage</h3>
        <form method='POST' onsubmit='return validate();'>
            <table id="customers">
                <tr>
                    <td>Item Name</td>
                    <td><input type='text' name='item' autocomplete='off' value='<?php echo$item;?>' required/></td>
                </tr>
                <tr>
                    <td>Item Price</td>
                    <td><input type='number' id='size' autocomplete='off' name='price' value='<?php echo$price;?>' required/></td>
                </tr>
                <tr>
                    <td><button style='width:100%' type='submit' name='back'>BACK</button></td>
                    <td><button style='width:100%' type='submit' name='ok'>EDIT</button></td>
                </tr>
            </table>
        </form>
        </center>

        <script>
function validate() 
{
    var value = document.getElementById('size').value;

    if (value.length <= 6 && value.length > 0) 
    {
        return true;
    }
    else
    {
        alert('Amount size is invalid');
        return false;
    }
}
</script>
<?php
if(isset($_POST['back']))
{
    header("location: item.php");
}
if(isset($_POST['ok']))
{
    $ins = new bd();
    echo $ins->edit_item($id,$_POST['item'],$_POST['price']);//edit id data
    header("location: item.php");
}
?>