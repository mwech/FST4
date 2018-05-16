<?php
if (session_status() == PHP_SESSION_NONE) {session_start();}
// setup the autoloading
require_once '../../Shared/Propel/vendor/autoload.php';
// setup Propel
require_once '../../Shared/Propel/generated-conf/config.php';


if(isset($_POST['description']) && isset($_POST['price'])&& isset($_POST['updateid'])){	
	$ingredient = IngredientQuery::create()->findOneByIngredientId($_POST['updateid']);
	$ingredient->setDescription($_POST['description']);
	$ingredient->setPrice($_POST['price']);
	$ingredient->save();
	session_destroy(); 
	header("Location: ../ingredient-site.php");
	exit();
}



?>