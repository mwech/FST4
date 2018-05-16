<?php
// setup the autoloading
require_once '../../Shared/Propel/vendor/autoload.php';
// setup Propel
require_once '../../Shared/Propel/generated-conf/config.php';
require_once '../../Shared/GuidGenerator.php';
use Propel\Runtime\Propel;

if(isset($_POST['description']) && isset($_POST['price'])){
	$ingredient = new Ingredient();
	$ingredient->setIngredientId(guidv4());
	$ingredient->setDescription($_POST['description']);
	$ingredient->setPrice($_POST['price']);
	$ingredient->save(); 
}

header("Location: ../ingredient-site.php");
exit();


?>