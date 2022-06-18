<?php
    //Database connection 
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "purchase_order_bulk_conversion";
    $conn = mysqli_connect($servername,$username,$password,$dbname);
    $sql6 = "select zone_name from zone";
    $res = mysqli_query($conn,$sql6);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    Select Mobile :
    <select>
        <?php while($rows = mysqli_fetch_array($res)){
            ?>
            <option value="<?php echo $rows['zone_name']; ?>"><?php echo $rows['zone_name'];?></option>
        <?php
        }
        ?>
    </select>
</body>
</html>