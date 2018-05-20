<?php
// setup the autoloading
require_once '../../Shared/Propel/vendor/autoload.php';
// setup Propel
require_once '../../Shared/Propel/generated-conf/config.php';

if(isset($_GET['id'])){
	$wrapping = ArticleQuery::create()->findOneByArticleId($_GET['id']);
	$wrapping->delete();
	header("Location: ../wrapping-site.php");
	exit();
}
?>