<?php
include"./../connection.php";
include 'deletion.php';
$deleted = false;
if(isset($_GET['del'])){
    $deleted = deleteTableRow($conn,'price',$_GET['del']);
}
?>
<html>
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Knowledge Table</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="css/pricing.css"/>
  <script src="main.js"></script>
</head>
<body>
<!--Entering Secondary Knowledge of the Product -->

<div>

    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
        ADD Product pricing Details
    </button>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">ADD Product Secondary Details </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form  method="POST" autocomplete="off">
                            <p id="top">Product Secondary Details</p>
                            <label for="Variety">Select Product variety</label><br>
                            <select id="select" name="varietyNameId" id="Variety">  
                            <option>--SELECT VARIETY--</option>
                            <?php 
                                $res= mysqli_query($conn,"SELECT id,name FROM Variety");
                                while($data = mysqli_fetch_assoc($res)){    
                                echo "<option value=".$data['id'].">".$data['name']."</option>";
                                }
                            ?>
                            </select><br>

                            <label>Quantity</label><br>
                            <input type="text" name="quantity" placeholder="Quantity"  required><br>

                            <label>Product Price</label><br>
                            <input type="text" name="price" placeholder="Price"  required><br>

                            <label>Product Description</label><br>
                            <input type="text" name="description" placeholder="Description"  required><br><br>

                            <button id ="save" name="savePriceDetails" type="submit">ADD+</button>
                        </form>              
                    </div>
                </div>
            </div>
    </div>

  </div>

<div style="clear:both;"></div>


<!-- seconddary drtails-->
<div class="col-10">
<table class="table caption-top mt-2" id="pricingTable">
    <caption class="text-primary">Secondary details</caption>
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Product</th> 
        <th scope="col">Variety</th> 
        <th scope="col">Cost</th> 
        <th scope="col">Quantity</th> 
        <th scope="col">Descreption</th>      
        <th scope="col">Action</th>
    </tr>
    </thead>
    <tbody>

    <?php
    $sql ="SELECT 
                c.id as id, p.name as product, v.name as variety,c.cost as cost,c.qnty as qnty,c.descr as descr 
            FROM price c 
            join  variety v 
            on c.varietyId = v.id 
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
        <td><?php echo $data['variety']; ?></td>
        <td><?php echo $data['cost']; ?></td>
        <td><?php echo $data['qnty']; ?></td>
        <td><?php echo $data['descr']; ?></td>
        <td><a href = "?del=<?php echo $data['id']; ?>">Remove</a></td>
    </tr>
    <?php } 
    ?>
    </tbody>
</table>
</div>

</div>
<script>
        $(document).ready( function () {
            $('#pricingTable').DataTable();
        } );
    </script>
</body>
</html>

<?php
//Saving secondary details of the product 
if(isset($_POST['savePriceDetails'])){
    //Get user input from HTML form
    $varietyNameId=$_POST['varietyNameId'];//capture from select input
    $quantity=$_POST['quantity'];
    $cost=$_POST['price'];
    $description=$_POST['description'];   

    
    //insert new data into the table
    $sql = "INSERT INTO price(varietyId,cost,qnty,descr)VALUES('$varietyNameId','$cost','$quantity','$description')";
       
    If (mysqli_query($conn, $sql)){
        echo"<script>alert('Knowledge Added Successfully,');window.location='managepricing.php'</script>";
    } 
    else 
    {
        echo"Error:" . $sql ."" . mysqli_error ($conn);
    }
    mysqli_close($conn);
}
?>