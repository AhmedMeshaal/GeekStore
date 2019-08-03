<?php
//Making the connection with the database
include('connect-db.php');
//Taking the id from the link of the last page  
//When the page load it takes the id                     
if(isset($_GET['id']))
{                      
	$id=$_GET['id'];
    $query="SELECT * 
            FROM `product_list` 
            WHERE product_id = $id";
    $result = mysqli_query($conn,$query);
    $row = mysqli_fetch_assoc($result);
    }   
//When pressing the button the update query'll run (Taking the input from the form)
//And then it'll notify if the item is been updated or not
if(isset($_POST['updating']))
    {
    $price = $_POST['SalePrice'];
    $id = $_POST['Pid'];
	$query = "UPDATE `product_list` SET `sale_price` = '$price' 
			  WHERE `product_id` = $id";
	$result = mysqli_query($conn,$query);
	
	if($result==1)
    header("location:add_sale.php?status=1");
    else 
    header("location:add_sale.php?status=0");
	}           
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png" />
    <link rel="icon" type="image/png" href="../assets/img/favicon.png" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Add Sale Item | Geek Store</title>
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
                        <a class="navbar-brand" href="#"> Add / Update Sale Item </a>
                    </div>
                </div>
            </nav>
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header" data-background-color="blue">
                                    <h4 class="title">Update Item</h4>
                                    <?php if(isset($_GET['status']) AND $_GET['status']==1) {?>
    <p>Item updated successfully in the Database</p>
   <?php } else if(isset($_GET['status']) AND $_GET['status']==0) {?>
    <p>Sorry Item was not updated</p>
<?php } else{?>
                                    <p class="category">Update Item to Sale</p>
                                </div>
                                <div class="card-content">
                                    <form method="POST" id="update" name="addsale" action="add_sale.php">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <div class="form-group label-floating">
                                                    
                                                    
                                                
                                                    
                                                    
                                                    <label class="control-label">Product ID</label>
                                                
                                                <input type="text" class="form-control" id="Pid" disabled value="P-<?php echo $row['product_id']; ?>">
                                                    <input type="hidden" name = "Pid" value="<?php echo $row['product_id']; ?>">
                                                
                                                </div>
                                            </div>
                                            <div class="col-md-7">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Product Name</label>
                                                    
                                                <input type="email" class="form-control" disabled value="<?php echo $row['product_name']; ?>">
                                                
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Current Original Price</label>
                                                    
                                            <input type="text" class="form-control" disabled value="<?php echo $row['original_price']; ?>">
                                                
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Current Sale Price</label>
                                                    
                                                    
                                <input type="text" class="form-control" name="SalePrice" id="SalePrice" value="<?php echo $row['sale_price']; ?>"/>
                                               
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn pull-right" name="updating" value="updating">Update Product</button>
                                        <div class="clearfix"></div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
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