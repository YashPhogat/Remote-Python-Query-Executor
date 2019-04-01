<html>
    <head>
    <title>Client Interaction</title>
         <meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <style>
        html,body{
            height: 100%;
            width:100%;
            background-color:darkviolet;
            padding-bottom: 0;
        }
        
    </style>
    </head>
    <body>
<?php

$host    = "127.0.0.1";
$port    = 25003;
$handle=fopen("input.txt","r") or die("unable to open file");
$message = fread($handle,filesize("input.txt"));
fclose($handle);
echo "Message To server :".$message;?><br><br>
        <?php
// create socket
$socket = socket_create(AF_INET, SOCK_STREAM, 0) or die("Could not create socket\n");
// connect to server
$result = socket_connect($socket, $host, $port) or die("Could not connect to server\n");  
// send string to server
socket_write($socket, $message, strlen($message)) or die("Could not send data to server\n");
// get server response
$result = socket_read ($socket, 1024) or die("Could not read server response\n");
echo "Reply From Server  :".$result;
// close socket
socket_close($socket);
exec("server.php");
?>
</body></html>