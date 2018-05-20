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
			<table class="table table-striped">
				<thead>
					<tr>
						<th scope="col">#</th>
						<th scope="col">Description</th>
						<th scope="col">Price [€]</th>
						<th scope="col">Available</th>
						<th scope="col">Action</th>
					</tr>
				</thead>
				<tbody>
				<?php
					include 'inc/Read.php';					
				?>
				</tbody>
			</table>
			<a href="ingredient-form.php">New ingredient</a><a style="margin-left: 50px;" href="../index.php">Back to main menu</a> 
		</div>
	</body>
</html>