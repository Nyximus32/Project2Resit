<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order History</title>
</head>
<body>
    <?php
        session_start();
        $currentID=$_SESSION["id"];
        $userType=$_SESSION["userType"];
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

                echo "<h1>MY order history</h1>";

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