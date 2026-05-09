<?php
define ('server' , 'localhost'); # $server = 127.0.0.1 = localhost define ('server' , '127.0.0.1');
define('user' , 'root');
define('pass' ,''); 
define('database' , 'abc1718,'); 

$conn = mysqli_connect(server, user , pass , database);
if (!($conn)){ // False Connection
  echo "Connection between php and server or database is not well established" . mysqli_connect_error()."<br>";
}
else{  # True Connection
//  echo " Connection between php and server with the databse is wel established" . "<br>";
}
?