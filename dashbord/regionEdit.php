<?php
    //Database connection 
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "purchase_order_bulk_conversion";
    $conn = mysqli_connect($servername,$username,$password,$dbname);
?>

<?php
    //Code autogenerate region_code
    $query = "select * from region order by region_code desc limit 1";
    $result = mysqli_query($conn,$query);
    $row = mysqli_fetch_array($result);
    $lastid = $row['region_code'];
    if($lastid == "")
    {
        $region_code = "REGION1";
    }
    else
    {
        $region_code = substr($lastid,6);
        $region_code = intval($region_code);
        $region_code = "REGION" . ($region_code + 1);
    }

?>

<?php
    //Add data in to the database
    if($_SERVER["REQUEST_METHOD"]=="POST")
    {
        $region_code = $_POST['r_code'];
        $region_name = $_POST['region_name'];
        $zone_list = $_POST['zone_long_description'];


        if(!$conn)
        {
            die("connection faild " . mysqli_connect_error());
        }
        else
        {
            $sql = "insert into region(region_code,region_name,zone_code)VALUES('$region_code','$region_name','$zone_list')";
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
$query2 = "SELECT zone_code,zone_long_description FROM zone";

$result_set = mysqli_query($conn,$query2);

$zone_list = '';

while ($result1 = mysqli_fetch_assoc($result_set)) {
    $zone_list .="<option value=\"{$result1['zone_code']}\">{$result1['zone_long_description']}</option>"; 
}


?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Region</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
  </head>
  <body>
    
    <div class="row">
        <div class="col-md-4 offset-md-4 form-div">
            <form action="<?php echo($_SERVER["PHP_SELF"]);?>" method="POST">
                <div align="center">
                    <h3>EDIT REGION</h3>
                </div></br>

                <div align="left">
                    <label>Zone</label>
                    <select name="zone_long_description" id="">
                        <option value="">Select</option>
                        <?php echo $zone_list; ?>
                    </select>
                </div></br>

                <div align="left">
                    <label>Region Code</label>
                    <input type="text" class="form-control" name="r_code" id="r_code" style="color:brown">
                </div>

                <div align="left">
                    <label>Region Name</label>
                    <input type="text" class="form-control" name="region_name" id="region_name">
                </div>



</br>

                <div align="center">
                    <input type="submit" value="EDIT REGION" class="btn btn-success">
                </div>

            </form>
        </div>
    </div>
    
  </body>
</html>