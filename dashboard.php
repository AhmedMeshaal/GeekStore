<?php 
    // Define the database
    include('connect-db.php');
    //The query with assigning it with the connection to a variable
    $query = "SELECT product_list.product_id,product_list.product_name,sales.quantity,SUM(quantity * product_list.sale_price) as total FROM `sales`, product_list WHERE sales.item_id = product_list.product_id GROUP BY sales.item_id ORDER BY total desc";
    $result = mysqli_query($conn, $query);
    $sales = array();
    while($row= mysqli_fetch_assoc($result))
    {
        $sales[$row["product_id"]] = $row;  
    }
    $geeks = array();
    $query = "SELECT user_id, user_name, date_registered, (select SUM(sales.total_sales) from sales WHERE sales.user_name = registered_geeks.user_name) as totals FROM `registered_geeks` order by `user_id` Desc limit 5";
    $result = mysqli_query($conn, $query);
    while($row = mysqli_fetch_assoc($result)){
            $geeks[$row["user_id"]] = array(
            "uName"=>$row["user_name"],
            "dReg"=>$row["date_registered"],
                "totalp"=>$row["totals"]
            
        );
    }

	//To show the Number of registered geeks
    $nMem = 0;
	$query = "SELECT `user_id` 
	FROM `registered_geeks`";
	$result = mysqli_query($conn,$query);
	while($row = mysqli_fetch_assoc($result)){
		$nMem ++;
	}
    //To show the Number of items sold
    $sum = 0;
    $query = "SELECT quantity FROM `sales`";
    $result = mysqli_query($conn,$query);
    while($row = mysqli_fetch_assoc($result)){
        $sum += $row['quantity'];
    }
	//To show the Total of sales for current day
    $sum1 = 0;
    $query = "SELECT sum( `total_sales`) as total_sales, (select ( (SELECT sum(sales.total_sales) FROM sales where sales.order_date = curdate())/ sum(sales.total_sales))*100 from sales) as perc FROM `sales` WHERE order_date = curdate()";
    $result = mysqli_query($conn,$query);
    $row = mysqli_fetch_assoc($result);
        $sum1 = $row;
    
    $dItems = 0;
    $query = "SELECT `original_price`, `sale_price` 
    FROM `product_list`";
    $result = mysqli_query($conn,$query);
    while($row = mysqli_fetch_assoc($result)){
        if($row["original_price"] > $row["sale_price"])
            $dItems ++;
    }
	//This query to show data in DAYLY SALES chart
    $query = "SELECT DATE_FORMAT(order_date,'%w') AS DAY , count(order_id) AS COUNT 
    FROM sales WHERE DATE_FORMAT(order_date,'%c') = MONTH(CURDATE()) 
    GROUP BY DATE_FORMAT(order_date,'%a') 
    ORDER BY order_date ASC ";
	
    $result=mysqli_query($conn,$query);
	
    for($i=0;$i<=6;$i++)
	$daySales[$i]=0;
    while($row=mysqli_fetch_array($result))
    {
	$daySales[1*$row['DAY']]=1*$row['COUNT'];
    }
	//This query to show data in YEARLY SALES chart
    $query = "SELECT DATE_FORMAT(order_date,'%c') AS MONTH , SUM(total_sales) AS TOTAL 
    FROM sales 
    WHERE DATE_FORMAT(order_date,'%Y') = YEAR(CURDATE()) 
    GROUP BY DATE_FORMAT(order_date,'%c') ORDER BY order_date ASC";
    
    $result=mysqli_query($conn,$query);
    for($i=1;$i<=12;$i++)
	$yearSales[$i]=0;
    while($row=mysqli_fetch_array($result))
    {
	$yearSales[1*$row['MONTH']]=1*$row['TOTAL'];
    }
	//This query to show data in NEW USERS chart
    $query = "SELECT DATE_FORMAT(date_registered,'%c') AS MONTH , count(user_id) AS COUNT 
    FROM registered_geeks WHERE DATE_FORMAT(date_registered,'%Y') = YEAR(CURDATE()) 
    GROUP BY DATE_FORMAT(date_registered,'%c') 
    ORDER BY date_registered DESC limit 6";
    
    $result=mysqli_query($conn,$query);
    for($i=0;$i<6;$i++)
	$newUsers[$i]=0;
    while($row=mysqli_fetch_array($result))
    {
    	$newUsers[1*$row['COUNT']] = 1*$row['MONTH'];
	//$newUsers[1*$row['MONTH']]=1*$row['COUNT'];
    }
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png" />
    <link rel="icon" type="image/png" href="../assets/img/favicon.png" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Dashboard | Geek Store</title>
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
                    <li class="active">
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
                    <li>
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
                        <a class="navbar-brand" href="#"> Sales Dashboard </a>
                    </div>
                </div>
            </nav>
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="card card-stats">
                                <div class="card-header" data-background-color="orange">
                                    <i class="material-icons">shopping_cart</i>
                                </div>
                                <div class="card-content">
                                    <p class="category">No. of Discounted Items</p>
                                    <h3 class="title"><?php echo $dItems; ?>/50</h3>
                                </div>
                                <div class="card-footer">
                                    <div class="stats">
                                        <i class="material-icons">local_offer</i> <?php echo $dItems/50*100 ?>% items on sale 
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="card card-stats">
                                <div class="card-header" data-background-color="green">
                                    <i class="material-icons">credit_card</i>
                                </div>
                                <div class="card-content">
                                    <p class="category">Total Sale Today</p>
                                    <h3 class="title">SAR <?php echo $sum1["total_sales"]; ?></h3>
                                </div>
                                <div class="card-footer">
                                    <div class="stats">
                                        <i class="material-icons">update</i> Last 24 Hours
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="card card-stats">
                                <div class="card-header" data-background-color="red">
                                    <i class="material-icons">equalizer</i>
                                </div>
                                <div class="card-content">
                                    <p class="category">Items Sold</p>
                                    <h3 class="title"><?php echo $sum; ?></h3>
                                </div>
                                <div class="card-footer">
                                    <div class="stats">
                                        <i class="material-icons">library_add</i> Total items sold
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="card card-stats">
                                <div class="card-header" data-background-color="blue">
                                    <i class="material-icons">loyalty</i>
                                </div>
                                <div class="card-content">
                                    <p class="category">Members</p>
                                    <h3 class="title"><?php echo $nMem; ?></h3>
                                </div>
                                <div class="card-footer">
                                    <div class="stats">
                                        <i class="material-icons">face</i> Registered Geeks
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header card-chart" data-background-color="green">
                                    <div class="ct-chart" id="dailySalesChart"></div>
                                </div>
                                <div class="card-content">
                                    <h4 class="title">Daily Sales <small>(in thousands)</small></h4>
                                    <p class="category">
                                        <span class="text-success"><i class="fa fa-long-arrow-up"></i> <?php echo intval($sum1["perc"]); ?>% </span> increase in today sales.</p>
                                </div>
                                <div class="card-footer">
                                    <div class="stats">
                                        <i class="material-icons">access_time</i> updated recently
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header card-chart" data-background-color="orange">
                                    <div class="ct-chart" id="emailsSubscriptionChart"></div>
                                </div>
                                <div class="card-content">
                                    <h4 class="title">Yearly Sales</h4>
                                    <p class="category">Sales this year</p>
                                </div>
                                <div class="card-footer">
                                    <div class="stats">
                                        <i class="material-icons">access_time</i> updated recently
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header card-chart" data-background-color="red">
                                    <div class="ct-chart" id="completedTasksChart"></div>
                                </div>
                                <div class="card-content">
                                    <h4 class="title">New Users</h4>
                                    <p class="category">New registered users in last 5 months</p>
                                </div>
                                <div class="card-footer">
                                    <div class="stats">
                                        <i class="material-icons">access_time</i> updated recently
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-12">
                            <div class="card">
                                <div class="card-header" data-background-color="green">
                                    <h4 class="title">Top Products Stats</h4>
                                    <p class="category">Top Products Sold Till Now</p>
                                </div>
                                <div class="card-content table-responsive">
                                    <table class="table table-hover">
                                        <thead class="text-success">
                                            <th>ID</th>
                                            <th>Product Name</th>
                                            <th>No. Sold</th>
                                            <th>Total Sales</th>
                                        </thead>
                                        <tbody>
                                 <?php foreach($sales as $k => $v) { ?>
                                            <tr>
                                                <td>P-<?php echo $k; ?></td>
                                                <td><?php echo $v["product_name"]; ?></td>
                                                <td><?php echo $v["quantity"]; ?></td>
                                                <td><?php echo $v["total"]; ?></td>
                                            </tr>
                                            <?php  }  ?>
                                            <!--<tr>
                                                <td>P-101</td>
                                                <td>Super Mario Villain Figure</td>
                                                <td>5</td>
                                                <td>500</td>
                                            </tr>
                                            <tr>
                                                <td>P-110</td>
                                                <td>Tiny Arcade Mr. Pacman</td>
                                                <td>5</td>
                                                <td>450</td>
                                            </tr>
                                            <tr>
                                                <td>P-230</td>
                                                <td>Nintendo GameBoy LCD Watch</td>
                                                <td>2</td>
                                                <td>200</td>
                                            </tr>
                                            <tr>
                                                <td>P-130</td>
                                                <td>Back to the Future 2 E-Vehicle</td>
                                                <td>1</td>
                                                <td>190</td>
                                            </tr>-->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="card">
                                <div class="card-header" data-background-color="blue">
                                    <h4 class="title">Registered Geeks Stats</h4>
                                    <p class="category">Last five new registered users</p>
                                </div>
                                <div class="card-content table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <th>No</th>
                                            <th>Name</th>
                                            <th>Date Registered</th>
                                            <th>Purchase Total</th>
                                        </thead>
                                        <tbody>
                                     <?php 
                                            foreach($geeks as $k => $v) { ?>
                                            <tr>
                                                <td><?php echo $k; ?></td>
                                                <td><?php echo $v["uName"]; ?></td>
                                                <td><?php echo $v["dReg"]; ?></td>
                                                <td><?php if(isset($v["totalp"])) echo $v["totalp"]; else echo 0; ?></td>
                                            </tr>
                                            <?php } ?>
                                            <!--<tr>
                                                <td>2</td>
                                                <td>Khaled Hamed</td>
                                                <td>4 June 2017</td>
                                                <td>1000</td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>Ahmed Basha</td>
                                                <td>10 April 2017</td>
                                                <td>10</td>
                                            </tr>
                                            <tr>
                                                <td>4</td>
                                                <td>Ali Jaafer</td>
                                                <td>1 April 2017</td>
                                                <td>2000</td>
                                            </tr>
                                            <tr>
                                                <td>5</td>
                                                <td>Fatima Mohammed</td>
                                                <td>1 January 2017</td>
                                                <td>1500</td>
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
<script type="text/javascript">
   
    /* ----------==========     Daily Sales Chart initialization    ==========---------- */

        dataDailySalesChart = {
            labels: ['M', 'T', 'W', 'T', 'F', 'S', 'S'],
            series: [
                [ <?php echo $daySales[1]; ?>, <?php echo $daySales[2]; ?>, <?php echo $daySales[3]; ?>, <?php echo $daySales[4]; ?>, <?php echo $daySales[5]; ?>, <?php echo $daySales[0]; ?>, <?php echo $daySales[6]; ?>]
            ]
        };

        optionsDailySalesChart = {
            lineSmooth: Chartist.Interpolation.cardinal({
                tension: 0
            }),
            low: 0,
            high: 50,
            chartPadding: {
                top: 0,
                right: 0,
                bottom: 0,
                left: 0
            },
        }

        var dailySalesChart = new Chartist.Line('#dailySalesChart', dataDailySalesChart, optionsDailySalesChart);

        md.startAnimationForLineChart(dailySalesChart);
    
    
    /* ----------==========     Yearly Sales Chart initialization    ==========---------- */

        var dataEmailsSubscriptionChart = {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            series: [
                [<?php echo $yearSales[1]; ?>, <?php echo $yearSales[2]; ?>, <?php echo $yearSales[3]; ?>, <?php echo $yearSales[4]; ?>, <?php echo $yearSales[5]; ?>, <?php echo $yearSales[6]; ?>, <?php echo $yearSales[7]; ?>, <?php echo $yearSales[8]; ?>, <?php echo $yearSales[9]; ?>, <?php echo $yearSales[11]; ?>, <?php echo $yearSales[11]; ?>, <?php echo $yearSales[12]; ?>]

            ]
        };
        var optionsEmailsSubscriptionChart = {
            axisX: {
                showGrid: false
            },
            low: 0,
            high: 1000,
            chartPadding: {
                top: 0,
                right: 5,
                bottom: 0,
                left: 0
            }
        };
        var responsiveOptions = [
            ['screen and (max-width: 640px)', {
                seriesBarDistance: 5,
                axisX: {
                    labelInterpolationFnc: function(value) {
                        return value[0];
                    }
                }
            }]
        ];
        var emailsSubscriptionChart = Chartist.Bar('#emailsSubscriptionChart', dataEmailsSubscriptionChart, optionsEmailsSubscriptionChart, responsiveOptions);

        //start animation for the Yearly Sales Chart
        md.startAnimationForBarChart(emailsSubscriptionChart);
    
    /* ----------==========     New Users Chart initialization    ==========---------- */

        dataCompletedTasksChart = {
            labels: ['t-5', 't-4', 't-3', 't-2', 't-1', 't'],
            series: [
                [<?php echo $newUsers[0]; ?>, <?php echo $newUsers[1]; ?>, <?php echo $newUsers[2]; ?>, <?php echo $newUsers[3]; ?>, <?php echo $newUsers[4]; ?>, <?php echo $newUsers[5]; ?>]

            ]
        };

        optionsCompletedTasksChart = {
            lineSmooth: Chartist.Interpolation.cardinal({
                tension: 0
            }),
            low: 0,
            high: 15,
            chartPadding: {
                top: 0,
                right: 0,
                bottom: 0,
                left: 0
            }
        }

        var completedTasksChart = new Chartist.Line('#completedTasksChart', dataCompletedTasksChart, optionsCompletedTasksChart);

        // start animation for the New Users Chart - Line Chart
        md.startAnimationForLineChart(completedTasksChart);
</script>
</html>