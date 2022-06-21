<?php
include "../../Connection.php";
session_start();
?>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Requests</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/.css" />
    <script src="main.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" media="screen" href="../../css/Dashboard.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" />
    <script src="main.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
</head>

<body>
    <!--Requests from the User -->

    
    <div class="container">
        <div class="row mx-auto">
        <div class="text-center font-weight-bold mt-5">
        <h3 class="text-lg">You order details</h3>
    </div>
            <div class="col-10">
                <table class="table caption-top mt-2" id="pricingTable">
                    <caption class="text-primary">Secondary details</caption>
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Request</th>
                            <th scope="col">Price</th>
                            <th scope="col">status</th>
                            <th scope="col">Date</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        $sql = "SELECT * from requests inner join variety on variety.id = requests.variety_id inner join price on price.varietyId = variety.id inner join registration on registration.id=requests.user_id where username='".$_SESSION['Username']."'";
                        $res = mysqli_query($conn, $sql);
                        $id = 0;
                        while ($data = mysqli_fetch_assoc($res)) {
                            $id++;
                        ?>
                            <tr>
                                <th scope="row"><?php echo $id; ?></th>
                                <td><?php echo $data['name']; ?></td>
                                <td><?php echo $data['cost']; ?></td>
                                <td><?php echo $data['status']; ?></td>
                                <td><?php echo $data['created_at']; ?></td>
                            </tr>
                        <?php }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    </div>
    <script>
        $(document).ready(function() {
            $('#pricingTable').DataTable();
        });
    </script>
</body>

</html>

<?php
//Saving secondary details of the product 
if (isset($_POST['savePriceDetails'])) {
    //Get user input from HTML form
    $varietyNameId = $_POST['varietyNameId']; //capture from select input
    $quantity = $_POST['quantity'];
    $cost = $_POST['price'];
    $description = $_POST['description'];


    //insert new data into the table
    $sql = "INSERT INTO price(varietyId,cost,qnty,descr)VALUES('$varietyNameId','$cost','$quantity','$description')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Knowledge Added Successfully,');window.location='managepricing.php'</script>";
    } else {
        echo "Error:" . $sql . "" . mysqli_error($conn);
    }
    mysqli_close($conn);
}
?>