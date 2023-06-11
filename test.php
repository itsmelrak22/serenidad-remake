<?php
$baseUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$baseUrl = str_replace('/client/queries/handleClientRegister.php/', '', $baseUrl);
echo $baseUrl;
?>
