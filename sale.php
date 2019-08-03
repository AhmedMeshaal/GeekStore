<?php

    // Define the database
	include('connect-db.php');
	//$conn = mysqli_connect($host,$user,$pwd,$db);

    // Dislay the products from the database into droplist 
    $query = "SELECT `product_name`,product_id,sale_price FROM `product_list`";
    $result = mysqli_query($conn, $query);

     $orders = array();
    while($row1 = mysqli_fetch_assoc($result))
    {
        $orders[$row1["product_id"]] = $row1;  
        }
      
    //Add a new order to the database 
    if(isset($_POST['user'])){
        for( $i = 1; $i <= 5; $i++){
            if(isset($_POST["item$i"]))
            {
                $prodct = $_POST["product$i"];
                $qty = $_POST["quantity$i"];
                $us = $_POST['user'];
                $total = $qty*$orders[$prodct]["sale_price"];

                $query = "INSERT INTO `sales` SET `item_id`='$prodct', `quantity`=$qty, `user_name`='$us',`total_sales`=$total, `order_date`= curdate()";
                
                            $result = mysqli_query($conn,$query);
            
                                                             
                                              if($result)
                                                  {
                                              header("location:sale.php?status=1");      
                                                  }
                                              else 
                                                  {
                                              header("location:sale.php?status=0");
                                                  }
                                         
                                         }                
            }
            
        }
    

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png" />
    <link rel="icon" type="image/png" href="../assets/img/favicon.png" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>New Sale | Geek Store</title>
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
                    <li class="active">
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
                        <a class="navbar-brand" href="#"> Add New Sales </a>
                    </div>
                </div>
            </nav>
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header" data-background-color="green">
                                    <h4 class="title">Add Sale</h4>
                                    <p class="category">Add A New Sale Order</p>
                                    
                                    
                                    <?php if(isset($_GET['status']) AND $_GET['status']==1) {?>
                                     <p>Your sale completed successfully....</p>
                                <?php } else if(isset($_GET['status']) AND $_GET['status']==0) {?>
                                     <p>Sorry the sale was not completed</p>
                                <?php } else{?>
                                
                                
                                </div>
                                <div class="card-content">
                                    <form action="sale.php" method="post">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Order ID (disabled)</label>
                                                    <input type="text" class="form-control" disabled>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Registered Username</label>
                                                    <input type="text" class="form-control" name="user">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group label-floating">
                                                    <p>If user is not registered, just enter "unregistered".</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                           <div class="col-md-1">
                                             <div class="form-group label-floating">
                                              <label class="control-label">Item 1</label>
                                                <input type="checkbox" name="item1" value="item1" />
                                              </label>
                                             </div>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Item Name</label>
                                                   
                                                    <select class="form-control" name="product1">
                                                        <option>-------------</option>
                                                       
                                                        <?php foreach($orders as $v) { ?>
                                                        
                                                        <option value="<?php echo $v['product_id']?>">
                                                        <?php echo $v['product_name'] ?></option>
                                                        <!--<option>Super Mario Villain Figure</option>
                                                        <option>Tiny Arcade Mr. Pacman</option>
                                                        <option>Nintendo GameBoy LCD Watch</option>
                                                        <option>Back to the Future 2 E-Vehicle</option>-->
                                                        <?php } ?>
                                                    
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Qty</label>
                                                    <input type="number" class="form-control" name="quantity1" max=5>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                           <div class="col-md-1">
                                             <div class="form-group label-floating">
                                              <label class="control-label">Item 2</label>
                                                <input type="checkbox" name="item2" value="item2">
                                              </label>
                                             </div>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Item Name</label>
                                                    <select class="form-control" name="product2">
                                                        <option>-------------</option>
                                                        
                                                      <?php foreach($orders as $v) { ?>
                                                        <option value="<?php echo $v['product_id']?>">
                                                            <?php echo $v["product_name"] ?></option>
                                                        <!--<option>Super Mario Villain Figure</option>
                                                        <option>Tiny Arcade Mr. Pacman</option>
                                                        <option>Nintendo GameBoy LCD Watch</option>
                                                        <option>Back to the Future 2 E-Vehicle</option>-->
                                                        
                                                        <?php } ?>
                                                        
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Qty</label>
                                                    <input type="number" class="form-control" name="quantity2" max=5>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                           <div class="col-md-1">
                                             <div class="form-group label-floating">
                                              <label class="control-label">Item 3</label>
                                                <input type="checkbox" name="item3" value="item3">
                                              </label>
                                             </div>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Item Name</label>
                                                    <select class="form-control" name="product3">
                                                        <option>-------------</option>
                                                        
                                                        <?php foreach($orders as $v) { ?>
                                                        
                                                        <option value="<?php echo $v['product_id']?>">
                                                            <?php echo $v["product_name"] ?></option>
                                                        <!--<option>Super Mario Villain Figure</option>
                                                        <option>Tiny Arcade Mr. Pacman</option>
                                                        <option>Nintendo GameBoy LCD Watch</option>
                                                        <option>Back to the Future 2 E-Vehicle</option>-->
                                                        
                                                        <?php } ?>
                                                        
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Qty</label>
                                                    <input type="number" class="form-control" name="quantity3" max=5>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                           <div class="col-md-1">
                                             <div class="form-group label-floating">
                                              <label class="control-label">Item 4</label>
                                                <input type="checkbox" name="item4" value="item4">
                                              </label>
                                             </div>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Item Name</label>
                                                    <select class="form-control" name="product4">
                                                        <option>-------------</option>
                                                        
                                                        <?php foreach($orders as $v) { ?>
                                                        
                                                        <option value="<?php echo $v['product_id']?>">
                                                            <?php echo $v["product_name"] ?></option>
                                                        <!--<option>Super Mario Villain Figure</option>
                                                        <option>Tiny Arcade Mr. Pacman</option>
                                                        <option>Nintendo GameBoy LCD Watch</option>
                                                        <option>Back to the Future 2 E-Vehicle</option>-->
                                                        
                                                        <?php } ?>
                                                        
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Qty</label>
                                                    <input type="number" class="form-control" name="quantity4" max=5>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                           <div class="col-md-1">
                                             <div class="form-group label-floating">
                                              <label class="control-label">Item 5</label>
                                                <input type="checkbox" name="item5" value="item5">
                                              </label>
                                             </div>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Item Name</label>
                                                    <select class="form-control" name="product5">
                                                        <option>-------------</option>
                                                        
                                                        <?php foreach($orders as $v) { ?>
                                                        
                                                        <option value="<?php echo $v['product_id']?>">
                                                            <?php echo $v["product_name"] ?></option>
                                                        <!--<option>Super Mario Villain Figure</option>
                                                        <option>Tiny Arcade Mr. Pacman</option>
                                                        <option>Nintendo GameBoy LCD Watch</option>
                                                        <option>Back to the Future 2 E-Vehicle</option>-->
                                                        
                                                        <?php } ?>
                                                        
                                                    </select>
                                                </div>
                                            </div>   
                                            <div class="col-md-2">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Qty</label>
                                                    <input type="number" class="form-control" name="quantity5" max=5>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" name="submit" value="submit" class="btn btn-success pull-right">Complete Order</button>
                                        <div class="clearfix"></div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
           <footer class="footer">
               
               <?php } ?>
               
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

<script>
    var 
</script>


</html>