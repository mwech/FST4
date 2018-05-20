<?php
// setup the autoloading
require_once '../Shared/Propel/vendor/autoload.php';
// setup Propel
require_once '../Shared/Propel/generated-conf/config.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);

$packages = PackageQuery::create()->find();
$cnt = 1;
foreach($packages as $package) {
	echo "<tr><td>$cnt</td><td>".utf8_encode($package->getDescription())."</td><td>".$package->getPrice()."</td><td>".(($package->getPackActive()==1)?'ja':'nein')."</td><td><a href='package-form.php?id=".$package->getPackageId()."'>Edit</a><a href='inc/Delete.php?id=".$package->getPackageId()."' style='padding-left:1em'>Delete</a></td></tr>";
	$cnt++;
}
?>