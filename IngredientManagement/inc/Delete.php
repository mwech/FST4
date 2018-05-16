<?php
// setup the autoloading
require_once '../../Shared/Propel/vendor/autoload.php';
// setup Propel
require_once '../../Shared/Propel/generated-conf/config.php';

if(isset($_GET['id'])){
	$ingredient = IngredientQuery::create()->findOneByIngredientId($_GET['id']);
	$ingredient->delete();
	header("Location: ../ingredient-site.php");
	exit();
}
?>