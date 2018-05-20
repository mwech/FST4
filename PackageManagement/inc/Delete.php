<?php
// setup the autoloading
require_once '../../Shared/Propel/vendor/autoload.php';
// setup Propel
require_once '../../Shared/Propel/generated-conf/config.php';

if(isset($_GET['id'])){
	
	$packages = PackageHasArticlesQuery::create()
					->filterByPackageId($_GET['id'])
					->find();
	foreach($packages as $package){
		$package->delete();
	}
	
	$package = PackageQuery::create()->findOneByPackageId($_GET['id']);
	$package->delete();
	header("Location: ../package-site.php");
	exit();
}
?>