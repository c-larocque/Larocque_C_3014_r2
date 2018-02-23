<?php
require_once('admin/phpscripts/config.php');
	


if(isset($_GET['filter'])) {
	$table = "tbl_movies";
	$table2 = "tbl_genre";
	$tableLink = "tbl_mov_genre";
	$column = "movies_id";
	$column2 = "genre_id";
	$column3 = "genre_name";
	$filter = $_GET['filter']; //grabs the filter value
	$getMovies = filterType($table, $table2, $tableLink,$column, $column2, $column3, $filter);//new function from the read file

} else {
	$table = "tbl_movies";
	$getMovies = getAll($table);//calls your function with the variable
}



?>


<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Welcome to the Finest Selection of Blu-rays on the internets!</title>
</head>
<body>
<!-- we will use php to write out all the movies from read.php -->
<?php
	include('includes/nav.html');

	echo "<h1>Displaying All {$filter} Movies</h2>";

	if(!is_string($getMovies)){//if this is not a string (which makes it an object)

		while($row = mysqli_fetch_array($getMovies)){
			echo "<img src=\"images/{$row['movies_cover']}\" alt=\"{$row['movies_title']}\"> 
			<h2>{$row['movies_title']}</h2> 
			<p>{$row['movies_year']}</p>
			<a href=\"details.php?id={$row['movies_id']}\">More Details...</a> <br><br>";
		}
	} else {
		echo "<p class=\"error\">{$getMovies}<p>"; //the other slash makes it literal.. literally a quote
	}

	include('includes/footer.html');
?>
</body>
</html>