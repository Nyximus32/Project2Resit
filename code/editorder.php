<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Order</title>
</head>
<body>
    

    <h1>You are currently editing order No:<?php $orderID= $_GET['id'];
                                                echo $orderID ?>
    </h1>

    <?php
    
    $conn = mysqli_connect("127.0.0.1", "root", "",);

    if(!$conn)
    {
        die("There was an error connecting to the database. Error: " . mysqli_connect_errno());
    }

    if(mysqli_select_db($conn, "webshop"))
    {

        $sql = "SELECT status FROM orders WHERE order_ID=? ";

        if($stmt = mysqli_prepare($conn, $sql))
        {	
            mysqli_stmt_bind_param($stmt,"s",$orderID);

            mysqli_stmt_execute($stmt);
            mysqli_stmt_bind_result($stmt,$status);
            mysqli_stmt_store_result($stmt);

            while (mysqli_stmt_fetch($stmt)) 
            {
                echo'
                <form action="#" method="post">
                Current Status <br>
                <input type="text" name="preChange" value='.$status.'>  <br><br>
                Change status to: <br>
                <input type="text" class="change" name="change"> <br>
                <input type="submit" name="edit" value="Edit Status"/> <br><br>
                <input type="submit" name="delete" value="Delete Order"/>
                </form>';
            }
        }else{
            echo"Problems detected";
        }		
    }else{
        die(mysqli_error($conn));
    }

    if(isset($_POST['edit'])) {
        if (!empty($_POST["change"])){
            $newStatus= $_POST["change"];
            
            if(mysqli_select_db($conn, "webshop"))
			{
                $sql="  UPDATE orders
                        SET status='$newStatus'
                        WHERE order_ID=$orderID;
                     ";

                if($stmt = mysqli_prepare($conn, $sql)){

                    //mysqli_stmt_bind_param($stmt,"ss",$newStatus,$orderID);       Doesn't work for some reason
                    
                    if(!mysqli_stmt_execute($stmt)){
                        echo"error smth";
                    }
                    else{
                        header('location: ./orderhistory.php');
                    }
                }
                else{
                    echo"error connecting";
                    echo $newStatus;
                }
            }
            else{
                echo "big error";
            }
        }
    }
    if(isset($_POST['delete'])) {
        header('location: ./deleteorder.php?id='.$orderID.'');
    }


    ?>
</body>
</html>