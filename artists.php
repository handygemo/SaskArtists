<?php

  include('config.php');
  //connect to the database
  $db = new mysqli($mysql_host, $mysql_user, $mysql_password, $mysql_db);
  if ($db->connect_errno) {
      die("Failed to connect to database");
  }

  $q = $db->query('SELECT name,short,(SELECT name FROM locations WHERE locations.id = artists.location) as location FROM artists');
  echo '[';
  $x = 1;
  while($row=$q->fetch_assoc()){
    echo "{\"name\":\"".$row['name']."\",\"link\":\"".$row['short']."\",\"city\":\"".$row['location']."\"}";
    if($x != $q->num_rows){
      echo ",";
    }
    $x += 1;
  }
  echo ']';


?>
