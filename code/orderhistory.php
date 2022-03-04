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
    <?php

        if(!isset($_SESSION["loggedin"])){
            header("location: homepage.php");
        }
        else{
            $currentID=$_SESSION["id"];
            $userType=$_SESSION["userType"];
        }
        
        
        $conn = mysqli_connect("127.0.0.1", "root", "",);

        if(!$conn)
        {
            die("There was an error connecting to the database. Error: " . mysqli_connect_errno());
        }

        if(mysqli_select_db($conn, "webshop"))
        {
            $query =   "SELECT o.cust_ID, o.order_ID, i.title, i.price, o.quantity, o.status
                        FROM orders o
                        JOIN item i ON i.item_ID=o.item_ID";

            if($stmt = mysqli_prepare($conn, $query))
            {	
                mysqli_stmt_execute($stmt);
                mysqli_stmt_bind_result($stmt,$custID,$orderID,$title,$price,$quantity,$status);
                mysqli_stmt_store_result($stmt);

                echo "<h1>My order history</h1>";

                if(mysqli_stmt_num_rows($stmt) != 0)
                {
                    while (mysqli_stmt_fetch($stmt)) 
                    {
                        if($currentID==$custID && $userType=="user"){
                            echo"title = ". $title."<br>" ;
                            echo"price = ". $price." euro <br>" ;
                            echo"quantity = ". $quantity."<br>" ;
                            echo"status = ". $status."<br>" ;
                            echo "<a href="."deleteorder.php?id=".$orderID.">Cancel your order</a> <br><br>";
                        }
                        else if($userType=="admin"){
                            echo"title = ". $title."<br>" ;
                            echo"price = ". $price." euro <br>" ;
                            echo"quantity = ". $quantity."<br>" ;
                            echo"status = ". $status."<br>" ;
                            echo "<a href="."editorder.php?id=".$orderID.">Edit/Delete order</a> <br><br>";
                        }
                        else{
                            echo"<br><h3>You don't have any orders currently<h3>";
                        }
                    }
                }else{
                    echo "Nothing to show";
                }
                mysqli_stmt_close($stmt);
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