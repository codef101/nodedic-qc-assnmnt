<?php
include"../connection.php";
include 'deletion.php';
$deleted = false;
if(isset($_GET['del'])){
    $deleted = deleteTableRow($conn,'knowledge',$_GET['del']);
}
?>
<html>
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Knowledge Table</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css"/>    
    <link rel="stylesheet" type="text/css" href="css/knowledgetable.css"/>
    <script src="main.js"></script>
</head>
<body>
  <!--Entering Trianing knowledge-->

<div id="row">
   <div id="column">
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
        ADD KNOWLEDGE
    </button>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">ADD KNOWLEDGE </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" autocomplete="off";>
                            <p id="top">Enter training data</p>
                            <label>Phrase</label><br>
                            <input type="text"  name="phrase" placeholder="Enter The Phrase"  required><br><br>
                            <label>Response</label><br>
                            <input type="text"  name="response" placeholder="Enter Suitable Response"  required><br><br>
                            
                            <button id="save"type="submit" name="save">Save</button>
                        </form>                
                    </div>
                </div>
            </div>
    </div>
</div>

<!--Display of the Training knowledge-->

<div style="clear:both;"></div>

<div class="row">
<div class="col-12">
    <table class="table table-striped caption-top mt-2" id ="knowledgeTable">
        <caption class="text-primary">stored knowledge</caption>        
        <?php
                    if($deleted){?>
                        <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
                            <strong>data deleted successfully</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php 
                        } 
                        $deleted= false;
                    ?>
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Phrase</th>      
            <th scope="col">Response</th> 
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $res = mysqli_query($conn,"SELECT * FROM knowledge");
        $id=0;
        while($data=mysqli_fetch_assoc($res)){
            $id++;
        ?>
        <tr>
            <th scope="row"><?php echo $id; ?></th>
            <td><?php echo $data['phrase']; ?></td>
            <td><?php echo $data['response']; ?></td>
            <td><a href = "?del=<?php echo $data['id']; ?>">Remove</a></td>
        </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
</div>
    <script>
        $(document).ready( function () {
            $('#knowledgeTable').DataTable();
        } );
    </script>

</body>
</html>


<?php  
//saving of the knowledge
if(isset($_POST['save'])){
    //Get input from HTML form
    $phrase=$_POST['phrase'];
    $response=$_POST['response'];
       //checking if the phrae already exists
       $sql=mysqli_query($conn,"SELECT * FROM knowledge where phrase='$phrase'");
       $count = mysqli_num_rows($sql);
       if($count > 0)
         { 
           echo"<script>alert('Phrase Already Exists,Add secondary Instead!!');window.location='knowledgetable.php';</script>";
           exit;
       }
   
    //insert new phrases into the table
    $sql = "INSERT INTO knowledge (phrase,response)VALUES('$phrase','$response')";
    If (mysqli_query($conn, $sql)){
        echo"<script>alert('Congratulations, New knowledge Added Successfully');window.location='manageknowledge.php';</script>";
    } 
    else 
    {
        echo"Error:" . $sql ."" . mysqli_error ($conn);
    }
    mysqli_close($conn);

}
?>