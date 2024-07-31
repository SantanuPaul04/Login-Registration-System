<?php  include("connection.php");    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Registration Form</title>
</head>
<body>
    <div class="con">
        <form method="POST" >
        <div class="title">
            Registration Form
        </div>
        <div class="form">
            <div class="input_field">
                <label>First Name</label>
                <input type="text" class="input" name="First_Name" required>
            </div>
            <div class="input_field">
                <label>Last Name</label>
                <input type="text" class="input" name="Last_Name" required>
            </div>
            <div class="input_field">
                <label>Password</label>
                <input type="password" class="input" name="Password" >
            </div>
            <div class="input_field">
                <label>Confirm Password</label>
                <input type="password" class="input" name="Con_Password">
            </div>
            <div class="input_field">
                <label>Gender</label>
                <select name="Gender" required>
                    <option value="No value">Select</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
            </div>
            <div class="input_field">
                <label>Email Address</label>
                <input type="email" class="input" name="Email_Address" required>
            </div>
            <div class="input_field">
                <label>Phone Number</label>
                <input type="number" class="input" name="Phone_Number" required>
            </div>

            <div class="input_field" >
                <label style="margin-right: 20px;">Caste</label>
               <div><input type="radio" name="Caste" value="General" required><label style="margin-left: 5px;">General</label></div> 
                <div><input type="radio" name="Caste" value="OBC" required><label style="margin-left: 5px;">OBC</label></div>
                <div><input type="radio" name="Caste" value="SC" required><label style="margin-left: 5px;">SC</label></div>
                <div><input type="radio" name="Caste"  value="ST"  required><label style="margin-left: 5px;">ST</label></div>
            </div>

            <div class="input_field" >
                <label style="margin-right: 66px;">Language</label>
                <input type="checkbox" name="Language[]" value="English" ><label style="margin-left: 5px;">English</label>
                <input type="checkbox" name="Language[]" value="Hindi" ><label style="margin-left: 5px;">Hindi</label>
                <input type="checkbox" name="Language[]" value="Bengali" ><label style="margin-left: 5px;">Bengali</label>
            </div>

            <div class="input_field">
                <label>Address</label>
                <textarea class="textarea" name="Address" cols="20" rows="3" required></textarea>
            </div>

            <div class="input_field_terms">
                <p><input type="checkbox" class="check" required>
               Agree To Terms And Conditions</p>
            </div>

            <div class="input_field">
                <input type="submit" value="Register" name="Register" class="btn">
            </div>
        </div>
</form>
    </div>   
</body>
</html>

<?php
if($_POST)
{
    $First_Name     = $_POST['First_Name'];
    $Last_Name      = $_POST['Last_Name'];
    $Password       = $_POST['Password'];
    $Con_Password   = $_POST['Con_Password']; 
    $Gender         = $_POST['Gender'];
    $Email_Address  = $_POST['Email_Address'];
    $Phone_Number   = $_POST['Phone_Number'];
    $Caste          = $_POST['Caste'];

    $Language       = $_POST['Language']; 
        $lang = implode(",",$Language);

    $Address        = $_POST['Address'];

    if($First_Name != "" && $Last_Name != "" && $Password != "" && $Con_Password != "" && $Gender != "" && $Email_Address != "" && $Phone_Number != "" && $Address != "")
    {

        $variemail = "SELECT * FROM form where Email_Address = '$Email_Address'";
        $data1 = mysqli_query($con, $variemail);
        $total = mysqli_num_rows($data1);
        $row = mysqli_fetch_assoc($data1);


        // Generate ID -> It Will Generate The Last ID Number + 1.

        $checkno = "SELECT ID FROM `form` ORDER BY `Date` DESC LIMIT 1";
        $no = mysqli_query($con, $checkno);
        $no2 = mysqli_fetch_assoc($no);
        if ($no2)
            {
                $no3 = $no2['ID'];
                $id = $no3 + 1;
            } 
            else {
                $id = 1;
            }

        if($total == 0){

            if($Password == $Con_Password){

            // PassWord Hashing 
            $hash = password_hash($Password, PASSWORD_DEFAULT);

                $query = "INSERT INTO `registrationform`.`form` (`ID`,`First_Name`,`Last_Name`,`Password`,`Con_Password`,`Gender`,`Email_Address`,`Phone_Number`,`Caste`,`Language`,`Address`,`Date`) VALUES ('$id','$First_Name','$Last_Name','$hash','$Con_Password','$Gender','$Email_Address','$Phone_Number','$Caste','$lang','$Address',current_timestamp())";


                $data = mysqli_query($con, $query);
                if($data)
                {
                    echo "<script> alert('Data Inserted Into Database') </script>";
                     

                     ?>
                   <meta http-equiv = "refresh" content = "0; url = http://localhost/MY_PROJECT/Login_Registration/Login.php" />
                    <?php
                    
                }
                else
                {
                    echo "<script> alert('Failed') </script>";
                    
                }
            }
            else{
                echo "<script>alert('Password Not Match!') </script>";
            }  
        }
        else{

            echo "<script>alert('This Email Id Already Exists, Please Enter Another Email !') </script>";
        }   
    }
    else
    {
        echo "<script>alert('Fill The Form') </script>";
    }
}




?>
