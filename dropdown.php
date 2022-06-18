<?php
    //Database connection 
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "purchase_order_bulk_conversion";
    $conn = mysqli_connect($servername,$username,$password,$dbname);

    $query = "SELECT zone_code,zone_long_description FROM zone";

    $result_set = mysqli_query($conn,$query);

    $zone_list = '';

    while ($result = mysqli_fetch_assoc($result_set)) {
        $zone_list .="<option value=\"{$result['zone_code']}\">{$result['zone_code']}</option>"; 
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Drop Down List with Select Tag</title>
</head>
<body>
    <form action="" method="post">
        <label for="">Select The Subject:</lable>
        <select name="zone_code" id="">
            <?php echo $zone_list; ?>
        </select>
        <button type="submit" name="save_btn">Save</button>
    </form>
</body>
</html>