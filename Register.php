
<?php 
include"connection.php";
if(isset($_POST['signup'])){
    //Get user input from HTML form
    $name=$_POST['name'];
    $username=$_POST['username'];
    $email=$_POST['email'];
    $phoneno=$_POST['phoneno'];
    $password=$_POST['password'];
    $confirmpassword=$_POST['confirmpassword'];  
    //Validate user inputs captured from html controls
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    filter_var($email, FILTER_VALIDATE_EMAIL)?null:print"<script>alert('Your email is invalid');history.back(-1);</script>";

    $phoneno = $_POST ["phoneno"]; 
    preg_match('/^[0-9]{10}+$/', $phoneno)?null:print"<script>alert('Your phone number is invalid');window.location='Register.html'</script>";
 
    if ($password != $confirmpassword){
        echo"<script>alert('Passwords Did not match ,Try Again !!');window.location='Register.html'</script>";
    }

    //check if email exist
    $sql=mysqli_query($conn,"SELECT * FROM registration where Email='$email'");
    $count = mysqli_num_rows($sql);
    if($count > 0)
      { 
        echo"<script>alert('Email Already Exists,Login Instead!!');window.location='Register.html'</script>";
        exit;
    }

    //insert new data into the database
    $sql = "INSERT INTO registration (Name,Username,Email,Phoneno,Password)VALUES('$name','$username',
    '$email','$phoneno','$password')";
       

    If (mysqli_query($conn, $sql)){
        echo"<script>alert('New User Added Successfully, Now login');window.location='login.html'</script>";
    } 
    else 
    {
        echo"Error:" . $sql ."" . mysqli_error ($conn);
    }
    mysqli_close($conn);

}