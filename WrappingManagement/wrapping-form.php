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
        <title>Wrapping input</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
	</head>
    <body>
        <div class="container"> 
			<?php
				if(isset($_GET["id"])){
					$wrappingToUpdate = ArticleQuery::create()
									->filterByArticleId($_GET["id"])
									->findOne();	
					echo "<h1>Edit wrapping</h1><form method='post' action='inc/Update.php'>";					
				} else {
					echo "<h1>New wrapping</h1><form method='post' action='inc/Create.php'>";
				}
			?>
				<div class="form-group">
					<div class="col-sm-3">
						<label for="description" class="control-label">Description</label>
					</div>
					<div class="col-sm-9">
						<input type="text" name="description" class="form-control" value="<?php if(isset($_GET["id"])){ echo $wrappingToUpdate->getDescription();}?>" required>
					</div>
				</div>
				
				<div class="form-group">
					<div class="col-sm-3">
						<label for="price" class="control-label">Price</label>
					</div>
					<div class="col-sm-9">
						<input type="text" name="price" class="form-control" value="<?php if(isset($_GET["id"])){ echo $wrappingToUpdate->getPrice();}?>" required>
					</div>
				</div>
				
				<div class="form-group">
					<div class="col-sm-3">
						<label for="creation" class="control-label">Creation</label>
					</div>
					<div class="col-sm-9">
						<select name="creation">
							<option value="0" <?php if(isset($_GET["id"])){ if($wrappingToUpdate->getCreation()==0)echo "selected";}?> > Nein </option>
							<option value="1" <?php if(isset($_GET["id"])){ if($wrappingToUpdate->getCreation()==1)echo "selected";}?> > Ja </option>
						</select>
					</div>
				</div>
				
				<div class="form-group">
					<div class="col-sm-3">
						<label for="visible" class="control-label">Visible</label>
					</div>
					<div class="col-sm-9">
						<select name="visible">
							<option value="0" <?php if(isset($_GET["id"])){ if($wrappingToUpdate->getVisible()==0)echo "selected";}?> > Nein </option>
							<option value="1" <?php if(isset($_GET["id"])){ if($wrappingToUpdate->getVisible()==1)echo "selected";}?> > Ja </option>
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
							<option value="<?php echo $quadrat; ?>"  <?php if(isset($_GET["id"])){ if($wrappingToUpdate->getShapeId()==$quadrat) echo "selected"; }?> > Quadrat </option>
							<option value="<?php echo $kreis; ?>"  <?php if(isset($_GET["id"])){ if($wrappingToUpdate->getShapeId()==$kreis) echo "selected"; }?> > Kreis </option>
							<option value="<?php echo $rechteck; ?>"  <?php if(isset($_GET["id"])){ if($wrappingToUpdate->getShapeId()==$rechteck) echo "selected"; }?> > Rechteck </option>
						</select>
					</div>
				</div>
				
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<button type="submit" name="submit" class="btn btn-default">Submit</button>
					</div>
				</div>
				
				<input type="hidden" name="updateid" value="<?php if(isset($_GET["id"])){ echo $wrappingToUpdate->getArticleId();}?>">
			</form>
			<a href="wrapping-site.php">Back to cake overview</a>
		</div>
	</body>
</html>