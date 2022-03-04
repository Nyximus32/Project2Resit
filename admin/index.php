<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- CSS files -->
    <link rel="stylesheet" href="css/svg-with-js.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/admin_panel.css">
</head>
<body>
    <!-- header section -->
    <header>
        <div class="container-fluid">
            <div class="header-content">

                <!-- side place of header -->
                <div class="side-head">
                    <span class="text-white">Admin panel</span> &nbsp;
                    <i class="fas fa-bars menu-btn text-white"></i>
                    <i class="fas fa-arrow-right text-white close-btn"></i>
                </div>
                <!-- header navigation -->
                <div class="header-nav">
                    <ul>
                        <li><a href="#"><i class="fa-solid fa-basket-shopping"></i> Order </a> </li>
                        <li><a href="#"><i class="fa-solid fa-shop"></i> delivery </a> </li>
                        <li><a href="#"><i class="fa-solid fa-user"></i> User </a> </li>
                        <li><a href="#"><i class="fa-solid fa-arrow-right-from-bracket"></i> Logout </a> </li>
                    </ul>
                </div>
            </div>
        </div>

    </header>
    
    <div class="wrapper">
        <!-- this is sidebar -->
        <section class="sidebar"> 
            <ul class="nav-bar">
                <li><a href="#"><i class="fas fa-tachometer-alt"></i> <span class="text-link"> Dashboard</span></a></li>
                <li><a href="#"><i class="fas fa-dolly-flatbed"></i> <span class="text-link">Brand</span></a></li>
                <li><a href="#"><i class="fas fa-dolly"></i><span class="text-link"> Category</span></a></li>
                <li><a href="#"><i class="fas fa-images"></i><span class="text-link"> Slider Images</span></a></li>
                <li><a href="#"><i class="fas fa-shopping-basket"></i><span class="text-link"> Products</span></a></li>
                <li><a href="#"><i class="fas fa-truck"></i><span class="text-link"> Orders</span></a></li>
                <li><a href="#"><i class="fas fa-truck-loading"></i><span class="text-link"> Delivery</span></a></li>
                <li><a href="#"><i class="fas fa-cogs"></i><span class="text-link"> settings</span></a></li>
                <li><a href="#"><i class="fas fa-id-badge"></i><span class="text-link"> Profile</span></a></li>
                <li><a href="#"><i class="fas fa-sign-out-alt"></i><span class="text-link"> Logout</span></a></li>
            </ul>
        </section>
        <!-- this is our working panel -->
        <section class="working-panel"> 
            <div class="container-fluid">
                <h1 class="display-4">Welcome to Dashboard</h1>
                <hr>

                <div class="row">
                    <!-- category widget -->
                    <div class="col-md-3">
                        <div class="card bg-orange-g text-white">
                            <div class="card-body">
                                <h4 class="font-weight-light"><i class="fas fa-dolly"></i>All Category</h4>
                                <hr>
                                <h5>
                                    <b>1234</b>
                                </h5>
                            </div>
                        </div>
                    </div>
                    <!-- all brands -->
                    <div class="col-md-3">
                        <div class="card bg-success text-white">
                            <div class="card-body">
                                <h4 class="font-weight-light"><i class="fas fa-dolly-flatbed"></i>All Brands</h4>
                                <hr>
                                <h5>
                                    <b>1234</b>
                                </h5>
                            </div>
                        </div>
                    </div>

                    <!-- all users -->
                    <div class="col-md-3">
                        <div class="card bg-primary text-white">
                            <div class="card-body">
                                <h4 class="font-weight-light"><i class="fas fa-users"></i>All Users</h4>
                                <hr>
                                <h5>
                                    <b>1234</b>
                                </h5>
                            </div>
                        </div>
                    </div>
                    <!-- all orders -->
                    <div class="col-md-3">
                        <div class="card bg-info text-white">
                            <div class="card-body">
                                <h4 class="font-weight-light"><i class="fas fa-truck-loading"></i>All Orders</h4>
                                <hr>
                                <h5>
                                    <b>1234</b>
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- All order table -->
                <div class="all-order mt-5">
                    <h2>New Orders</h2> <hr>
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr class="bg-primary text-white">
                                <th scope="col">Order No.</th>
                                <th scope="col">Product Name</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Date</th>
                                <th scope="col">Paid Status</th>
                                <th scope="col">Order Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                            <th scope="row">1</th>
                            <td>Mark</td>
                            <td>10</td>
                            <td>01.03.2022</td>
                            <td><span class="badge bg-danger">Unpaid</span></td>
                            <td><span class="badge bg-success">Complete</span></td>
                            </tr>
                            <tr>
                            <th scope="row">2</th>
                            <td>Jacob</td>
                            <td>5</td>
                            <td>01.03.2022</td>
                            <td><span class="badge bg-success">Paid</span></td>
                            <td><span class="badge bg-info">Process</span></td>
                            </tr>
                            <tr>
                            <th scope="row">3</th>
                            <td>Larry the Bird</td>
                            <td>2</td>
                            <td>01.03.2022</td>
                            <td><span class="badge bg-success">Paid</span></td>
                            <td><span class="badge bg-danger">Rejected</span></td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="order-pagination">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination">
                                <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                                <li class="page-item"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item"><a class="page-link" href="#">Next</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </section>
    </div>


    <!-- this is for js files -->
    <script src="js/jquery.js"></script>
    <script src="js/all.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>

</body>
</html>