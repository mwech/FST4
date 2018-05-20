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
/*
	$ingredient = IngredientQuery::create()->findOneByIngredientId($_POST['updateid']);
	$ingredient->setDescription($_POST['description']);
	$ingredient->setPrice($_POST['price']);
	echo $_POST['available'];
	$ingredient->setIngAvailable(strval($_POST['available']));
	$ingredient->save();
	*/	
	
	$sql = "UPDATE ingredient SET price = ".$_POST['price'].",ing_available=".$_POST['available'].",description='".$_POST['description']."' WHERE ingredient_id ='".$_POST['updateid']."';";
	echo $sql;
	$conn = Propel::getConnection();
	$st = $conn->prepare($sql);
	$st->execute();
	header("Location: ../ingredient-site.php");
	exit();
}




?>