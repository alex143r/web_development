<?php

$data = json_decode(file_get_contents("shop.txt"));
foreach ($data as $item) {
    echo "
        <div>
            <div>{$item->id}</div>
            <div>{$item->title}</div>
            <img src='https://coderspage.com/2021-F-Web-Dev-Images/{$item->image}'>
        </div>";
};
