<?php
// setup the autoloading
require_once '../Shared/Propel/vendor/autoload.php';
// setup Propel
require_once '../Shared/Propel/generated-conf/config.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);

//Only select cakes (not wrappings or packages) from all articles

$articleType = ArticleTypeQuery::create()
  ->filterByDescription('Kuchen')
  ->findOne();

$cakes = ArticleQuery::create()
  ->filterByArticleTypeId($articleType->getArticleTypeId())
  ->find();
  
$cnt = 1;
foreach($cakes as $cake) {	
	$shape = ShapeQuery::create()->findPK($cake->getShapeId());
	echo "<tr><td>$cnt</td><td>".utf8_encode($cake->getDescription())."</td><td>".$cake->getPrice()."</td><td>".(($cake->getCreation()==1)?"ja":"nein")."</td><td>".(($cake->getVisible()==1)?"ja":"nein")."</td><td>".$shape->getDescription()."</td><td><a href='cake-form.php?id=".$cake->getArticleId()."'>Edit</a><a href='inc/Delete.php?id=".$cake->getArticleId()."' style='padding-left:1em'>Delete</a></td></tr>";
	$cnt++;
}
?>