<?php
require_once(__DIR__.'/../globals.php');
// TODO: Make sure the user is logged



$db = _api_db();

try{

  $q = $db->prepare('DELETE FROM items 
                      WHERE item_id = :item_id');
  $q->bindValue(':item_id', $POST['item_id']);

  $q->execute();
  // Success
  echo $item_id;
}catch(Exception $ex){
  http_response_code(500);
  echo $ex;
  echo 'System under maintainance '.__LINE__;
  exit();
}
