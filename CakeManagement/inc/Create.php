<?php
// setup the autoloading
require_once '../../Shared/Propel/vendor/autoload.php';
// setup Propel
require_once '../../Shared/Propel/generated-conf/config.php';
require_once '../../Shared/GuidGenerator.php';
use Propel\Runtime\Propel;

if(isset($_POST['description']) && isset($_POST['price'])){
	
	$cakeid = guidv4();
	
	$cake = new Article();
	$cake->setArticleId($cakeid);
	$cake->setDescription($_POST['description']);
	$cake->setPrice($_POST['price']);
	$cake->setVisible($_POST['visible']);
	$cake->setCreation($_POST['creation']);
	$cake->setShapeId($_POST['shape']);
	
	$articleType = ArticleTypeQuery::create()
	  ->filterByDescription('Kuchen')
	  ->findOne();
	$cake->setArticleTypeId($articleType->getArticleTypeId());
	
	$cake->save(); 
	
	foreach($_POST['ingredients'] as $ingredient){
		$ai = new ArticleHasIngredient();
		$ai->setArticleId($cakeid);
		$ai->setIngredientId($ingredient);
		$ai->setAmount(null);
		$ai->save();
	}
}

header("Location: ../cake-site.php");
exit();


?>