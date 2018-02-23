<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
	require_once('admin/phpscripts/config.php');
	// echo $_GET['id'];
if(isset($_GET['id'])) {
	$table = "tbl_movies";
	$column = "movies_id";
	$id = $_GET['id'];
	$getMovie = getSingle($table, $column, $id);
	// echo $getMovie;
	
}
	
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Details</title>
</head>
<body>	
<?php
 if(!is_string($getMovie)){
 	$row = mysqli_fetch_array($getMovie);
 	echo "<img src=\"images/{$row['movies_cover']}\" alt=\"{$row['movies_title']}\">
 		<h2>{$row['movies_title']}</h2>
 		<p>{$row['movies_year']}</p>
 		<p>{$row['movies_storyline']}</p>
 		<a href=\"index.php\">Back to All Movies</a>"; 

 }else {
 	echo "<p>{$getMovie}</p>";
 }



?>
</body>
</html>