<?php
    session_start();
            //user login info table name is "logintab"
            if(isset($_POST['id']) and isset($_POST['pw']))
            {
                $id = $_POST['id'];
                $pw = $_POST['pw'];
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

            if(isset($id))
            {
                $querystr = "select loginid, password from logintab where loginid = '$id'";
                $res = mysqli_query($dbconn, $querystr);
                $numrows = mysqli_num_rows($res);
                $res_arr = mysqli_fetch_assoc($res);
                if($numrows > 0)
                {
                    if($res_arr["password"] == $pw)
                    {
                        echo "congratulations";
                        $_SESSION['validlogin']=true;
                        header("Location: orderpage.php");
                    }
                    else
                    {
                        echo $error_msg;
                        //exit();
                    }
                }
                else
                {
                    echo $error_msg;
                }
            }
            
        ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Login Page</title>
    </head>
    <body>
        <h1>Login</h1>
        <form method="POST">
            Login ID: <input type="text" name="id" />
            <br>
            Password: <input type="text" name="pw" />
            <br>
            <input type="submit" />
        </form>
        
    </body>
</html>
