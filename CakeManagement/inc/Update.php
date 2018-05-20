<?php
// setup the autoloading
require_once '../../Shared/Propel/vendor/autoload.php';
// setup Propel
require_once '../../Shared/Propel/generated-conf/config.php';

if(isset($_POST['description']) && isset($_POST['price'])&& isset($_POST['updateid'])){	
	$cake = ArticleQuery::create()->findOneByArticleId($_POST['updateid']);
	$cake->setDescription($_POST['description']);
	$cake->setPrice($_POST['price']);
	$cake->setVisible($_POST['visible']);
	$cake->setCreation($_POST['creation']);
	$cake->setShapeId($_POST['shape']);
	$cake->save();
	
	$articles = ArticleHasIngredientQuery::create()
					->filterByArticleId($_POST['updateid'])
					->find();
	foreach($articles as $article){
		$article->delete();
	}
	
	foreach($_POST['ingredients'] as $ingredient){
		$ai = new ArticleHasIngredient();
		$ai->setArticleId($_POST['updateid']);
		$ai->setIngredientId($ingredient);
		$ai->setAmount(null);
		$ai->save();
	}
	
	header("Location: ../cake-site.php");
	exit();
}



?>