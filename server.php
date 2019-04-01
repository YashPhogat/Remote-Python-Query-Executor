
<?php
// set some variables
$host = "127.0.0.1";
$port = 25003;
// don't timeout!
set_time_limit(0);
// create socket


$socket = socket_create(AF_INET, SOCK_STREAM, 0) or die("Could not create socket\n");
// bind socket to port
$result = socket_bind($socket, $host, $port) or die("Could not bind to socket\n");
// start listening for connections
$result = socket_listen($socket, 3) or die("Could not set up socket listener\n");

// accept incoming connections
// spawn another socket to handle communication
$spawn = socket_accept($socket) or die("Could not accept incoming connection\n");
// read client input
$input = socket_read($spawn, 1024) or die("Could not read input\n");
// clean up input string
$input = trim($input);
echo $input;
$servhandle=fopen("input1.txt","w") or die("unable to open file for writing");
fwrite($servhandle,$input,strlen($input));
fclose($servhandle);


//perform python function call*****************
$pyscript = 'C:/xampp/htdocs/rqe/commandToOutput.py';
$python = 'C:/Python27/python.exe';
$command=("C:/Python27/python.exe C:\xampp\htdocs\rqe\commandToOutput.py");
exec('C:\Python27\python.exe C:\xampp\htdocs\rqe\commandToOuput.py 2>&1',$servoutput);
//print_r( $servoutput);

echo "\nClient Message : ".$input;
// reverse client input and send back

$handle=fopen("output.txt","r") or die("unable to open file");
$output = fread($handle,filesize("output.txt"));
ftruncate($handle,0);
fclose($handle);
socket_write($spawn, $output, strlen ($output)) or die("Could not write output\n");
// close sockets
socket_close($spawn);
socket_close($socket);
header("Refresh:2");
?>
   
    