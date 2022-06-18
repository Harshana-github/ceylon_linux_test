<?php
    //Database connection 
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "purchase_order_bulk_conversion";
    $conn = mysqli_connect($servername,$username,$password,$dbname);
?>

<?php
    //Code autogenerate territory_code
    $query = "select * from territory order by territory_code desc limit 1";
    $result = mysqli_query($conn,$query);
    $row = mysqli_fetch_array($result);
    $lastid = $row['territory_code'];
    if($lastid == "")
    {
        $territory_code = "TERRITORY1";
    }
    else
    {
        $territory_code = substr($lastid,9);
        $territory_code = intval($territory_code);
        $territory_code = "TERRITORY" . ($territory_code + 1);
    }

?>

<?php
    //Add data in to the database
    if($_SERVER["REQUEST_METHOD"]=="POST")
    {
        $territory_code = $_POST['t_code'];
        $territory_name = $_POST['territory_name'];
        $zone = $_POST['zone_long_description'];
        $region = $_POST['region_name'];


        if(!$conn)
        {
            die("connection faild " . mysqli_connect_error());
        }
        else
        {
            $sql = "insert into territory(territory_code,territory_name,zone_code,region_name)VALUES('$territory_code','$territory_name','$zone','$region')";
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
$query3 = "SELECT zone_code,zone_long_description FROM zone";

$result_set1 = mysqli_query($conn,$query3);

$zone_list = '';

while ($result2 = mysqli_fetch_assoc($result_set1)) {
    $zone_list .="<option value=\"{$result2['zone_code']}\">{$result2['zone_long_description']}</option>"; 
}


?>

<?php
//Pass zone_code to dropdown menu
$query4 = "SELECT region_code,region_name FROM region";

$result_set2 = mysqli_query($conn,$query4);

$region_list = '';

while ($result3 = mysqli_fetch_assoc($result_set2)) {
    $region_list .="<option value=\"{$result3['region_code']}\">{$result3['region_name']}</option>"; 
}


?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Territory</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
  </head>
  <body>
    
    <div class="row">
        <div class="col-md-4 offset-md-4 form-div">
            <form action="<?php echo($_SERVER["PHP_SELF"]);?>" method="POST">
                <div align="center">
                    <h3>ADD TERRITORY</h3>
                </div></br>

                <div align="left">
                    <label>Zone</label>
                    <select name="zone_long_description" id="">
                        <option value="">Select</option>
                        <?php echo $zone_list; ?>
                    </select>
                </div></br>

                <div align="left">
                    <label>Region</label>
                    <select name="region_name" id="">
                        <option value="">Select</option>
                        <?php echo $region_list; ?>
                    </select>
                </div></br>

                <div align="left">
                    <label>Territory Code</label>
                    <input type="text" class="form-control" name="t_code" id="t_code" style="color:brown" value="<?php echo $territory_code; ?>" readonly>
                </div>

                <div align="left">
                    <label>Territory Name</label>
                    <input type="text" class="form-control" name="territory_name" id="territory_name">
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