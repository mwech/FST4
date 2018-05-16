<?php 
// setup the autoloading
require_once '../Shared/Propel/vendor/autoload.php';
// setup Propel
require_once '../Shared/Propel/generated-conf/config.php';
if (session_status() == PHP_SESSION_NONE) {session_start();}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Ingredient input</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
	</head>
    <body>
        <div class="container"> 
			<?php
				if(isset($_GET["id"])){
					$ingredientToUpdate = IngredientQuery::create()
									->filterByIngredientId($_GET["id"])
									->findOne();	
					echo "<h1>Edit ingredient</h1><form method='post' action='inc/Update.php'>";					
				} else {
					echo "<h1>New ingredient</h1><form method='post' action='inc/Insert.php'>";
				}
			?>
				<div class="form-group">
					<div class="col-sm-3">
						<label for="description" class="control-label">Description</label>
					</div>
					<div class="col-sm-9">
						<input type="text" name="description" class="form-control" value="<?php if(isset($_GET["id"])){ echo $ingredientToUpdate->getDescription();}?>" required>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-3">
						<label for="price" class="control-label">Price</label>
					</div>
					<div class="col-sm-9">
						<input type="text" name="price" class="form-control" value="<?php if(isset($_GET["id"])){ echo $ingredientToUpdate->getPrice();}?>" required>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<button type="submit" name="submit" class="btn btn-default">Submit</button>
					</div>
				</div>
				<input type="hidden" name="updateid" value="<?php if(isset($_GET["id"])){ echo $ingredientToUpdate->getIngredientId();}?>">
			</form>
			<a href="ingredient-site.php">Back to ingredients overview</a>
		</div>
	</body>
</html>