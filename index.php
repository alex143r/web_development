<?php
require_once('dictionary.php');
$lan = $_GET['lan'] ?? 'en';
$_title = $text[2][$lan];
require_once('components/header.php');


?>

<?php
?>
<h1><?= $text[1][$lan] ?></h1>


<?php require_once('components/footer.php');
