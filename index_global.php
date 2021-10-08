<?php
$data = file_get_contents('dictionary_global.txt');

$jData = json_decode($data);
echo $jData->t1->en;
