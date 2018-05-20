<?php
// setup the autoloading
require_once '../../Shared/Propel/vendor/autoload.php';
// setup Propel
require_once '../../Shared/Propel/generated-conf/config.php';
require_once '../../Shared/GuidGenerator.php';
use Propel\Runtime\Propel;


if(isset($_POST['description'])&& isset($_POST['price'])){

	$sql = "INSERT INTO package VALUES('".guidv4()."','".$_POST['description']."',".$_POST['price'].",".$_POST['active'].");";
	$conn = Propel::getConnection();
	$st = $conn->prepare($sql);
	$st->execute();
}
header("Location: ../package-site.php");
exit();

?>