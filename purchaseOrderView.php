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
//Download as excel sheet
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$query = "SELECT region_name,territory_name,distributor,po_no,date FROM addpurchaseorder";
$result_set = mysqli_query($conn,$query);

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

$sheet->setCellValue('A17','RIGION');
$sheet->setCellValue('B17','TERRITORY');
$sheet->setCellValue('C17','DISTRIBUTOR');
$sheet->setCellValue('D17','PO NUMBER');
$sheet->setCellValue('E17','DATE');
$sheet->setCellValue('F17','TIME');
$sheet->setCellValue('G17','TOTAL AMOUNT');

$ro = 0;

while ($result = mysqli_fetch_assoc($result_set)){
    $sheet->setCellValue('A2'. $ro,$result['region_name']);
    $sheet->setCellValue('B2'. $ro,$result['territory_name']);
    $sheet->setCellValue('C2'. $ro,$result['distributor']);
    $sheet->setCellValue('D2'. $ro,$result['po_no']);
    $sheet->setCellValue('E2'. $ro,$result['date']); 
    $ro++;
}
$writer = new Xlsx($spreadsheet);
$writer->save('productList.xlsx');
?>


<?php
//Filter date
if(isset($_POST['fdate']) && isset($_POST['tdate']))
{
    $from_date = $_POST['fdate'];
    $to_date = $_POST['tdate'];
    
    $query6 = "SELECT region_name,territory_name,distributor,po_no,date FROM addpurchaseorder BETWEEN '$from_date' AND '$to_date' ";
    $query_run1 = mysqli_query($conn,$query6);

    if(mysqli_num_rows($query_run1) > 0)
    {
        foreach($query_run1 as $row)
        {
            ?>
            <tr>
            <td><?=$row['region_name'] ;?></td>
            <td><?=$row['territory_name'] ;?></td>
            <td><?=$row['distributor'] ;?></td>
            <td><?=$row['po_no'] ;?></td>
            <td><?=$row['date'] ;?></td>
            <td></td>
            <td></td>

            </tr>
            <?php
        }  
    }
    else
    {
        echo "No Record Found";
    }
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
                    <h3>PURCHASE ORDER VIEW</h3>
                </div></br>

                

   


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

                    <label>PO No</label>
                    <input type="text"  name="po_no" id="code">

                    <label>From</label>
                    <input type="date" name="fdate" id="fdate">

                    <label>TO</label>
                    <input type="date" name="tdate" id="tdate">

</br></br>

                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>REGION</th>
                                    <th>TERRITORY</th>
                                    <th>DISTRIBUTOR</th>
                                    <th>PO NUMBER</th>
                                    <th>DATE</th>
                                    <th>TIME</th>
                                    <th>TOTAL AMOUNT</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $query = "SELECT * FROM addpurchaseorder";
                                    $query_run = mysqli_query($conn,$query);

                                    if(mysqli_num_rows($query_run)>0){
                                        foreach($query_run as $purchase_order)
                                        {
                                            //echo $zone['zone_code'];
                                            ?>
                                            <tr>
                                                <td><?=$purchase_order['region_name'] ;?></td>
                                                <td><?=$purchase_order['territory_name'] ;?></td>
                                                <td><?=$purchase_order['distributor'] ;?></td>
                                                <td><?=$purchase_order['po_no'] ;?></td>
                                                <td><?=$purchase_order['date'] ;?></td>
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

                    </div>




</br>

                <div align="center">
                    <a href="ProductList.xlsx" download="">Click Here Download As Excel</a>
                </div>

            </form>
        </div>
    </div>
    
  </body>
</html>