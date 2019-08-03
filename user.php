                                      
                                        
                                        <?php
                                        
                                        include('connect-db.php');
	                                   $conn = mysqli_connect($host,$user,$pwd,$db);
	
                                        
                                         if(isset($_POST["add"]))
                                    {
                                           $uName=$_POST['UserName'];
                                           $email=$_POST['email'];
                                           $fName=$_POST['FirstName'];
                                           $lName=$_POST['LastName'];
                                           $adrs=$_POST['address'];
                                           $city=$_POST['city'];
                                           $country=$_POST['country'];
                                           $pCode=$_POST['PostalCode'];
                                             
                                             
                        $query = "INSERT INTO registered_geeks SET `user_name`='$uName',`date_registered`= curdate(), `email`='$email',`first_name`='$fName',`last_name`='$lName',`address`='$adrs',`city`='$city',`country`='$country',`postal_code`=$pCode ";                     
                                        
        
                                        	$result = mysqli_query($conn,$query);
                                             
                                              if($result)
                                                  {
                                              header("location:user.php?status=1");      
                                                  }
                                              else 
                                                  {
                                              header("location:user.php?status=0");
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
    <title>Register Customer | Geek Store</title>
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
    <style>
     .error{
                font-size: 20px;
                color: red;
                visibility: hidden;
                text-align: right;
    
            }
    </style>
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
                    <li class="active">
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
                        <a class="navbar-brand" href="#"> Registration Dashboard </a>
                    </div>
                </div>
            </nav>
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header" data-background-color="blue">
                                    <h4 class="title">Register New User</h4>
                                    <p class="category">Complete new user registration</p>
                                    <?php if(isset($_GET['status']) AND $_GET['status']==1) {?>
                                     <p>Your Registration completed successfully....</p>
                                <?php } else if(isset($_GET['status']) AND $_GET['status']==0) {?>
                                     <p>Sorry the registration was not completed</p>
                                <?php } else{?>
                                </div>
                                <div class="card-content">

                                    <!--   Start of the Form  -->


                                    <form action="user.php" method="post" name="insert" id="user">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Username</label>
                                                    <input type="text" class="form-control" name="UserName">
                                                    <span id="Error1" class="error" >(Required !!)</span>
                                                </div>
                                            </div>
                                            <div class="col-md-7">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Email address</label>
                                                    <input type="email" class="form-control" name="email">
                                                    <span id="Error2" class="error" >(Required !!)</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Fist Name</label>
                                                    <input type="text" class="form-control" name="FirstName">
                                                    <span id="Error3" class="error" >(Required !!)</span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Last Name</label>
                                                    <input type="text" class="form-control" name="LastName">
                                                    <span id="Error4" class="error" >(Required !!)</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Adress</label>
                                                    <input type="text" class="form-control" name="address">
                                                    <span id="Error5" class="error" >(Required !!)</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">City</label>
                                                    <input type="text" class="form-control" name="city">
                                                    <span id="Error6" class="error" >(Required !!)</span>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Country</label>
                                                    <input type="text" class="form-control" name="country">
                                                    <span id="Error7" class="error" >(Required !!)</span>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Postal Code</label>
                                                    <input type="text" class="form-control" name="PostalCode">
                                                    <span id="Error8" class="error" >(Required !!)</span>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="submit" class="btn pull-right" name="add" id="add" value="ADD USER" onclick= "return Validation();"/>
                                      <!--  <input type="submit" class="btn pull-right" name="add" id="add" value="save" onclick=" return Validation();/> -->
                                        <div class="clearfix"></div>                                        
                                    </form>
                                </div>
                                <?php } ?>
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
                            function Validation()
                            
        {
            var err = 0;

            //UserName validation 
            var UserName = document.insert.UserName;
            var ErrUserName =document.getElementById("Error1");
            if (UserName.value === "")
                {
                    ErrUserName.setAttribute("style","visibility: visible");
                    //return false;
                    err = 1;
                    }
                    else
                    {
                        ErrUserName.setAttribute("style","visibility: hidden");
                        err = 0;
                    }

                    //Email Address validation
            var Email = document.insert.email;
            var errEmail = document.getElementById("Error2");
            if (Email.value === "")
              {
                errEmail.setAttribute("style","visibility: visible");
                //return false;
                err = 1;
              }
              else 
              {
               errEmail.setAttribute("style","visibility: hidden");
               err = 0; 
              }

              //First Name Validation
            var FName = document.insert.FirstName;
            var errFirstName = document.getElementById("Error3");
            if (FName.value === "")
            {
                errFirstName.setAttribute("style","visibility: visible");
                //return false;
                err = 1;
            }
            else
            {
                errFirstName.setAttribute("style","visibility: hidden");
                err = 0;
            }
            //Last Name Validation
            var LName = document.insert.LastName;
            var errLastName = document.getElementById("Error4");
            if (LName.value === "")
            {
             errLastName.setAttribute("style","visibility: visible");
             //return false;
             err = 1;
            }
            else
            {
                errLastName.setAttribute("style","visibility: hidden");
                err = 0;
            }
            // Address Validation
            var add = document.insert.address;
            var errAddress = document.getElementById("Error5");
            if (add.value === ""){
                errAddress.setAttribute("style","visibility: visible");
                //return false;
                err = 1;
            }
            else
            {
                errAddress.setAttribute("style","visibility: hidden");
                err = 0;
            }
            //City Validation
            var city = document.insert.city;
            var errCity = document.getElementById("Error6");
            if (city.value === ""){
                errCity.setAttribute("style","visibility: visible");
                //return false;
                err = 1;
            }
            else
            {
                errCity.setAttribute("style","visibility: hidden");
                err = 0;
            }
            //Country Validation
            var country = document.insert.country;
            var errCountry = document.getElementById("Error7");
            if (country.value === ""){
                errCountry.setAttribute("style","visibility: visible");
                //return false;
                err = 1
            }
            else
            {
                errCountry.setAttribute("style","visibility: hidden");
                err = 0;
            }
            //Code Validation
            var code = document.insert.PostalCode;
            var errCode = document.getElementById("Error8");
            if (code.value === ""){
                errCode.setAttribute("style","visibility: visible");
                //return false;
                err = 1;
            }
            else
            {
                errCode.setAttribute("style","visibility: hidden");
                err = 0;
            }

            if (err == 0){
                return true;
            }
            else
            {
                return false;
            }


        }
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