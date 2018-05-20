<?php
// setup the autoloading
require_once '../Shared/Propel/vendor/autoload.php';
// setup Propel
require_once '../Shared/Propel/generated-conf/config.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);

//Only select wrappings (not cakes or packages) from all articles

$articleType = ArticleTypeQuery::create()
  ->filterByDescription('Verpackung')
  ->findOne();

$wrappings = ArticleQuery::create()
  ->filterByArticleTypeId($articleType->getArticleTypeId())
  ->find();
  
$cnt = 1;
foreach($wrappings as $wrapping) {	
	$shape = ShapeQuery::create()->findPK($wrapping->getShapeId());

/**	$isCreation = $wrapping->getCreation();
	$isCreationString = "error";
	if($isCreation == 0){
		$isCreationString = "Nein"
	}else{
		$isCreationString = "Ja"
	}
	
	$isVisible = $wrapping->getVisible();
	$isVisibleString = "error";
	if($isVisible == 0){
		$isVisibleString = "Nein"
	}else{
		$isVisibleString = "Ja"
	}
**/	
	echo "<tr>
			<td>$cnt</td>
			<td>".utf8_encode($wrapping->getDescription())."</td>
			<td>".$wrapping->getPrice()."</td>
			<td>".$wrapping->getCreation()."</td>
			<td>".$wrapping->getVisible()."</td>
			<td>".$shape->getDescription()."</td>
			<td>
				<a href='wrapping-form.php?id=".$wrapping->getArticleId()."'>Edit</a>
				<a href='inc/Delete.php?id=".$wrapping->getArticleId()."' style='padding-left:1em'>Delete</a>
			</td>
		</tr>";
	$cnt++;
}
?>