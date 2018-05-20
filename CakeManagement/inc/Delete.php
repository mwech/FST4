<?php
// setup the autoloading
require_once '../../Shared/Propel/vendor/autoload.php';
// setup Propel
require_once '../../Shared/Propel/generated-conf/config.php';

if(isset($_GET['id'])){
	$cake = ArticleQuery::create()->findOneByArticleId($_GET['id']);
	$cake->delete();
	header("Location: ../cake-site.php");
	exit();
}
?>