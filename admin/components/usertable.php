
<?php
//View of the All Users
include"./../connection.php";
include 'deletion.php';
$deleted = false;
if(isset($_GET['del'])){
    $deleted = deleteTableRow($conn,'registration',$_GET['del']);
}
?>
<table class="table caption-top mt-2" id ="userTable">
    <caption class="text-primary">USERS</caption>
<thead>
  <tr>
    <th scope="col">#</th>
    <th scope="col">Name</th>
    <th scope="col">username</th>
    <th scope="col">Email</th>
    <th scope="col">Phone Number</th>      
    <th scope="col">Action</th>
  </tr>
</thead>
<tbody>
  <?php
   $res = mysqli_query($conn,"SELECT * FROM registration");
   $id=0;
   while($data=mysqli_fetch_assoc($res)){
     $id++;
  ?>
  <tr>
    <th scope="row"><?php echo $id; ?></th>
    <td><?php echo $data['Name']; ?></td>
    <td><?php echo $data['Username']; ?></td>
    <td><?php echo $data['Email']; ?></td>
    <td><?php echo $data['Phoneno']; ?></td>
    <td><a style="color:brown;text-decoration:none;" href = "?del=<?php echo $data['id']; ?>">Remove</a></td>
  </tr>
   <?php } ?>
</tbody>
</table>
  <script>
        $(document).ready( function () {
            $('#userTable').DataTable();
        } );
    </script>