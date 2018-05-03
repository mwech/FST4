<?php
// setup the autoloading
require_once 'FST/vendor/autoload.php';
// setup Propel
require_once 'FST/generated-conf/config.php';
if(isset($_GET['id'])){
	$ingredient = IngredientQuery::create()->findOneByIngredientId($_GET['id']);
	$ingredient->delete();
	header("Location: index.php");
	exit();
}
?>