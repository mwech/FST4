<?php
// setup the autoloading
require_once '../../Shared/Propel/vendor/autoload.php';
// setup Propel
require_once '../../Shared/Propel/generated-conf/config.php';
require_once '../../Shared/GuidGenerator.php';
use Propel\Runtime\Propel;

if(isset($_POST['description']) && isset($_POST['price'])){
	$wrapping = new Article();
	$wrapping->setArticleId(guidv4());
	$wrapping->setDescription($_POST['description']);
	$wrapping->setPrice($_POST['price']);
	$wrapping->setVisible($_POST['visible']);
	$wrapping->setCreation($_POST['creation']);
	$wrapping->setShapeId($_POST['shape']);
	
	$articleType = ArticleTypeQuery::create()
	  ->filterByDescription('Verpackung')
	  ->findOne();
	$wrapping->setArticleTypeId($articleType->getArticleTypeId());
	
	$wrapping->save(); 
}

header("Location: ../wrapping-site.php");
exit();


?>