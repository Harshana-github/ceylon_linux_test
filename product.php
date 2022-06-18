<?php
    //Database connection 
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "purchase_order_bulk_conversion";
    $conn = mysqli_connect($servername,$username,$password,$dbname);
?>

<?php
    //Code autogenerate sku_id
    $query = "select * from product order by sku_id desc limit 1";
    $result = mysqli_query($conn,$query);
    $row = mysqli_fetch_array($result);
    $lastid = $row['sku_id'];
    if($lastid == "")
    {
        $sku_id = "SKU1";
    }
    else
    {
        $sku_id = substr($lastid,3);
        $sku_id = intval($sku_id);
        $sku_id = "SKU" . ($sku_id + 1);
    }

?>

<?php
    //Add data in to the database
    if($_SERVER["REQUEST_METHOD"]=="POST")
    {
        $sku_id = $_POST['sku_id'];
        $sku_code = $_POST['sku_code'];
        $sku_name = $_POST['sku_name'];
        $mrp = $_POST['mrp'];
        $d_price = $_POST['d_price'];
        $weight = $_POST['weight'];

        if(!$conn)
        {
            die("connection faild " . mysqli_connect_error());
        }
        else
        {
            $sql = "insert into product()VALUES('$sku_id','$sku_code','$sku_name','$mrp','$d_price','$weight')";
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
    <title>Zone</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
  </head>
  <body>
    
    <div class="row">
        <div class="col-md-4 offset-md-4 form-div">
            <form action="<?php echo($_SERVER["PHP_SELF"]);?>" method="POST">
                <div align="center">
                    <h3>ADD SKU</h3>
                </div>

                <div align="left">
                    <label>SKU ID</label>
                    <input type="text" class="form-control" name="sku_id" id="sku_id" style="color:brown" value="<?php echo $sku_id; ?>" readonly>
                </div>

                <div align="left">
                    <label>SKU Code</label>
                    <input type="text" class="form-control" name="sku_code" id="sku_code" required>
                </div>

                <div align="left">
                    <label>SKU Name</label>
                    <input type="text" class="form-control" name="sku_name" id="sku_name" required>
                </div>

                <div align="left">
                    <label>MRP</label>
                    <input type="text" class="form-control" name="mrp" id="mrp" required>
                </div>

                <div align="left">
                    <label>Distributor Price</label>
                    <input type="text" class="form-control" name="d_price" id="d_price" required>
                </div>

                <div align="left">
                    <label>Weight/Volume</label>
                    <input type="text" class="form-control" name="weight" id="weight" required>
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