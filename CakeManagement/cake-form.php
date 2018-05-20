<?php 
// setup the autoloading
require_once '../Shared/Propel/vendor/autoload.php';
// setup Propel
require_once '../Shared/Propel/generated-conf/config.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Cake input</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
	</head>
    <body>
        <div class="container"> 
			<?php
				if(isset($_GET["id"])){
					$cakeToUpdate = ArticleQuery::create()
									->filterByArticleId($_GET["id"])
									->findOne();	
					echo "<h1>Edit cake</h1><form method='post' action='inc/Update.php'>";					
				} else {
					echo "<h1>New cake</h1><form method='post' action='inc/Create.php'>";
				}
			?>
				<div class="form-group">
					<div class="col-sm-3">
						<label for="description" class="control-label">Description</label>
					</div>
					<div class="col-sm-9">
						<input type="text" name="description" class="form-control" value="<?php if(isset($_GET["id"])){ echo $cakeToUpdate->getDescription();}?>" required>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-3">
						<label for="price" class="control-label">Price</label>
					</div>
					<div class="col-sm-9">
						<input type="text" name="price" class="form-control" value="<?php if(isset($_GET["id"])){ echo $cakeToUpdate->getPrice();}?>" required>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-3">
						<label for="creation" class="control-label">Creation</label>
					</div>
					<div class="col-sm-9">
						<select name="creation">
							<option value="0" <?php if(isset($_GET["id"])){ if($cakeToUpdate->getCreation()==0)echo "selected";}?> > nein </option>
							<option value="1" <?php if(isset($_GET["id"])){ if($cakeToUpdate->getCreation()==1)echo "selected";}?> > ja </option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-3">
						<label for="visible" class="control-label">Visible</label>
					</div>
					<div class="col-sm-9">
						<select name="visible">
							<option value="0" <?php if(isset($_GET["id"])){ if($cakeToUpdate->getVisible()==0)echo "selected";}?> > nein </option>
							<option value="1" <?php if(isset($_GET["id"])){ if($cakeToUpdate->getVisible()==1)echo "selected";}?> > ja </option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-3">
						<label for="shape" class="control-label">Shape</label>
					</div>
					<div class="col-sm-9">
						<select name="shape">
							<?php 
								$shape = ShapeQuery::create()->findOneByDescription('Quadrat'); $quadrat = $shape->getShapeId();
								$shape = ShapeQuery::create()->findOneByDescription('Kreis'); $kreis = $shape->getShapeId();
								$shape = ShapeQuery::create()->findOneByDescription('Rechteck'); $rechteck = $shape->getShapeId();
							?>
							<option value="<?php echo $quadrat; ?>"  <?php if(isset($_GET["id"])){ if($cakeToUpdate->getShapeId()==$quadrat) echo "selected"; }?> > Quadrat </option>
							<option value="<?php echo $kreis; ?>"  <?php if(isset($_GET["id"])){ if($cakeToUpdate->getShapeId()==$kreis) echo "selected"; }?> > Kreis </option>
							<option value="<?php echo $rechteck; ?>"  <?php if(isset($_GET["id"])){ if($cakeToUpdate->getShapeId()==$rechteck) echo "selected"; }?> > Rechteck </option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<button type="submit" name="submit" class="btn btn-default">Submit</button>
					</div>
				</div>
				<input type="hidden" name="updateid" value="<?php if(isset($_GET["id"])){ echo $cakeToUpdate->getArticleId();}?>">
			</form>
			<a href="cake-site.php">Back to cake overview</a>
		</div>
	</body>
</html>