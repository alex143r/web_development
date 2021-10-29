<?php

//Validate

//$db->beginTransaction();

try {
    //begin transaction if 2 or more updates, deletes, inserts

    //$q = $db->prepare...
    //$q->execute()

    //if u rollback at some point, you have to exit()

    //commit

} catch (Exception $ex) {
    //you must always rollback
    //$db->rollBack();
    //exit();
}
