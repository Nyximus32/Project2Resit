<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add items</title>
</head>
<body>

    <h1>Add a new item</h1>
    <form action="<?= htmlentities($_SERVER['PHP_SELF']);?>" method="post" enctype="multipart/form-data" >
    Title <br>
    <input type="text" class="title" name="title"> <br><br>
    Description <br>
    <input type="text" class="description" name="description">  <br><br>
    Category <br>
    <input type="text" class="category" name="category">  <br><br>
    Price <br>
    <input type="text" class="price" name="price">  <br><br>
    Item image <br>
    <input type="file" name="uploadedFile" id="file"/>  <br><br>
    <input type="submit" value="submit" name="submit">
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == "POST") {

        //ADDING INFO TO DATABASE

        if (!empty($_POST["title"]) &&
            !empty($_POST["description"]) &&
            !empty($_POST["category"]) &&
            !empty($_POST["price"]) ) {
            
            $title= $_POST["title"];
            $description = $_POST["description"];
            $category = $_POST["category"];
            $price = $_POST["price"];

            $conn = mysqli_connect("127.0.0.1", "root", "");
            if(!$conn)
            {
                die("There was an error connecting to the database. Error: " . mysqli_connect_errno());
            }


            if(mysqli_select_db($conn, "webshop"))
			{
                $sql="  INSERT INTO item (title,description,category,price)
                        VALUES (?,?,?,?)";

                if($stmt = mysqli_prepare($conn, $sql)){
                    mysqli_stmt_bind_param($stmt,"ssss",$title, $description, $category, $price);

                    if(!mysqli_stmt_execute($stmt)){
                        echo"error smth";
                    }
                    else{

                        // UPLOADING THE IMAGE

                        if($_FILES["uploadedFile"]["size"]< 30000000){

                        $acceptedTypes = ["image/jpg"/*, "image/jpeg", "image/png"*/];
                            $fileInfo = finfo_open(FILEINFO_MIME_TYPE);
                            $FileType = finfo_file($fileInfo, $_FILES["uploadedFile"]["tmp_name"]);
                    
                            if(in_array($FileType, $acceptedTypes)){
                                if ($_FILES["uploadedFile"]["error"] > 0){
                                    echo "Error: " . $_FILES["uploadedFile"]["error"] . "<br />";
                                }
                                else{
                                    if (file_exists("upload/" . $_FILES["uploadedFile"]["name"])){
                                        echo $_FILES["uploadedFile"]["name"] . " already exists. ";
                                    }
                                    else{
                                        if(move_uploaded_file($_FILES["uploadedFile"]["tmp_name"], "images/". $_FILES["uploadedFile"]["name"])){
                                            header("location:./homepage.php");
                                        }
                                        else{
                                            echo "Something went wrong while uploading.";
                                        }
                                    }
                                }
                            }
                            else{
                                echo "Try another file type";
                            }
                        }
                        else{
                            echo"Too big";
                        }
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