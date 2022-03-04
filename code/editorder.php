<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Webshop</title>
        <link rel="stylesheet" href="admin/css/svg-with-js.css">
        <link rel="stylesheet" href="admin/css/bootstrap.min.css">
        <link rel="stylesheet" href="admin/css/admin_panel.css">
    </head>
    <body>

    <?php include './header.php' ?>
    

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
                Current Status: '.$status.'
                <br><br>
                Change status to: <br>
                <select name="change">
                <option value="nothing"></option>
                <option value="preparing">Preparing</option>
                <option value="shipping">Shipping</option>
                <option value="delivered">Delivered</option>
                </select><br><br>
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