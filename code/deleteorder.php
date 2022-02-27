<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $orderID = $_GET['id'];
        if(!$conn)
        {
            die("There was an error connecting to the database. Error: " . mysqli_connect_errno());
        }

        if(mysqli_select_db($conn, "webshop"))
        {
            $sql = "DELETE FROM orders WHERE order_ID=?";
            mysqli_stmt_bind_param($stmt, "s", $orderID);
            if($stmt = mysqli_prepare($conn, $sql))
            {	
                if(!mysqli_stmt_execute($stmt)){
                    echo"error smth";                
                }
                else{
                    header("location:./orderhistory.php");
                    }
            }else{
                echo"Problems detected";
            }		
        }else{
            die(mysqli_error($conn));
        }
        mysqli_close($conn);
    ?>
</body>
</html>