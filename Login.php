<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login-style.css">
    <title>Login Page</title>
</head>
<body>
    <div class="con">
        <h1>Login</h1>
        <form action="" method="POST" autocomplete="off">
        <div class="form">
            <input type="email" name="username" class="text" placeholder="Enter Your Email" required>
            <input type="password" name="pass" class="text" placeholder="Enter Your Password" required>

            <div class="forgetpass"><a href="#" class="link" onclick="msg()">Forget Password ?</a></div>

            <input type="submit" name="login" value="login" class="btn">
            <div class="signup">New Member ? <a href="registrationform.php" class="link">Signup Here</a></div>
        </div>
    </div>
</form>
    <script>
        function msg(){
            alert("Yed Kar!");
        }
    </script>
</body>
</html>

<?php
include("connection.php"); 

if(isset($_POST['login']))
{
    $username =  $_POST['username'];
    $pass =  $_POST['pass'];

    // $query1 = "SELECT * FROM form where Email_Address = '$username' and Password = '$pass'";
    $query1 = "SELECT * FROM form where Email_Address = '$username'";
    $data1 = mysqli_query($con, $query1);

    $total = mysqli_num_rows($data1);
    //echo $total;
    $row = mysqli_fetch_assoc($data1);
    
    if($total)
    {
        if(!password_verify($pass, $row['Password'])){

            echo "<script>alert('Password Not Match')</script>";

            }
            else
            {
                //header('location:Display.php');
             $_SESSION['user_name'] = $username;
             ?>
            <meta http-equiv = "refresh" content = "0; url = http://localhost/MY_PROJECT/Login_Registration/Display.php" />
             <?php
                
            }
        }   
    else{
        echo "<script>alert('User Not Found! Enter Correct Email ID')</script>";
    }
}
?>