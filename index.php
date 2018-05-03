<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Ingredients</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
	</head>
    <body>
        <div class="container">
			<h1>Ingredients</h1>
			<?php
				// setup the autoloading
				require_once 'FST/vendor/autoload.php';
				// setup Propel
				require_once 'FST/generated-conf/config.php';
				use Propel\Runtime\Propel;

				if(!isset($_POST['update']) && isset($_POST['description'])){
					$sql = "SELECT MAX(ingredient_id) AS maxid FROM ingredient;"; 
					$conn = Propel::getConnection();
					$st = $conn->prepare($sql);
					$st->execute();
					$results = $st->fetchAll(PDO::FETCH_ASSOC);

					$ingredient = new Ingredient();
					$ingredient->setIngredientId($results[0]['maxid']+1);
					$ingredient->setDescription($_POST['description']);
					$ingredient->setPrice($_POST['price']);
					$ingredient->save(); 
				} 
				if(isset($_POST['update'])){
					$ingredient = IngredientQuery::create()->findOneByIngredientId($_POST['update']);
					$ingredient->setDescription($_POST['description']);
					$ingredient->setPrice($_POST['price']);
					$ingredient->save();
				}
				
			?>
			<table class="table table-striped">
				<thead>
					<tr>
						<th scope="col">#</th>
						<th scope="col">Description</th>
						<th scope="col">Price [€]</th>
						<th scope="col">Action</th>
					</tr>
				</thead>
				<tbody>
				<?php
					$ingredients = IngredientQuery::create()->find();
					foreach($ingredients as $ingredient) {
					  echo "<tr><td>".$ingredient->getIngredientId()."</td><td>".$ingredient->getDescription()."</td><td>".$ingredient->getPrice()."</td><td><a href='InsertUpdate.php?id=".$ingredient->getIngredientId()."'>Edit</a><a href='Delete.php?id=".$ingredient->getIngredientId()."' style='padding-left:1em'>Delete</a></td></tr>";
					}					
					
				?>
				</tbody>
			</table>
			<a href="InsertUpdate.php">New ingredient</a>
		</div>
	</body>
</html>