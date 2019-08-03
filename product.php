<?php
    // Define the database
	include('connect-db.php');
    //The query with assigning it with the connection to a variable
	$query = "SELECT * 
			  FROM `product_list`";
	$result = mysqli_query($conn, $query);
	$products = Array();
    while($row = mysqli_fetch_assoc($result)){
		$products[$row["product_id"]] = array(
			"name" => $row["product_name"],
			"oPrice" => $row["original_price"],
			"sPrice" => $row["sale_price"]
		);
	}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png" />
    <link rel="icon" type="image/png" href="../assets/img/favicon.png" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Product List | Geek Store</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
    <!-- Bootstrap core CSS     -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    <!--  Material Dashboard CSS    -->
    <link href="assets/css/material-dashboard.css?v=1.2.0" rel="stylesheet" />
    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="assets/css/demo.css" rel="stylesheet" />
    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300|Material+Icons' rel='stylesheet' type='text/css'>
</head>

<body>
    <div class="wrapper">
        <div class="sidebar" data-color="blue" data-image="assets/img/sidebar-1.jpg">
            <div class="logo">
                <a href="#" class="simple-text">
                    Geek Store
                </a>
            </div>
            <div class="sidebar-wrapper">
                <ul class="nav">
                    <li>
                        <a href="dashboard.php">
                            <i class="material-icons">dashboard</i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li>
                        <a href="sale.php">
                            <i class="material-icons">add_shopping_cart</i>
                            <p>Add Sale</p>
                        </a>
                    </li>
                    <li>
                        <a href="user.php">
                            <i class="material-icons">person</i>
                            <p>Register Customer</p>
                        </a>
                    </li>
                    <li class="active">
                        <a href="product.php">
                            <i class="material-icons">content_paste</i>
                            <p>Product List</p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-panel">
            <nav class="navbar navbar-transparent navbar-absolute">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="#"> Product List </a>
                    </div>
                </div>
            </nav>
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header" data-background-color="red">
                                    <h4 class="title">Product List</h4>
                                    <p class="category">List of all products</p>
                                </div>
                                <div class="card-content table-responsive">
                                    <table class="table">
                                        <thead class="text-danger">
                                            <th>Product ID</th>
                                            <th>Product Name</th>
                                            <th>Original Price</th>
                                            <th>Sale Price</th>
                                            <th>Controls</th>
                                        </thead>
                                        <tbody>
                                        <?php foreach($products as $k => $v) { ?>
                                            <tr>
                                                <td>P-<?php echo $k; ?></td>
                                                <td><?php echo $v["name"];?> </td>
                                                <td>SAR   <?php echo $v["oPrice"];?></td>
                                                <td>SAR   <?php echo $v["sPrice"];?></td>
                                                <td><a href="add_sale.php?id=<?php echo $k; ?>">Add / Update Sale</a></td>
                                            </tr>
                                        <?php } ?>
                                          <!--<tr>
                                                <td>P-105</td>
                                                <td>Executive Knight Pen Holder</td>
                                                <td>SAR 500</td>
                                                <td>SAR 300</td>
                                                <td><a href="add_sale.html">Add / Update Sale</a></td>
                                            </tr>
                                            <tr>
                                                <td>P-110</td>
                                                <td>Tiny Arcade Mr. Pacman</td>
                                                <td>SAR 100</td>
                                                <td>SAR 90</td>
                                                <td><a href="add_sale.html">Add / Update Sale</a></td>
                                            </tr>
                                            <tr>
                                                <td>P-130</td>
                                                <td>Back to the Future 2 E-Vehicle</td>
                                                <td>SAR 250</td>
                                                <td>SAR 190</td>
                                                <td><a href="add_sale.html">Add / Update Sale</a></td>
                                            </tr>
                                            <tr>
                                                <td>P-230</td>
                                                <td>Nintendo GameBoy LCD Watch</td>
                                                <td>SAR 100</td>
                                                <td>SAR 100</td>
                                                <td><a href="add_sale.html">Add / Update Sale</a></td>
                                            </tr>-->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="footer">
                <div class="container-fluid">
                    <p class="copyright pull-right">
                        &copy;
                        <script>
                            document.write(new Date().getFullYear())
                        </script>
                        CCSIT Web-based Systems Project First Semester 2017-18
                    </p>
                </div>
            </footer>
        </div>
    </div>
</body>
<!--   Core JS Files   -->
<script src="assets/js/jquery-3.2.1.min.js" type="text/javascript"></script>
<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>
<script src="assets/js/material.min.js" type="text/javascript"></script>
<!--  Charts Plugin -->
<script src="assets/js/chartist.min.js"></script>
<!--  Dynamic Elements plugin -->
<script src="assets/js/arrive.min.js"></script>
<!--  PerfectScrollbar Library -->
<script src="assets/js/perfect-scrollbar.jquery.min.js"></script>
<!--  Notifications Plugin    -->
<script src="assets/js/bootstrap-notify.js"></script>
<!--  Google Maps Plugin    -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
<!-- Material Dashboard javascript methods -->
<script src="assets/js/material-dashboard.js?v=1.2.0"></script>
<!-- Material Dashboard DEMO methods, don't include it in your project! -->
<script src="assets/js/demo.js"></script>

</html>