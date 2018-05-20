<?php 
// setup the autoloading
require_once '../Shared/Propel/vendor/autoload.php';
// setup Propel
require_once '../Shared/Propel/generated-conf/config.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Package input</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
	</head>
    <body>
        <div class="container"> 
			<?php
				if(isset($_GET["id"])){
					$packageToUpdate = PackageQuery::create()
									->filterByPackageId($_GET["id"])
									->findOne();	
					echo "<h1>Edit package</h1><form method='post' action='inc/Update.php'>";					
				} else {
					echo "<h1>New package</h1><form method='post' action='inc/Create.php'>";
				}
			?>
				<div class="form-group">
					<div class="col-sm-3">
						<label for="description" class="control-label">Description</label>
					</div>
					<div class="col-sm-9">
						<input type="text" name="description" class="form-control" value="<?php if(isset($_GET["id"])){ echo $packageToUpdate->getDescription();}?>" required>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-3">
						<label for="price" class="control-label">Price</label>
					</div>
					<div class="col-sm-9">
						<input type="text" name="price" class="form-control" value="<?php if(isset($_GET["id"])){ echo $packageToUpdate->getPrice();}?>" required>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-3">
						<label for="active" class="control-label">Active</label>
					</div>
					<div class="col-sm-9">
						<select name="active">
							<option value="0" <?php if(isset($_GET["id"])){ if($packageToUpdate->getPackActive()==0)echo "selected";}?> > nein </option>
							<option value="1" <?php if(isset($_GET["id"])){ if($packageToUpdate->getPackActive()==1)echo "selected";}?> > ja </option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-3">
						<label for="articles[]" class="control-label">Articles</label>
					</div>
					<div class="col-sm-10">
					<?php
						$articles = ArticleQuery::create()->find();
						foreach($articles as $article) {
					?>
						<label class="checkbox-inline"><input type="checkbox" name="articles[]" value="<?php echo $article->getArticleId();?>" 
						<?php 
						//check if article is in package
							if(isset($_GET["id"])){
								$packages = PackageHasArticlesQuery::create()
								  ->filterByPackageId($_GET["id"])
								  ->find();
								foreach($packages as $package){
									if($package->getArticleId() == $article->getArticleId()) echo "checked";
								} 
							}
						?>> <?php echo $article->getDescription(); ?> </label>
					<?php
						}
					?>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<button type="submit" name="submit" class="btn btn-default">Submit</button>
					</div>
				</div>
				<input type="hidden" name="updateid" value="<?php if(isset($_GET["id"])){ echo $packageToUpdate->getPackageId();}?>">
			</form>
			<a href="package-site.php">Back to packages overview</a>
		</div>
	</body>
</html>