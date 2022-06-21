<?php
session_start();
include 'connection.php';
include 'includes/Role.php';
if(isset($_POST['login']))
{
    $email = $_POST['email'];
    $pass =$_POST['pass'];
    $sql=mysqli_query($conn,"SELECT * FROM registration where Email='$email' and Password='$pass'"); //kiggspremium@gmail.com
   
    $row  = mysqli_fetch_array($sql);
    if(is_array($row))
    {
        $_SESSION["Email"]=$row['Email'];
        $_SESSION["Username"]=$row['Username'];
        $_SESSION["Role"]=$row['Role'];
        if($row['Role']==Role::$admin){
            header("Location: Dashboard.php");
        }
        else{
            header("Location: user/");
        } 
    }
    else
    {
        echo "<script>alert('Invalid Email ID/Password. Please try again later');window.location='login.html'</script>";
    }
}
?>