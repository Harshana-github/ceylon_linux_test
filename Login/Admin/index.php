<?php 
require_once 'controllers/authController.php'; 
$status = '';
// verify the user using token
if (isset($_GET['token'])) {
    $token = $_GET['token'];
    verifyUser($token);
}

// verify the user using token
if (isset($_GET['password-token'])) {
    $passwordToken = $_GET['password-token'];
    resetPassword($passwordToken);
}

if (!isset($_SESSION['id'])) {
    header('location: login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap 4 CSS -->
    
    <link rel="stylesheet" href="style1.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/style.css">
    

    <title></title>
</head>
<body>
    
<div class="banner">

<?php echo $status; ?>

<?php if(isset($_SESSION['message'])): ?>
    <div class="alert <?php echo $_SESSION['alert-class']; ?>">
        <?php 
            echo $_SESSION['message']; 
            unset($_SESSION['message']);
            unset($_SESSION['alert-class']);
        ?>
    </div>
    <?php endif; ?>
    <img src="../../Images/logo_transparent.png" class="logo"> 
	<div class="navbar">
		

		<ul>

			<li><a href="../../dashbord/zoneDashbord.php">Zone</a></li>
			<li><a href="../../dashbord/regionDashbord.php">Region</a></li>
			<li><a href="../../dashbord/territoryDashbord.php">Territory</a></li>
			<li><a href="../../user.php">User Registration</a></li>
            <li><a href="../../product.php">Product Registration</a></li>
            <li><a href="../../purchaseOrderView.php">PURCHASE ORDER VIEW</a></li>
		</ul>
	</div>



	<div class="content"> </br></br></br>
		<h1>WELCOME , <?php echo $_SESSION['username']; ?></h1>

		
		<div>
            <a href="index.php?logout=1" class="logout"><button type="button"><span></span>Logout</button></a>
			<?php if($_SESSION['verified']): ?><a href="http://localhost/phpmyadmin/db_structure.php?server=1&db=e-solution"><button type="button"><span></span>Go to database</button></a><?php endif; ?>

		</div>
	</div>
	
</div>

</body>
</html>