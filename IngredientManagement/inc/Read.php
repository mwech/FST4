<?php
// setup the autoloading
require_once '../Shared/Propel/vendor/autoload.php';
// setup Propel
require_once '../Shared/Propel/generated-conf/config.php';

$ingredients = IngredientQuery::create()->find();
foreach($ingredients as $ingredient) {
	echo "<tr><td>".$ingredient->getIngredientId()."</td><td>".$ingredient->getDescription()."</td><td>".$ingredient->getPrice()."</td><td><a href='ingredient-form.php?id=".$ingredient->getIngredientId()."'>Edit</a><a href='inc/Delete.php?id=".$ingredient->getIngredientId()."' style='padding-left:1em'>Delete</a></td></tr>";
}
?>