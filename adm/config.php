<?php 
error_reporting (E_ALL & ~ E_NOTICE & ~ E_DEPRECATED);
//se conecta ao servidor de banco de dados
$con= mysql_connect ("mysql.hostinger.com.br","u177298948_karen","123123123") or die (mysql_error());
// se conecta ao banco selecionado
mysql_select_db("u177298948_karen",$con) or die (mysql_error());
?>