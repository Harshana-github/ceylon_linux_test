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
    $query = "select * from addpurchaseorder order by po_no desc limit 1";
    $result = mysqli_query($conn,$query);
    $row = mysqli_fetch_array($result);
    $lastid = $row['po_no'];
    if($lastid == "")
    {
        $po_no = "TEP1";
    }
    else
    {
        $po_no = substr($lastid,3);
        $po_no = intval($po_no);
        $po_no = "TEP" . ($po_no + 1);
    }
?>

<?php
    //Add data in to the database
    if($_SERVER["REQUEST_METHOD"]=="POST")
    {
        $zone_name = $_POST['zone_long_description'];
        $region_name = $_POST['region_name'];
        $territory_name = $_POST['territory_name'];
        $date = $_POST['date'];
        $po_no = $_POST['po_no'];
        $distributor = $_POST['distributor_list'];
        $remark = $_POST['remark'];


   


        if(!$conn)
        {
            die("connection faild " . mysqli_connect_error());
        }
        else
        {
            $sql = "insert into addpurchaseorder(zone_name,region_name,territory_name,date,po_no,distributor,remark)VALUES('$zone_name','$region_name','$territory_name','$date','$po_no','$distributor','$remark')";
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

<?php
//Pass zone_code to dropdown menu
$query4 = "SELECT territory_code,territory_name FROM territory";

$result_set2 = mysqli_query($conn,$query4);

$territory_list = '';

while ($result3 = mysqli_fetch_assoc($result_set2)) {
    $territory_list .="<option value=\"{$result3['territory_code']}\">{$result3['territory_name']}</option>"; 
}


?>

<?php
//Pass zone_code to dropdown menu
$query5 = "SELECT username,name FROM user";

$result_set3 = mysqli_query($conn,$query5);

$distributor_list = '';

while ($result4 = mysqli_fetch_assoc($result_set3)) {
    $distributor_list .="<option value=\"{$result4['username']}\">{$result4['name']}</option>"; 
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
        <div class="">
            <form action="<?php echo($_SERVER["PHP_SELF"]);?>" method="POST">
                <div align="center">
                    <h3>ADD INDIVIDUAL PURCHASE ORDER</h3>
                </div></br>

                
                    <label>Zone</label>
                    <select name="zone_long_description" id="">
                        <option value="">Select</option>
                        <?php echo $zone_list; ?>
                    </select>
   


                    <label>Region</label>
                    <select name="region_name" id="">
                        <option value="">Select</option>
                        <?php echo $region_list; ?>
                    </select>




                    <label>Territory</label>
                    <select name="territory_name" id="">
                        <option value="">Select</option>
                        <?php echo $territory_list; ?>
                    </select>

                    <label>Distributor</label>
                    <select name="distributor_list" id="">
                        <option value="">Select</option>
                        <?php echo $distributor_list; ?>
                    </select>

                    <label>Date</label>
                    <input type="text" name="date" id="date" value="<?php echo date("Y-m-d")  ;?>" readonly>


                    <label>PO No</label>
                    <input type="text"  name="po_no" id="code" style="color:brown" value="<?php echo $po_no; ?>" readonly>

                    <label>Remark</label>
                    <input type="text"  name="remark" id="code"></br></br>


                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>SKU CODE</th>
                                    <th>SKU NAME</th>
                                    <th>UNIT PRICE</th>
                                    <th>AVB QTY</th>
                                    <th>ENTER QTY</th>
                                    <th>UNITS</th>
                                    <th>TOTAL PRICE</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $query = "SELECT * FROM product";
                                    $query_run = mysqli_query($conn,$query);

                                    if(mysqli_num_rows($query_run)>0){
                                        foreach($query_run as $product)
                                        {
                                            //echo $zone['zone_code'];
                                            ?>
                                            <tr>
                                                <td><?=$product['sku_code'] ;?></td>
                                                <td><?=$product['sku_name'] ;?></td>
                                                <td><?=$product['d_price'] ;?></td>
                                                <td></td>
                                                <td><input type="text" name="enter_qty"></td>
                                                <td></td>
                                                <td></td>

                                            </tr>
                                            <?php
                                        }
                                    }
                                    else
                                    {
                                        echo "<h5> No Record Found </h5>";
                                    }
                                ?>

                            </tbody>
                        </table>




</br>

                <div align="center">
                    <input type="submit" value="ADD PO" class="btn btn-success">
                </div>

            </form>
        </div>
    </div>
    
  </body>
</html>