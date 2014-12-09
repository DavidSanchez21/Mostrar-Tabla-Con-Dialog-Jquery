<?php
	$conexion = mysql_pconnect("localhost", "root", "")  //SE CREA LA CONEXION INGRESANDO PARAMETROS DE SERVIDOR , USUARIO Y PASSWORD DE BD
         or die ("No se puede conectar con el servidor");
		 //Seleccionar base de datos
		mysql_select_db("imaginefacturas") or die ("No se puede seleccionar la base de datos"); // SE REALIZA CONEXION A LA BASE DE DATOS ejemplo 
?>
