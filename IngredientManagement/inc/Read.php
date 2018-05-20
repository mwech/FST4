<?php
// setup the autoloading
require_once '../Shared/Propel/vendor/autoload.php';
// setup Propel
require_once '../Shared/Propel/generated-conf/config.php';

$ingredients = IngredientQuery::create()->find();
$cnt = 1;
foreach($ingredients as $ingredient) {
	echo "<tr><td>$cnt</td><td>".utf8_encode($ingredient->getDescription())."</td><td>".$ingredient->getPrice()."</td><td>".(($ingredient->getIngAvailable()==1)?'ja':'nein')."</td><td><a href='ingredient-form.php?id=".$ingredient->getIngredientId()."'>Edit</a><a href='inc/Delete.php?id=".$ingredient->getIngredientId()."' style='padding-left:1em'>Delete</a></td></tr>";
	$cnt++;
}
?>