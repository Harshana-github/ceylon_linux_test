<?php
    //Database connection 
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "purchase_order_bulk_conversion";
    $conn = mysqli_connect($servername,$username,$password,$dbname);
?>

<?php
    //Code autogenerate zone_code
    $query = "select * from zone order by zone_code desc limit 1";
    $result = mysqli_query($conn,$query);
    $row = mysqli_fetch_array($result);
    $lastid = $row['zone_code'];
    if($lastid == "")
    {
        $zone_code = "ZONE1";
    }
    else
    {
        $zone_code = substr($lastid,4);
        $zone_code = intval($zone_code);
        $zone_code = "ZONE" . ($zone_code + 1);
    }

?>

<?php
    //Add data in to the database
    if($_SERVER["REQUEST_METHOD"]=="POST")
    {
        $zone_code = $_POST['code'];
        $zone_long_description = $_POST['long_description'];
        $zone_short_description = $_POST['short_description'];

        if(!$conn)
        {
            die("connection faild " . mysqli_connect_error());
        }
        else
        {
            $sql = "insert into zone(zone_code,zone_long_description,zone_description)VALUES('$zone_code','$zone_long_description','$zone_short_description')";
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

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Zone Edit</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
  </head>
  <body>

    <div class="row">
        <div class="col-md-4 offset-md-4 form-div login">

           

            <form action="<?php echo($_SERVER["PHP_SELF"]);?>" method="POST">
                <div class="card-header">
                    <h4 align="center">EDIT ZONE
                        <a href="zoneDashbord.php" class="btn btn-danger float-end">BACK</a>

                    </h4>
                </div>

                <div align="left">
                    <label>Zone code</label>
                    <input type="text" class="form-control" name="code" id="code" style="color:brown" value="<?php echo $zone_code; ?>">
                </div>

                <div align="left">
                    <label>Zone Long Description</label>
                    <input type="text" class="form-control" name="long_description" id="long_description">
                </div>

                <div align="left">
                    <label>Short Description</label>
                    <input type="text" class="form-control" name="short_description" id="short_description">
                </div>

</br>

                <div align="center">
                    <input type="submit" value="EDIT ZONE" class="btn btn-success">

                </div>

            </form>
        </div>
    </div>

  </body>
</html>