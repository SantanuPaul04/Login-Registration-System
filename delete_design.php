<?php include("connection.php"); 
session_start();

$fid = $_GET["id"];
// Session
$userprofile = $_SESSION['user_name'];
if($userprofile == true)
{

}
else{
    header('location:Login.php');

}
$query= "DELETE FROM form where ID ='$fid'";
$data = mysqli_query($con, $query);

if($data)
{
    echo "<script>alert('Record Deleted')</script>";
    
    ?>
    <meta http-equiv = "refresh" content = "0; url = http://localhost/MY_PROJECT/Login_Registration/Display.php" />
    <?php
}
else
{
    echo "<script>alert('Failed')</script>";

}



?>

