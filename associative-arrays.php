<?php
//multidimensional array
$users = [
    ['name' => 'A', 'email' => '@a', 'password' => 'passA'],
    ['name' => 'B', 'email' => '@b', 'password' => 'passB']

];

//associative array
$person = ['name' => 'Alex', 'last_name' => 'Donoso'];
//echo $person['name'].' '.$person['last_name'];
//echo "[$person['name']} {$person['last_name']}";
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div id="users">

        <?php
        foreach ($users as $user) {
        ?>
            <div class='user'>
                <div><?= $user['name'] ?></div>
                <div><?= $user['email'] ?></div>
                <div><?= $user['password'] ?></div>
                <button>blockuser</button>
            </div>
        <?php
        }

        ?>
    </div>

</body>

</html>