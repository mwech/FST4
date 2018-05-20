<?php
// setup the autoloading
require_once '../../Shared/Propel/vendor/autoload.php';
// setup Propel
require_once '../../Shared/Propel/generated-conf/config.php';
require_once '../../Shared/GuidGenerator.php';
use Propel\Runtime\Propel;


if(isset($_POST['description'])&& isset($_POST['price'])){

/*
	$ingredient = new Ingredient();
	$ingredient->setIngredientId(guidv4());
	$ingredient->setDescription($_POST['description']);
	$ingredient->setPrice($_POST['price']);
	$ingredient->setIngAvailable($_POST['available']);
	$ingredient->save(); 
*/

	$sql = "INSERT INTO ingredient VALUES('".guidv4()."','".$_POST['description']."',".$_POST['price'].",".$_POST['available'].");";
	$conn = Propel::getConnection();
	$st = $conn->prepare($sql);
	$st->execute();
}
header("Location: ../ingredient-site.php");
exit();

?>