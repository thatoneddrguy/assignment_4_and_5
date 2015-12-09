<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Assignment 4 & 5</title>
    </head>
    <body>
        <?php
            //user login info table name is "logintab"
            if(isset($_POST['id']))
            {
                $id = $_POST['id'];
                $pw = $_POST['pw'];
            }
            
        ?>
        
        <form method="POST">
            Login ID: <input type="text" name="id" />
            Password: <input type="text" name="pw" />
        </form>
        
    </body>
</html>
