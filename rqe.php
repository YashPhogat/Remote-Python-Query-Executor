<?php
$data=$_POST['textinput'];
$filename='input.txt';
$fhandle=fopen($filename,'w')or die('Cannot open file:'.$filename);
fwrite($fhandle,$data);
header("location:client.php");
exec('server.php > /dev/null 2>&1 &');
//exec("client.php");

?>
