<?php
ob_start();
error_reporting(E_ALL & ~ E_NOTICE & ~ E_DEPRECATED);
// mysql_connect("mysql.hostinger.com.br", "u177298948_ric", "ric123456") or die(mysql_error());
mysql_connect("localhost", "root", "") or die(mysql_error());
mysql_select_db("sistema_fornecedores") or die(mysql_error());
// ini_set('session.gc_maxlifetime', 8*60*60);

?>