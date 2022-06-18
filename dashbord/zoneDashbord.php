<?php
    //Database connection 
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "purchase_order_bulk_conversion";
    $conn = mysqli_connect($servername,$username,$password,$dbname);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>

</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Zone Details
                        <a href="../Login/Admin/" class="btn btn-danger float-end">Back to dashbord</a>
                            <a href="../zone.php" class="btn btn-primary float-end">Add zone</a>
                            
                        </h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Zone Code</th>
                                    <th>Zone Long Description</th>
                                    <th>Zone Short Description</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $query = "SELECT * FROM zone";
                                    $query_run = mysqli_query($conn,$query);

                                    if(mysqli_num_rows($query_run)>0){
                                        foreach($query_run as $zone)
                                        {
                                            //echo $zone['zone_code'];
                                            ?>
                                            <tr>
                                                <td><?=$zone['zone_code'] ;?></td>
                                                <td><?=$zone['zone_long_description'] ;?></td>
                                                <td><?=$zone['zone_description'] ;?></td>
                                                <td>
                                                    
                                                    <a href="zoneEdit.php?zone_code<?= $zone['zone_code'];?>" class="btn btn-success btn-sm">Edit</a>
                                                    
                                                </td>
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

                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>