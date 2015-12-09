<?php
    session_start();
    if($_SESSION['validlogin'] != true)
    {
        exit();
    }
    
    $dbserver = "localhost";
    $database = "catinventory";
    $dbuser = "dbuser";
    $dbpass = "pass";
    $error_msg = "Error: user and pass combination not found";

    $dbconn = mysqli_connect($dbserver,$dbuser,$dbpass,$database);
    if(mysqli_connect_error($dbconn))
    {
        echo "Error connecting to database";
        //exit();
    }
    
    //$itemid;
    if(isset($_POST['itemid']))
    {
        $itemid = $_POST['itemid'];
    }
    if(isset($_POST['qty_ordered']))
    {
        $qty_ordered = $_POST['qty_ordered'];
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Order Page</title>
    </head>
    <body>
        <h1>Order Page</h1>
        <form method="POST">
            Item ID:
            <select name="itemid">
                <option value="">- Select an itemid -</option>
                <?php
                $querystr = "select itemid from catsupplies;";
                $res = mysqli_query($dbconn, $querystr);
                while ($row = mysqli_fetch_array($res))
                {
                        echo "<option value=".$row["itemid"].">".$row["itemid"]."</option>";
                }
                ?>
            </select>
            <input type="submit" />
            <br>
            <br>
        </form>
        
        <?php
            if(isset($itemid))
            {
                if($itemid != '')
                {
                    $querystr2 = "select * from catsupplies where itemid='".$itemid."';";
                    $res = mysqli_query($dbconn, $querystr2);
                    while ($row = mysqli_fetch_array($res))
                    {
                        echo "Item ID:".$row["itemid"]."<br>";
                        echo "Item Name:".$row["itemname"]."<br>";
                        echo "Item Price:$".$row["itemprice"]."<br>";
                        echo "Item Qty:".$row["itemqty"]."<br>";
                        echo "Item Weight:".$row["itemweight"]."<br>";
                    }
                    echo "<form action='orderconfirmation.php' method='POST' ><input type=text name='qty_ordered' /><input type='submit' value='Order'/></form>";
                }
            }
            
            if(isset($qty_ordered))
            {
                echo $qty_ordered." added.";
            }
        ?>
        
    </body>
</html>
