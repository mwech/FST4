<?php
// setup the autoloading
require_once '../../Shared/Propel/vendor/autoload.php';
// setup Propel
require_once '../../Shared/Propel/generated-conf/config.php';
use Propel\Runtime\Propel;

ini_set('display_errors', 1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);

if(isset($_POST['description']) && isset($_POST['price'])&& isset($_POST['updateid'])){	
	
	$sql = "UPDATE package SET price = ".$_POST['price'].",pack_active=".$_POST['active'].",description='".$_POST['description']."' WHERE package_id ='".$_POST['updateid']."';";
	echo $sql;
	$conn = Propel::getConnection();
	$st = $conn->prepare($sql);
	$st->execute();
	header("Location: ../package-site.php");
	exit();
}




?>