<header>
        <div class="container-fluid">
            <div class="header-content">

                <!-- side place of header -->
                <div class="side-head">
                <span class="text-white">NHL WEBSHOP</span> &nbsp;
                    <i class="fas fa-bars menu-btn text-white"></i>
                    <i class="fas fa-arrow-right text-white close-btn"></i>
                </div>
                <!-- header navigation -->
                <div class="header-nav">
                    <ul>
                        <li><a href="homepage.php"><i class="fa-solid fa-basket-shopping"></i> Homepage </a> </li>
                        <li><a href="orderhistory.php"><i class="fa-solid fa-shop"></i> Order History </a> </li>
                        <?php
                        session_start();
                        $_SESSION["userType"]="admin";
                        if($_SESSION["userType"]=="admin"){
                            echo'<li><a href="additems.php"><i class="fa-solid fa-user"></i>Add a new item</a> </li>';
                        }
                        if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
                        echo'<li><a href="logout.php"><i class="fa-solid fa-arrow-right-from-bracket"></i>Log out</a> </li>';
                        }
                        else{
                         echo'<li><a href="register.php"><i class="fa-solid fa-arrow-right-from-bracket"></i>Register</a> </li>';
                        }
                        ?>
                        
                    </ul>
                </div>
            </div>
        </div>

    </header>