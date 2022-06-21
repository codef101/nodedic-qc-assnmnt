<?php
include "./../connection.php";
include 'deletion.php';
$deleted = false;
if(isset($_GET['del'])){
    $deleted = deleteTableRow($conn,'products',$_GET['del']);
}
?>
<html>
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Knowledge Table</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="css/products.css"/>
  <script src="main.js"></script>
</head>
<body>
<div>

<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
    ADD Product Basic Details
</button>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ADD Product Basic Details </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" autocomplete="off">
                        <p id="top">Product Basic Details</p>
                        <label>Product Name</label><br>
                        <input type="text"  name="pname" placeholder="Enter Product Name"  required><br><br><br>
                        
                        <button id="save" type="submit" name="saveProduct">Save</button>
                    </form>             
                </div>
            </div>
        </div>
</div>

</div>
<!-- Display of products-->
<div class="col-12">
    <table class="table caption-top mt-2" id ="productTable">
        <caption  id="listn" class="text-primary">product name</caption>
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>      
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $res = mysqli_query($conn,"SELECT * FROM products");
        $id=0;
        while($data=mysqli_fetch_assoc($res)){
            $id++;
        ?>
        <tr>
            <th scope="row"><?php echo $id; ?></th>
            <td><?php echo $data['name']; ?></td>
            <td><a href = "?del=<?php echo $data['id']; ?>">Remove</a></td>
        </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
    <script>
        $(document).ready( function () {
            $('#productTable').DataTable();
        } );
    </script>
</body>
</html>


<?php
//Saving basic details of the product
if(isset($_POST['saveProduct'])){
    //Get user input from HTML form
    $pname=$_POST['pname'];
       //check if product name exist
    $sql=mysqli_query($conn,"SELECT * FROM products where name='$pname'");
    $count = mysqli_num_rows($sql);
    if($count > 0)
      { 
        echo"<script>alert('Product Already Exists,Add secondary Instead!!');window.location='./manageproducts.php';</script>";
        exit;
    }

    //insert new data into the table
    $sql = "INSERT INTO products (name)VALUES('$pname')";
       

    If (mysqli_query($conn, $sql)){
        echo"<script>alert('New Product Added Successfully, Now Add secondary details');window.location='manageproducts.php';</script>";
    } 
    else 
    {
        echo"Error:" . $sql ."" . mysqli_error ($conn);
    }
    mysqli_close($conn);}
?>

