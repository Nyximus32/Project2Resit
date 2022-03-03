<?php
// Config file

// Define registration variables 
$username = $password = $confirm_password = "";
$password_err = $confirm_password_err = "";
$age = "";
$email= "";
$password = "";
$userType = "";
$postalCode = "";

$conn = mysqli_connect("127.0.0.1", "root", "");
            if(!$conn)
            {
                die("There was an error connecting to the database. Error: " . mysqli_connect_errno());
            }


            if(mysqli_select_db($conn, "webshop"))
			{
        if($_SERVER["REQUEST_METHOD"] == "POST"){

        
          //Select statement
          $sql = "SELECT cust_ID FROM customer WHERE `Name` = ?";
        
          if($stmt = mysqli_prepare($conn, $sql)){
            mysqli_stmt_bind_param($stmt, "s", $param_username);
        
        // Set parameters
            $param_username = trim($_POST["username"]);
              if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);
        
                if(mysqli_stmt_num_rows($stmt) == 1){
                  $username = "This username is already taken.";
                } else{
                  $username = trim($_POST["username"]);
                }
            } else{
              echo "Oops! Something went wrong. Please try again later.";
            }
            $age = trim($_POST["age"]);
            $email= trim($_POST["email"]);
            $userType = trim($_POST["userType"]);
            $postalCode = trim($_POST["postalCode"]);
        
            // Close statement
                    mysqli_stmt_close($stmt);
                }
        
          // Password
          if(empty(trim($_POST["password"]))){
            $password_err = "Please enter a password.";     
        } elseif(strlen(trim($_POST["password"])) < 6){
            $password_err = "Password must have atleast 6 characters.";
        } else{
          $password = trim($_POST["password"]);
            }
        
          //Validate password
          if(empty(trim($_POST["confirm_password"]))){
            $confirm_password_err = "Please confirm password.";     
        } else{
            $confirm_password = trim($_POST["confirm_password"]);
            if(empty($password_err) && ($password != $confirm_password)){
                $confirm_password_err = "Password did not match.";
            }
        }
        
        // Check input errors before inserting in database
        
          // Prepare an insert statement
                $sql = "INSERT INTO customer (Name, Age, Email, password, userType, postalCode) VALUES (?, ?, ?, ?, ?, ?)";
        
                if($stmt = mysqli_prepare($conn, $sql)){
                  mysqli_stmt_bind_param($stmt, "ssssss", $param_username,$age,$email,$param_password,$userType, $postalCode );
        
                  // Set parameters
                  $param_username = $username;
                    $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
                    if(mysqli_stmt_execute($stmt)){
                      // Redirect to login page
                      header("location: code/homepage.php");
                  } else{
                      echo "Oops! Something went wrong. Please try again later.";
                  }
                  // Close statement
                  mysqli_stmt_close($stmt);
              }
          
          // Close connection
          mysqli_close($conn);
        }

      }

// Process form data

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="">
    <style>
        body{ font: 14px sans-serif; }
        .wrapper{ width: 360px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Sign Up</h2>
        <p>Please fill this form to create an account.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control <?php echo (!empty($username)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                <span class="invalid-feedback"><?php echo $username; ?></span>
            </div>   
            <div class="form-group">
                <label>age</label>
                <input type="text" name="age" class="form-control <?php echo (!empty($age)) ? 'is-invalid' : ''; ?>" value="<?php echo $age; ?>">
                <span class="invalid-feedback"><?php echo $age; ?></span>
            </div>
            <div class="form-group">
                <label>email</label>
                <input type="text" name="email" class="form-control <?php echo (!empty($email)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
                <span class="invalid-feedback"><?php echo $email; ?></span>
            </div>
            <div class="form-group">
                <label>userType</label>
                <input type="text" name="userType" class="form-control <?php echo (!empty($userType)) ? 'is-invalid' : ''; ?>" value="<?php echo $userType; ?>">
                <span class="invalid-feedback"><?php echo $userType; ?></span>
            </div>
            <div class="form-group">
                <label>postalCode</label>
                <input type="text" name="postalCode" class="form-control <?php echo (!empty($postalCode)) ? 'is-invalid' : ''; ?>" value="<?php echo $postalCode; ?>">
                <span class="invalid-feedback"><?php echo $postalCode; ?></span>
            </div> 
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>">
                <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-secondary ml-2" value="Reset">
            </div>
            <p>Already have an account? <a href="login.php">Login here</a>.</p>
        </form>
    </div>    
</body>
</html>