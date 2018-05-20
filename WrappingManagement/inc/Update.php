<?php
// setup the autoloading
require_once '../../Shared/Propel/vendor/autoload.php';
// setup Propel
require_once '../../Shared/Propel/generated-conf/config.php';

if(isset($_POST['description']) && isset($_POST['price'])&& isset($_POST['updateid'])){	
	$wrapping = ArticleQuery::create()->findOneByArticleId($_POST['updateid']);
	
	$wrapping->setDescription($_POST['description']);
	$wrapping->setPrice($_POST['price']);
	$wrapping->setVisible($_POST['visible']);
	$wrapping->setCreation($_POST['creation']);
	$wrapping->setShapeId($_POST['shape']);
	
	$wrapping->save();
	header("Location: ../wrapping-site.php");
	exit();
}



?>