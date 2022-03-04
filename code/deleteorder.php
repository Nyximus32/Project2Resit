<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <?php include './header.php' ?>

    <?php
        $orderID = $_GET['id'];
        $conn = mysqli_connect("127.0.0.1", "root", "",);
        if(!$conn)
        {
            die("There was an error connecting to the database. Error: " . mysqli_connect_errno());
        }

        if(mysqli_select_db($conn, "webshop"))
        {
            $sql = "DELETE FROM orders WHERE order_ID=?";
            if($stmt = mysqli_prepare($conn, $sql))
            {	
                mysqli_stmt_bind_param($stmt, "s", $orderID);
                
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