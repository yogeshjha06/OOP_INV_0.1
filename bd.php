<?php
$id=$_GET['id'];
$n=$_GET['n'];
if($n==1)//del fun call item
{
    $ins = new bd();
    echo $ins->del_item($id);//del id data
}
if($n==2)//del fun call vendor
{
    $ins = new bd();
    echo $ins->del_vendor($id);//del id data
}
if($n==3)//del fun call purchase
{
    $ins = new bd();
    echo $ins->del_pur($id);//del id data
}
if($n==4)//del fun call sale
{
    $ins = new bd();
    echo $ins->dle_sale($id);//del id data
}

class bd
{
    //item insert function
    function ins_item($item,$price)
    {
        $con=mysqli_connect("localhost","root","","cinv");//connection
        $sql = "INSERT INTO `item`(`item`, `price`) VALUES ('$item','$price')";
        $q=mysqli_query($con,$sql);
        if($q)
        {
            echo"
                        <script>
                            alert('Item Is Added To Our Database.');
                        </script>";
        }
        else
        {
            echo"
                        <script>
                            alert('Data Already Present In Our Database.');
                        </script>";
        }
    }
    //item delete function
    public function del_item($id) 
    {
            $con=mysqli_connect("localhost","root","","cinv");//connection
            $sql = "DELETE FROM `item` WHERE id=$id";
            $result=$con->query($sql);
            if($result)
            echo"
                            <script>
                                alert('Item Is Deleted From Our Database.');
                            </script>";
            header("location: item.php");
    }
    ///item edit function
    function edit_item($id,$item,$price) 
    {
        if(isset($_POST['ok']))//edit button response
        {
            $con=mysqli_connect("localhost","root","","cinv");//connection
            $sql = "UPDATE `item` SET `item`='$_POST[item]',`price`='$_POST[price]' WHERE id=$id";
            $result=$con->query($sql);
            if($result)
            {
                echo"
                                <script>
                                    alert('Item Is Updated From Our Database.');
                                </script>";
            }
            else
            {
                echo"
                        <script>
                            alert('Data Already Present In Our Database.');
                        </script>";
            }
            header("location: item.php");
        }
        if(isset($_POST['back']))//back from edit page
        {
            header("location: item.php");
        }
    }
    //vendor insert method
    function vendor_ins($ven,$ph,$add) 
    {
        $con=mysqli_connect("localhost","root","","cinv");//connection
        $sql = "INSERT INTO `vendor`(`vendor`, `contact`, `address`) VALUES ('$ven','$ph','$add')";
        $q=mysqli_query($con,$sql);
        if($q)
        {
            echo"
                        <script>
                            alert('Vendor Is Added To Our Database.');
                        </script>";
        }
        else
            {
                echo"
                        <script>
                            alert('Data Already Present In Our Database.');
                        </script>";
            }
    }
    //edit vendor method
    function edit_vendor($id,$name,$ph,$add) 
    {
        if(isset($_POST['ok']))//edit button response
        {
            $con=mysqli_connect("localhost","root","","cinv");//connection
            $sql = "UPDATE `vendor` SET `vendor`='$name',`contact`='$ph',`address`='$add' WHERE id=$id";
            $result=$con->query($sql);
            if($result)
            {
                echo"
                                <script>
                                    alert('Vendor Is Updated From Our Database.');
                                </script>";
            }
            else
            {
                echo"
                        <script>
                            alert('Data Already Present In Our Database.');
                        </script>";
            }
            header("location: vendor.php");
        }
        if(isset($_POST['back']))//back from edit page
        {
            header("location: vendor.php");
        }
    }
    // delete vendor method
    function del_vendor($id) 
    {
        $con=mysqli_connect("localhost","root","","cinv");//connection
        $sql = "DELETE FROM `vendor` WHERE id=$id";
        $result=$con->query($sql);
        if($result)
        echo"
                        <script>
                            alert('Vendor Is Deleted From Our Database.');
                        </script>";
        header("location: vendor.php");
    }
    //purchase master insert method
    function pm_ins($ven,$ph,$add) 
    {
        $con=mysqli_connect("localhost","root","","cinv");//connection
        $sql="INSERT INTO `purchase_master`(`rno`, `date`, `vendor_id`) VALUES ('$_POST[rno]','$_POST[rdate]','$_POST[client]')";//query
        $result2=mysqli_query($con,$sql);//result  
        if($result2)
        {
            
        }   
        else
            {
                echo"
                        <script>
                            alert('Data Already Present In Our Database.');
                        </script>";
            }       
    }
    //purchase detail insert method
    function pd_ins($rno,$item,$qun)
    {
            $con=mysqli_connect("localhost","root","","cinv");//connection
            $sql = "SELECT * FROM `item` WHERE `id`=$item";
            $result = mysqli_query($con,$sql);
            $row = mysqli_fetch_array($result);
            $price = $row[3];//

            $amt=$price*$qun;

            $sql="INSERT INTO `purchase_data`(`master_id`, `item_id`, `item_price`, `item_qun`, `item_amt`) VALUES ('$rno','$item','$price','$qun','$amt')";
            $result = mysqli_query($con,$sql);

            if($result)
            {
                ////////update quantity on item table/////////////////
                $sql = "SELECT  SUM(item_qun) from `purchase_data` where `item_id`=$item";
                $result = $con->query($sql);
                $f=0;
                //display data on web page
                while($row = mysqli_fetch_array($result))
                {
                    $f=$f+$row['SUM(item_qun)'];
                }
                
                $sql="UPDATE `item` SET `qun`='$f',`status`='1' WHERE id=$item";
                $result = mysqli_query($con,$sql);




                
                ///////update final amount in purchase master/////////
                $sql = "SELECT  SUM(item_amt) from `purchase_data` where `master_id`=$rno";
                $result = $con->query($sql);
                $f=0;
                echo"<center>";
                //display data on web page
                while($row = mysqli_fetch_array($result))
                {
                    echo " Total cost: ". $row['SUM(item_amt)'];
                    echo "<br>";
                    $f=$f+$row['SUM(item_amt)'];
                }
                echo"</center>";
                $sql="UPDATE `purchase_master` SET `final_amount`='$f' WHERE rno=$rno";
                $result = mysqli_query($con,$sql);

                echo"
                            <script>
                                alert('Purchase done.');
                            </script>";
            }
            else
            {
                echo"
                        <script>
                            alert('Data Already Present In Our Database.');
                        </script>";
            }
    }
    //delete function for purchase
    function del_pur($id) 
    {
        $con=mysqli_connect("localhost","root","","cinv");//connection
        $sql1 = "DELETE FROM `purchase_master` WHERE rno=$id";
        $q=mysqli_query($con,$sql1);
        $sql = "DELETE FROM `purchase_data` WHERE master_id=$id";
        $q=mysqli_query($con,$sql);
        if($q)
        {
            header("location: purchase.php");
        }
    }
    //edit function for purchase
    function edit_pur($id,$ph,$add,$date) 
    {
            $con=mysqli_connect("localhost","root","","cinv");//connection
            $sql1 = "UPDATE `vendor` SET `contact`='$ph',`address`='$add' WHERE id='$id'";
            $q=mysqli_query($con,$sql1);
            $sql1 = "UPDATE `purchase_master` SET `date`='$date' WHERE `vendor_id`='$id'";
            $q=mysqli_query($con,$sql1);
    }
    //sale master insert method
    function sale_ins($rno,$date,$client,$ph,$add) 
    {
        $con=mysqli_connect("localhost","root","","cinv");//connection
        $sql="INSERT INTO `sale_master`(`rno`, `date`, `client`, `ph`, `add`) VALUES ('$rno','$date','$client','$ph','$add')";//query
        $result2=mysqli_query($con,$sql);//result
        if($result2)
        {

        }
        else
            {
                echo"
                        <script>
                            alert('Data Already Present In Our Database.');
                        </script>";
            }
    }
    //sale detail function
    function sd_ins($rno,$id,$price,$qun) 
    {
        $con=mysqli_connect("localhost","root","","cinv");//connection

        /////////qun check///////////////////////////////////
        $sql="SELECT * FROM `item` WHERE id='$id'";
        $result = mysqli_query($con,$sql);
        $row = mysqli_fetch_array($result);
        $q13 = $row[2];//qun in stock

        if($q13>=$qun)//only if qun is avilable
        {                
                $amt=$price*$qun;

                $sql="INSERT INTO `sale_data`(`sale_id`, `item_id`, `item_price`, `item_qun`, `item_amt`) VALUES ('$rno','$id','$price','$qun','$amt')";
                $result = mysqli_query($con,$sql);
                if($result)
                {


                        $x=$q13-$qun;
                        $sql="UPDATE `item` SET `qun`='$x' WHERE id=$id";
                        $result = mysqli_query($con,$sql);    
                        
                        

                        ///////update final amount in purchase master/////////
                        $sql = "SELECT  SUM(item_amt) from `sale_data` where `sale_id`=$rno";
                        $result = $con->query($sql);
                        $f=0;
                        //display data on web page
                        echo"<center>";
                        while($row = mysqli_fetch_array($result))
                        {
                            echo " Total cost: ". $row['SUM(item_amt)'];
                            echo "<br>";
                            $f=$f+$row['SUM(item_amt)'];
                        }
                        echo"</center>";
                        $sql="UPDATE `sale_master` SET `amount`='$f' WHERE rno=$rno";
                        $result = mysqli_query($con,$sql);
                }
                else
                {
                    echo"
                            <script>
                                alert('Data Already Present In Our Database.');
                            </script>";
                }
        }
        else
        {
            echo"<script>
            alert('OUT OF STOCK');
            </script>";
        }
    }
    //delete sale function
    function dle_sale($id) 
    {
        $con=mysqli_connect("localhost","root","","cinv");//connection
        $sql1 = "DELETE FROM `sale_master` WHERE rno=$id";
        $q=mysqli_query($con,$sql1);
        $sql = "DELETE FROM `sale_data` WHERE sale_id=$id";
        $q=mysqli_query($con,$sql);
        if($q)
        {
            header("location: sale.php");
        }
    }
    function edit_sale($id,$date,$name,$ph,$add) 
    {
        $con=mysqli_connect("localhost","root","","cinv");//connection
        $sql1 = "UPDATE `sale_master` SET `date`='$date',`client`='$name',`ph`='$ph',`add`='$add' WHERE rno='$id'";
        $q=mysqli_query($con,$sql1);
    }
}
?>