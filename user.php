<?php
    //Database connection 
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "purchase_order_bulk_conversion";
    $conn = mysqli_connect($servername,$username,$password,$dbname);
?>



<?php
    //Add data in to the database
    if($_SERVER["REQUEST_METHOD"]=="POST")
    {
        $name = $_POST['name'];
        $nic = $_POST['nic'];
        $address = $_POST['address'];
        $mobile = $_POST['mobile'];
        $e_mail = $_POST['e_mail'];
        $gender = $_POST['gender'];
        $territory = $_POST['territory_name'];
        $user_name = $_POST['u_name'];
        $password = $_POST['password'];

        if(!$conn)
        {
            die("connection faild " . mysqli_connect_error());
        }
        else
        {
            $sql = "insert into user(name,nic,address,mobile,email,gender,territory,username,password)VALUES('$name','$nic','$address','$mobile','$e_mail','$gender','$territory','$user_name','$password')";
            if(mysqli_query($conn,$sql))
            {
                echo "Record Added";
            }
            else
            {
                echo "Record Failed";
            }
        }
    }

?>

<?php
//Pass zone_code to dropdown menu
$query4 = "SELECT territory_code,territory_name FROM territory";

$result_set2 = mysqli_query($conn,$query4);

$territory_list = '';

while ($result3 = mysqli_fetch_assoc($result_set2)) {
    $territory_list .="<option value=\"{$result3['territory_code']}\">{$result3['territory_name']}</option>"; 
}


?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
  </head>
  <body>
    
    <div class="row">
        <div class="col-md-4 offset-md-4 form-div">
            <form action="<?php echo($_SERVER["PHP_SELF"]);?>" method="POST">
                <div align="center">
                    <h3>ADD USERS</h3>
                </div>

                <div align="left">
                    <label>Name</label>
                    <input type="text" class="form-control" name="name" id="name" required>
                </div>

                <div align="left">
                    <label>NIC</label>
                    <input type="text" class="form-control" name="nic" id="nic" required>
                </div>

                <div align="left">
                    <label>Address</label>
                    <input type="text" class="form-control" name="address" id="address" required>
                </div>

                <div align="left">
                    <label>Mobile</label>
                    <input type="text" class="form-control" name="mobile" id="mobile" required>
                </div>

                <div align="left">
                    <label>E-mail</label>
                    <input type="text" class="form-control" name="e_mail" id="e_mail">
                </div></br>

                <div align="left">
                    <label>Gender</label>
                    <select name="gender" id="">
                        <option value="">Select</option>
                        <option>Male</option>
                        <option>FeMale</option>
                    </select>
                </div></br>

                <div align="left">
                    <label>Territory</label>
                    <select name="territory_name" id="">
                        <option value="">Select</option>
                        <?php echo $territory_list; ?>
                    </select>
                </div></br>

                <div align="left">
                    <label>User Name</label>
                    <input type="text" class="form-control" name="u_name" id="u_name" required>
                </div>

                <div align="left">
                    <label>Password</label>
                    <input type="password" class="form-control" name="password" id="password" required>
                </div>

</br>

                <div align="center">
                    <input type="submit" value="SAVE" class="btn btn-success">
                </div>

            </form>
        </div>
    </div>
    
  </body>
</html>