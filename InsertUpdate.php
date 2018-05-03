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
			// setup the autoloading
			require_once 'FST/vendor/autoload.php';
			// setup Propel
			require_once 'FST/generated-conf/config.php';
			if(isset($_GET['id'])){
				$ingredient = IngredientQuery::create()
				  ->filterByIngredientId($_GET['id'])
				  ->findOne();				 
			}
		?>
			<h1><?php if(isset($_GET['id'])){echo "Edit ";} else { echo "New ";}?>ingredient</h1>
			<form class="form-horizontal" method="post" action="index.php">
				<div class="form-group">
					<div class="col-sm-3">
						<label for="description" class="control-label">Description</label>
					</div>
					<div class="col-sm-9">
						<input type="text" name="description" class="form-control" value="<?php if(isset($_GET['id'])){ echo $ingredient->getDescription();}?>" required>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-3">
						<label for="price" class="control-label">Price</label>
					</div>
					<div class="col-sm-9">
						<input type="text" name="price" class="form-control" value="<?php if(isset($_GET['id'])){ echo $ingredient->getPrice();}?>"  required>
					</div>
				</div>
				<div class="form-group">
				  <div class="col-sm-offset-2 col-sm-10">
					<?php
						if(isset($_GET['id'])){
					?>
						<input type="hidden" name="update" value="<?php echo $_GET['id'];?>">
					<?php
						}
					?>
					<button type="submit" name="submit" class="btn btn-default">Submit</button>
				  </div>
				</div>
			</form>
		</div>
	</body>
</html>