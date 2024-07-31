<?php  include("connection.php");  
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

$query = "SELECT * FROM form where ID = '$fid'";
$totaldata = mysqli_query($con, $query);

$total = mysqli_num_rows($totaldata);
$result = mysqli_fetch_assoc($totaldata);

$language = $result['Language'];
$language1 = explode(",", $language);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Update Form</title>
</head>
<body>
    <div class="con">
        <form action="#" method="POST">
        <div class="title">
            Update Details
        </div>
        <div class="form">
            <div class="input_field">
                <label>First Name</label>
                <input type="text" class="input" value="<?php echo $result['First_Name']  ?>"  name="First_Name" required>
            </div>
            <div class="input_field">
                <label>Last Name</label>
                <input type="text" class="input" value="<?php echo $result['Last_Name']  ?>"  name="Last_Name" required>
            </div>
            <div class="input_field">
                <label>Password</label>
                <input type="password" class="input"  value="<?php echo $result['Password']  ?>" name="Password" required>
            </div>
            <div class="input_field">
                <label>Confirm Password</label>
                <input type="password" class="input" value="<?php echo $result['Con_Password']  ?>"  name="Con_Password"required>
            </div>
            <div class="input_field">
                <label>Gender</label>
                <select name="Gender" required>
                    <option value="No value">Select</option>
                    <option value="Male"
                    <?php
                    if($result["Gender"]== 'Male')
                    {
                        echo "Selected";
                    } 
                    ?>
                    >Male</option>
                    <option value="Female"
                    <?php
                    if($result["Gender"]== 'Female')
                    {
                        echo "Selected";
                    } 
                    ?>
                    >Female</option>
                </select>
            </div>
            <div class="input_field">
                <label>Email Address</label>
                <input type="email" class="input"  value="<?php echo $result['Email_Address']  ?>" name="Email_Address" required>
            </div>
            <div class="input_field">
                <label>Phone Number</label>
                <input type="number" class="input"  value="<?php echo $result['Phone_Number']  ?>" name="Phone_Number" required>
                </div>

                <div class="input_field" >
                <label style="margin-right: 90px;">Caste</label>
                <input type="radio" name="Caste" value="General" required
                <?php
                if($result["Caste"] == "General")
                {
                    echo "Checked";
                }  
                ?>
                ><label style="margin-left: 5px;">General</label>
                <input type="radio" name="Caste" value="OBC" required
                <?php
                if($result["Caste"] == "OBC")
                {
                    echo "Checked";
                }  
                ?> >
                <label style="margin-left: 5px;">OBC</label>
                <input type="radio" name="Caste" value="SC" required
                <?php
                if($result["Caste"] == "SC")
                {
                    echo "Checked";
                } ?>
                > 
                <label style="margin-left: 5px;">SC</label>
                <input type="radio" name="Caste"  value="ST"  required
                <?php
                if($result["Caste"] == "ST")
                {
                    echo "Checked";
                } ?>
                ><label style="margin-left: 5px;">ST</label>
            
            </div>
            <div class="input_field" >
                <label style="margin-right: 66px;">Language</label>
                <input type="checkbox" name="Language[]" value="English" 
                <?php
                if(in_array("English",$language1))
                {
                    echo "Checked";
                }
                ?>
                ><label style="margin-left: 5px;">English</label>
                <input type="checkbox" name="Language[]" value="Hindi" 
                <?php
                if(in_array("Hindi",$language1))
                {
                    echo "Checked";
                }
                ?>
                ><label style="margin-left: 5px;">Hindi</label>
                <input type="checkbox" name="Language[]" value="Bengali" 
                <?php
                if(in_array("Bengali",$language1))
                {
                    echo "Checked";
                }
                ?>
                ><label style="margin-left: 5px;">Bengali</label>
            </div>

            <div class="input_field">
                <label>Address</label>
                <textarea class="textarea" name="Address" cols="20" rows="3" required><?php echo $result['Address'] ?></textarea>
            </div>

            <div class="input_field_terms">
                <p><input type="checkbox" class="check" required>
               Agree To Terms And Conditions</p>
            </div>

            <div class="input_field">
                <input type="submit" value="Update" name="Update" class="btn">
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
        if($Password == $Con_Password){

            // PassWord Hashing 
            $hash = password_hash($Password, PASSWORD_BCRYPT);

            $query = "UPDATE form set First_Name='$First_Name',Last_Name='$Last_Name',Password='$hash',Con_Password='$hash',Gender='$Gender',Email_Address='$Email_Address',Phone_Number='$Phone_Number',Caste='$Caste',Language='$lang',Address='$Address' where id='$fid'";

            $data = mysqli_query($con, $query);

            if($data)
            {
                echo "<script>alert('Data Inserted Into Database')</script>";
                ?>
                <meta http-equiv = "refresh" content = "0; url = http://localhost/MY_PROJECT/Login_Registration/Display.php" />
                <?php
            }
            else
            {
                echo "Failed";
            }
        }
        else{
            echo "<script>alert('Password Not Match!') </script>";
        }    
    }
    else
    {
        echo "<script>alert('Fill The Form') </script>";
    }    
}
?>



