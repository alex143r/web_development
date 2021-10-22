<?php
// Show products from your partner in this file
// open the shop.txt file - this gives you text that looks like an array that looks like json objects in it
// json_decode -> loop
$data = file_get_contents('shop.txt');
$jData = json_decode($data);


// Convert text into an ASSOCIATIVE ARRAY
// $array_assoc_items = json_decode($data, true);
// foreach( $array_assoc_items as $assoc_item ){
//   echo "<div>".$assoc_item["title"]."</div>";
//   echo "<div>".$assoc_item["price"]."</div>";
// }

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    foreach ($jData as $item) {
        echo
        "<div>
        <p> $item->title </p>
        <p> $item->price </p>
        </div>";
    }
    ?>

</body>

</html>