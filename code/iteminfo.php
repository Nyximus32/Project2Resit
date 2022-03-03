<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Details</title>
</head>
<body>
    <?php
    $itemID= $_GET['id'];

    $conn = mysqli_connect("127.0.0.1", "root", "",);

        if(!$conn)
        {
            die("There was an error connecting to the database. Error: " . mysqli_connect_errno());
        }

        if(mysqli_select_db($conn, "webshop"))
        {
            $sql = "SELECT title, description, price
                    FROM item
                    WHERE item_ID = ? ";

            if($stmt = mysqli_prepare($conn, $sql))
            {	
                mysqli_stmt_bind_param($stmt, "s", $itemID);

                mysqli_stmt_execute($stmt);
                mysqli_stmt_bind_result($stmt,$title,$description,$price);
                mysqli_stmt_store_result($stmt);

                if(mysqli_stmt_num_rows($stmt) != 0)
                {
                    while (mysqli_stmt_fetch($stmt)) 
                    {
                        echo"<h2>". $title."</h2>" ;
                        echo"<h3>". $description."</h3>";
                        echo"<h3>price: ". $price." euro <h3><br>" ;
                        echo "<img src='images/".$title.".jpg' ><br>";

                        echo '<form action="#" method="post">
                              <input type="submit" name="add" value="Add item to cart"/>
                              </form>';

                        if($_SERVER["REQUEST_METHOD"] == "POST"){
                            header("location: apology.php");
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