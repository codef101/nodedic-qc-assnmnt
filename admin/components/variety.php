<?php
include "./../connection.php";
include 'deletion.php';
$deleted = false;
if(isset($_GET['del'])){
    $deleted = deleteTableRow($conn,'variety',$_GET['del']);
}
?>
<html>
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Knowledge Table</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="css/variety.css"/>
  <script src="main.js"></script>
</head>
<body>
 
<div>

    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
        ADD Product variety Details
    </button>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">ADD Product variety Details </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" autocomplete="off";>
                            <p id="top">Product variety Details</p>
                            <select id="select" name="prodNameId" id="product">
                            <option>--SELECT PRODUCT--</option>
                            <?php 
                                $res= mysqli_query($conn,"SELECT id,name FROM products");
                                while($data = mysqli_fetch_assoc($res)){    
                                echo "<option value=".$data['id'].">".$data['name']."</option>";
                                }
                            ?>
                            </select><br>

                            <label>Variety Name</label><br>
                            <input type="text" name="vname" placeholder="Variety Name"  required><br><br>
                            
                            <button id="save" type="submit" name="saveVariety">Save</button>
                        </form>              
                    </div>
                </div>
            </div>
    </div>

</div>

<div style="clear:both;"></div>

<!-- variety name-->
<div class="col-12">
<table class="table caption-top mt-2" id ="varietyTable">
    <caption class="text-primary">variety name</caption>
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Product</th>  
        <th scope="col">Name</th>      
        <th scope="col">Action</th>
    </tr>
    </thead>
    <tbody>

    <?php
    $sql ="SELECT v.id as id, p.name as product,v.name as name 
            FROM variety v 
            join products p 
            on v.productId = p.id";
    $res = mysqli_query($conn,$sql);
    $id=0;
    while($data=mysqli_fetch_assoc($res)){
        $id++;
    ?>
    <tr>
        <th scope="row"><?php echo $id; ?></th>
        <td><?php echo $data['product']; ?></td>
        <td><?php echo $data['name']; ?></td>
        <td><a href = "?del=<?php echo $data['id']; ?>">Remove</a></td>
    </tr>
    <?php } ?>
    </tbody>
</table>
</div>
</div>
<script>
        $(document).ready( function () {
            $('#varietyTable').DataTable();
        } );
    </script>
</body>
</html>


<?php
if(isset($_POST['saveVariety'])){
    //Get user input from HTML form
    $prodNameId=$_POST['prodNameId'];
    $vname=$_POST['vname'];
       //check if product name exist
    $sql=mysqli_query($conn,"SELECT * FROM variety where name='$vname'");
    $count = mysqli_num_rows($sql);
    if($count > 0)
      { 
        echo"<script>alert('Product Already Exists,Add secondary Instead!!');window.location='managevariety.php';</script>";
        exit;
    }

    //insert new data into the table
    $sql = "INSERT INTO variety (productId,name)VALUES('$prodNameId','$vname')";
       

    If (mysqli_query($conn, $sql)){
        echo"<script>alert('New Product Added Successfully, Now Add secondary details');window.location='managevariety.php';</script>";
    } 
    else 
    {
        echo"Error:" . $sql ."" . mysqli_error ($conn);
    }
    mysqli_close($conn);

}
?>