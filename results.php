<head>
<link rel="stylesheet" href="bootstrap-3.0.3-dist/dist/css/bootstrap.min.css" />
</head>

<?php
/**
 * Created by PhpStorm.
 * User: Yen Hoang
 * Date: 1/26/14
 * Time: 8:26 PM
 */

$host = 'itp460.usc.edu';
$dbname = 'dvd';
$user = 'student';
$pass = 'ttrojan';

$pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);

$title = $_GET['title'];

$sql = "SELECT title, rating, genre, format
  FROM dvd_titles
  INNER JOIN ratings
  ON dvd_titles.rating_id = ratings.id
  INNER JOIN genres
  ON dvd_titles.genre_id = genres.id
  INNER JOIN formats
  ON dvd_titles.format_id = formats.id
  WHERE title LIKE ?
";

$statement = $pdo->prepare($sql);

$like = '%'.$title.'%';
$statement->bindParam(1, $like);
$statement->execute();
$dvds = $statement->fetchAll(PDO::FETCH_OBJ);

$num = count($dvds);

?>

<?php
    if($num == 0) {
        echo "<h5> Nothing was found. Go <a href='search.php'>back</a> to try again.<br>";
    }
    else {

        echo "<table class='table'> <th>Title</th><th>Rating</th><th>Genre</th><th>Format</th>";
        foreach ($dvds as $dvd) :

            echo "<tr><td>$dvd->title</td><td>$dvd->rating</td><td>$dvd->genre</td><td>$dvd->format</td></tr>"
?>


<?php endforeach; }

?>


