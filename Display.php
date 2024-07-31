<?php
session_start();
?>
<html>
    <head>
        <title>Display</title>
        <style>
            body{
                background:#D071F9;
            }
            table{
                background-color:white;
            }
            .update, .delete{
                background-color:green;
                color:white;
                border:0;
                outline:none;
                border-radius: 5px;
                height:30px;
                width:65px;
                font-weight:bold;
                cursor:pointer;
                margin-top: 5px ;
            }
            .delete{
                margin-bottom: 5px ;
                background-color:red;
            }
            .logout{
                background-color: yellow;
                color: black;
                border: none;
                outline:none;
                border-radius: 5px;
                height:30px;
                width:65px;
                font-weight:bold;
                cursor:pointer;
                position: absolute;
                right: 500px;
                top: 7px;
            }
            .lasttext p{
                width: 200%;
                text-align: center;
                padding: 25px 0;
                background: rgb(7,85,91);
                color: white;
                font-weight: 300;
                /* margin-top: 70px; */
                position: absolute;
                bottom: 0;
            }
        </style>

<?php
include("connection.php"); 

$userprofile = $_SESSION['user_name'];
if($userprofile == true)
{

}
else{
    header('location:Login.php');

}

$query = "SELECT * FROM form WHERE Email_Address = '$userprofile'";
$totaldata = mysqli_query($con, $query);

$total = mysqli_num_rows($totaldata);

if($total != 0)
{
    ?>
<h2 align="center"><mark>Displaying All Records</mark></h2>
<a href="Logout.php"><input type="submit" name="" value="Logout" class="logout"></a>
<center>
<table border="2" cellspacing="5" width="180%">
    <tr>
        <th width="3%">ID</th>
        <th width="12%">First_Name</th>
        <th width="5%">Last_Name</th>
        <th width="2%">Password</th>
        <th width="2%">Con_Password</th>
        <th width="7%">Gender</th>
        <th width="10%">Email_Address</th>
        <th width="6%">Phone_Number</th>
        <th width="5%">Caste</th>
        <th width="10%">Language</th>
        <th width="25%">Address</th>
        <th width="20%">Date</th>
        <th width="5%">Operations</th>
</tr>
<?php
while($result = mysqli_fetch_assoc($totaldata))
   {
    echo "<tr>
                <td>".$result["ID"]."</td>
                <td>".$result["First_Name"]."</td>
                 <td>".$result["Last_Name"]."</td>
                 <td>".$result["Password"]."</td>
                <td>".$result["Con_Password"]."</td>
                <td>".$result["Gender"]."</td>
                <td>".$result["Email_Address"]."</td>
                <td>".$result["Phone_Number"]."</td>
                <td>".$result["Caste"]."</td>
                <td>".$result["Language"]."</td>
                <td>".$result["Address"]."</td>
                <td>".$result["Date"]."</td>

                <td><a href='update_design.php?id=$result[ID]'><input type='submit' value='Update' class='update'></a>
                <a href='delete_design.php?id=$result[ID]'><input type='submit' value='Delete' class='delete' onclick='return checkdelete()'></a>
                </td>
            </tr>";
   }
}
else
{
    ?>
    <h2 align="center"><mark>No Records Found</mark></h2>
    <a href="Logout.php"><input type="submit" name="" value="Logout" class="logout"></a>
    <?php
}

?>
</table>
</center>
<h2 align="center"><mark>** You Seeing The Password Like This Beacuse The Password Is Hashed</mark></h2>
<h2 align="center"><mark>For Enquire/Contact Mail Me -> paulsantanu968@gmail.com </mark></h2>
<div class="lasttext">
    <p>Desine and Developed by Santanu Paul &copy; July 2024</p>
 </div>


<script>
    function checkdelete()
    {
        return confirm('Are You Sure You Want To Delete This Record ?');
    }
 </script>

<!-- echo $result["First_Name"]." ".$result["Last_Name"]." ".$result["Password"]." ".$result["Con_Password"]." ".$result["Gender"]." ".$result["Email_Address"]." ".$result["Phone_Number"]." ".$result["Address"]." ".$result["Date"]."<br>"; -->