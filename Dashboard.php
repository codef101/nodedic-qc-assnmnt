<!DOCTYPE html>
<?php 
include'./includes/Role.php';
include'./includes/auth.php';
include 'Connection.php';
?>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" media="screen" href="css/Dashboard.css" />
  <link rel="stylesheet" type="text/css" href="admin/css/adminNavbar.css"/>
    <script src="main.js"></script>
    <style>
        .card{
            border-radius: 40px;
            margin:20px;
            width:30%;
            color:white;
        }
        img { opacity: 0.5; }
        </style>
</head>
<body>
    <?php 
        //session_start();
        // (!isset($_SESSION['Email']) || $_SESSION['Email'] == "")? header("Location: home.html"):null; //ensures only login user can access dashboard
     ?>

        <?php 
        if($_SESSION['Role'] == Role::$admin){
            //admin dashboard Role.$admin
        include"./admin/includes/adminNaVbar.php";
        }
        else{
            //exit
        header("location: login.html");
        }
        
        ?>
        <div class="row">
            <div class="card shadow bg-info"style="--bs-bg-opacity: .5;">
                <div class="card-body ">
                    <img class="card-img-top w-50 mt-4 h-75 " src="images/chart-ppf.svg" alt="Card image">
                    <div class="card-img-overlay float-right">
                        <h5 class="card-title">Products</h5>
                        <p class="card-text"><?php
                        $res=mysqli_query($conn,"SELECT * FROM products");
                        $count=mysqli_num_rows($res);
                        echo $count;
                        ?></p>
                        <a href="/QUICKMART-CHATBOT/admin/manageproducts.php" class="btn btn-primary ">View</a>
                    </div>
                </div>
            </div>
            <div class="card shadow bg-success"style="--bs-bg-opacity: .5;">
                <div class="card-body ">
                    <img class="card-img-top w-50 mt-4 h-75 " src="images/sitemap.svg" alt="Card image">
                    <div class="card-img-overlay float-right">
                        <h5 class="card-title">Variety</h5>
                        <p class="card-text"><?php
                        $res=mysqli_query($conn,"SELECT * FROM variety");
                        $count=mysqli_num_rows($res);
                        echo $count;
                        ?></p>
                        <a href="/QUICKMART-CHATBOT/admin/managevariety.php" class="btn btn-primary">View</a>
                    </div>
                </div>
            </div>
            <div class="card shadow bg-primary"style="--bs-bg-opacity: .5;">
                <div class="card-body ">
                    <img class="card-img-top w-50 mt-4 h-75 " src="images/account-group.svg" alt="Card image">
                    <div class="card-img-overlay float-right">
                        <h5 class="card-title">Users</h5>
                        <p class="card-text"><?php
                        $res=mysqli_query($conn,"SELECT * FROM registration");
                        $count=mysqli_num_rows($res);
                        echo $count;
                        ?></p>
                        <a href="/QUICKMART-CHATBOT/admin/manageusers.php" class="btn btn-primary">View</a>
                    </div>
                </div>
            </div>
            <div class="card shadow bg-warning"style="--bs-bg-opacity: .5;">
                <div class="card-body ">
                    <img class="card-img-top w-50  mt-4 h-75 " src="images/database-cog.svg" alt="Card image">
                    <div class="card-img-overlay float-right">
                        <h5 class="card-title">Knowledge</h5>
                        <p class="card-text"><?php
                        $res=mysqli_query($conn,"SELECT * FROM knowledge");
                        $count=mysqli_num_rows($res);
                        echo $count;
                        ?></p>
                        <a href="/QUICKMART-CHATBOT/admin/manageknowledge.php" class="btn btn-primary">View</a>
                    </div>
                </div>
            </div>
            <div class="card shadow bg-info"style="--bs-bg-opacity: .5;">
                <div class="card-body ">
                    <img class="card-img-top w-50 mt-4 h-75 " src="images/razor-single-edge.svg" alt="Card image">
                    <div class="card-img-overlay">
                        <h5 class="card-title">Variety pricing</h5>
                        <p class="card-text"><?php
                        $res=mysqli_query($conn,"SELECT * FROM price");
                        $count=mysqli_num_rows($res);
                        echo $count;
                        ?></p>
                        <a href="/QUICKMART-CHATBOT/admin/managepricing.php" class="btn btn-primary">View</a>
                    </div>
                </div>
            </div>
        </div>                      
</body>
</html>