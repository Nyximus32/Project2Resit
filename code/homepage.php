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
        if(isset($_SESSION["loggedin"])){
            $isAdult = $_SESSION["isAdult"];
            $userType = $_SESSION["userType"];
        }
        $userType="user";
        
        $currentDate = date('Y-m-d');

        $conn = mysqli_connect("127.0.0.1", "root", "",);

        if(!$conn)
        {
            die("There was an error connecting to the database. Error: " . mysqli_connect_errno());
        }

        if(mysqli_select_db($conn, "webshop"))
        {
            $sql = "SELECT i.item_ID,i.title,i.price,i.isAgeRestricted,d.item_ID,d.startDate,d.endDate,d.discount
                    FROM item i
                    LEFT JOIN discount d ON d.item_ID=i.item_ID";

            if($stmt = mysqli_prepare($conn, $sql))
            {	
                mysqli_stmt_execute($stmt);
                mysqli_stmt_bind_result($stmt,$id,$title,$price,$isAgeRestricted,$discID,$startDate,$endDate,$discount);
                mysqli_stmt_store_result($stmt);

                echo "<h1>All available items</h1>";

                if(mysqli_stmt_num_rows($stmt) != 0)
                {
                    while (mysqli_stmt_fetch($stmt)) 
                    {
                        if($userType=="admin"){

                            if($id==$discID && $startDate<= $currentDate && $endDate>= $currentDate){
                                echo"<h2> <a href="."iteminfo.php?id=".$id.">".$title."</a> </h2>" ;
                                echo "<img src='images/".$title.".jpg' style='width:300px;height:400px;'><br>";
                                echo"price: ". $price*$discount." euro <br><br>" ;
                            }
                            else{
                                echo"<h2> <a href="."iteminfo.php?id=".$id.">".$title."</a> </h2>" ;
                                echo "<img src='images/".$title.".jpg' style='width:300px;height:400px;'><br>";
                                echo"price: ". $price." euro <br><br>" ;
                                echo "<a href="."adddiscount.php?id=".$id.">Discount</a> <br><br>";
                            }
                        }
                        else{
                            if(!$isAgeRestricted){

                                if($id==$discID && $startDate<= $currentDate && $endDate>= $currentDate){
                                    echo"<h2> <a href="."iteminfo.php?id=".$id.">".$title."</a> </h2>" ;
                                    echo "<img src='images/".$title.".jpg' style='width:300px;height:400px;'><br>";
                                    echo"price: ". $price*$discount." euro <br><br>" ;
                                }
                                else{
                                    echo"<h2> <a href="."iteminfo.php?id=".$id.">".$title."</a> </h2>" ;
                                    echo "<img src='images/".$title.".jpg' style='width:300px;height:400px;'><br>";
                                    echo"price: ". $price." euro <br><br>" ;
                                }
                            }
                            else{
                                if($isAdult){

                                    if($id==$discID && $startDate<= $currentDate && $endDate>= $currentDate){
                                        echo"<h2> <a href="."iteminfo.php?id=".$id.">".$title."</a> </h2>" ;
                                        echo "<img src='images/".$title.".jpg' style='width:300px;height:400px;'><br>";
                                        echo"price: ". $price*$discount." euro <br><br>" ;
                                    }
                                    else{
                                        echo"<h2> <a href="."iteminfo.php?id=".$id.">".$title."</a> </h2>" ;
                                        echo "<img src='images/".$title.".jpg' style='width:300px;height:400px;'><br>";
                                        echo"price: ". $price." euro <br><br>" ;
                                    }
                                }
                                else{
                                    if($isAgeRestricted){
                                        if($id==$discID && $startDate<= $currentDate && $endDate>= $currentDate){
                                            echo"<h2> <a href="."iteminfo.php?id=".$id.">".$title."</a> </h2>" ;
                                            echo "<img src='images/".$title.".jpg' style='width:300px;height:400px;'><br>";
                                            echo"price: ". $price*$discount." euro <br><br>" ;
                                        }
                                        else{
                                            echo"<h2> <a href="."iteminfo.php?id=".$id.">".$title."</a> </h2>" ;
                                            echo "<img src='images/".$title.".jpg' style='width:300px;height:400px;'><br>";
                                            echo"price: ". $price." euro <br><br>" ;
                                        }
                                    }
                                }
                            }
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
