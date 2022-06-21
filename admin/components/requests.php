<?php
include "./../connection.php";
include 'deletion.php';
$deleted = false;
if (isset($_GET['del'])) {
    $deleted = deleteTableRow($conn, 'price', $_GET['del']);
}
if (isset($_GET['status']) && isset($_GET['id'])) {
    $sql = "update requests set status = '".$_GET['status']."' where id=". $_GET['id'];
    $res = mysqli_query($conn,$sql);
    echo '<script>alert("status changed: '.mysqli_error($conn).'")</script>';
}
?>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Requests</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/.css" />
    <script src="main.js"></script>
</head>

<body>
    <!--Requests from the User -->


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
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>

                <?php
                $sql = "SELECT * from requests inner join variety on variety.id = requests.variety_id left join price on price.varietyId = variety.id";
                $res = mysqli_query($conn, $sql);
                $id = 0;
                while ($data = mysqli_fetch_assoc($res)) {
                    $id++; ?>
                    <tr>
                        <th scope="row"><?php echo $id; ?></th>
                        <td><?php echo $data['name']; ?></td>
                        <td><?php echo $data['cost']; ?></td>
                        <td>
                            <form action="" method="get" class="form-inline">
                                <div class="input-group">
                                    <input type="hidden" name="id" value="<?=$id?>">
                                    <select name="status" id="<?= $id ?>}" class="form-select">
                                        <option value="<?= $data['status'] ?>" selected disabled><?= $data['status'] ?></option>
                                        <option value="delivered">Pending</option>
                                        <option value="delivered">Delivered</option>
                                        <option value="paid">Paid</option>
                                        <option value="completed">Completed</option>
                                    </select>
                                    <button class="btn btn-sm btn-primary" type="submit">Go</button>
                                </div>
                            </form>
                        </td>
                        <td><?php echo $data['created_at']; ?></td>
                        <td><a href="?del=<?php echo $data['id']; ?>">Remove</a></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
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