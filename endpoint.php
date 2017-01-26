<?php

//This is a microservice designed to return PLZ codes based on url input. 
//Note that because it depends solely on url input, we could easily cache results in files using a hash of those urls.
//We could also use something more sophisticated, like memcached. 
//I have not implemented either of those caching scchemes here, since traffic will be pretty low on this service. 

//Our dbconfig file gives us a PDO handle called $dbh.
include_once('dbconfig.php');

class plz{
  public static function getResult($dbh){
    //We use both a regex filter and prepared statements to sanitize input. 
    $input = $_GET['description'];
    $input = preg_replace('/[^ ,[:alnum:]-]/u','',$input);
    $input = '%'.$input.'%';
    $statement = $dbh->prepare("SELECT * FROM codes where description LIKE ? LIMIT 0,8");
    if ($statement->execute(array($input))) {
      while ($row = $statement->fetch()) {
        $rows[] = array_map(htmlentities,$row);
      }   
    }   
    $output = json_encode($rows);
    return $output;
  }
}

print plz::getResult($dbh);

?>
