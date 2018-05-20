<?php
// setup the autoloading
require_once '../../Shared/Propel/vendor/autoload.php';
// setup Propel
require_once '../../Shared/Propel/generated-conf/config.php';

if(isset($_GET['id'])){
	$package = PackageQuery::create()->findOneByPackageId($_GET['id']);
	$package->delete();
	header("Location: ../package-site.php");
	exit();
}
?>