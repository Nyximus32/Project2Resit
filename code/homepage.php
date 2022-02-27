<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Webshop</title>
    </head>
    <body>

    <?php
        $currentDate = date('Y-m-d');
        echo $currentDate."<br><br>";

        $conn = mysqli_connect("127.0.0.1", "root", "",);

        if(!$conn)
        {
            die("There was an error connecting to the database. Error: " . mysqli_connect_errno());
        }

        if(mysqli_select_db($conn, "webshop"))
        {
            $sql = "SELECT i.item_ID,i.title,i.price,d.item_ID,d.startDate,d.endDate,d.discount FROM item i,discount d ";

            if($stmt = mysqli_prepare($conn, $sql))
            {	
                mysqli_stmt_execute($stmt);
                mysqli_stmt_bind_result($stmt,$id,$title,$price,$discID,$startDate,$endDate,$discount);
                mysqli_stmt_store_result($stmt);

                echo "<h1>Items...</h1>";

                if(mysqli_stmt_num_rows($stmt) != 0)
                {
                    while (mysqli_stmt_fetch($stmt)) 
                    {
                        if($id==$discID && $startDate<= $currentDate && $endDate>= $currentDate){
                        echo"id = ". $id."<br>" ;
                        echo"price = ". $price*$discount." euro <br>" ;
                        echo "<img src='images/".$title.".jpg' ><br>";
                        echo "<a href="."adddiscount.php?id=".$id.">Discount</a> <br><br>";
                        }
                        else{
                        echo"id = ". $id."<br>" ;
                        echo"price = ". $price." euro <br>" ;
                        echo "<img src='images/".$title.".jpg' ><br>"; 
                        echo "<a href="."adddiscount.php?id=".$id.">Discount</a> <br><br>";
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
