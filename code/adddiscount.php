!DOCTYPE html>
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

<h1>Add a discount</h1>
    <form action="#" method="post">
    Start date <br>
    <input type="date" class="startDate" name="startDate"> <br><br>
    End date <br>
    <input type="date" class="endDate" name="endDate">  <br><br>
    Discount <br>
    <input type="text" class="discount" name="discount">  <br><br>
    
    <input type="submit" value="submit" name="submit">
    </form>

    <?php

    if ($_SERVER['REQUEST_METHOD'] == "POST") {

        if (!empty($_POST["startDate"]) &&
            !empty($_POST["endDate"]) &&
            !empty($_POST["discount"]) ) {
            
            $id = $_GET['id'];
            $startDate= $_POST["startDate"];
            $endDate = $_POST["endDate"];
            $discount = $_POST["discount"];

            $conn = mysqli_connect("127.0.0.1", "root", "");
            if(!$conn)
            {
                die("There was an error connecting to the database. Error: " . mysqli_connect_errno());
            }


            if(mysqli_select_db($conn, "webshop"))
			{
                $sql="  INSERT INTO `discount` (item_ID,startDate,endDate,discount)
                        VALUES (?,?,?,?)";

                if($stmt = mysqli_prepare($conn, $sql)){
                    mysqli_stmt_bind_param($stmt,"ssss",$id, $startDate, $endDate, $discount);
                    if(!mysqli_stmt_execute($stmt)){
                        echo"error smth";
                    }
                    else{
                        header("location:./homepage.php");
                    }
                }
                else{
                    echo"error connecting";
                }
            }
            else{
                echo "big error";
            }
        }
        else {
            echo"Fill everything";
        }
    }
    ?>


</body>
</html>