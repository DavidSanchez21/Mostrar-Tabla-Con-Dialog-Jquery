<?php
include('../modelo/conexion.php');
$id = $_POST["numDoc"];
$query = "SELECT * FROM cliente WHERE Id_cliente = '$id'";
			$resultado = mysql_query($query);
			if (!$resultado || mysql_num_rows($resultado)!=0){ 
		        $res = mysql_fetch_array($resultado);
	        	echo "
	        	<input type=\"hidden\" id=\"validacion\" value=\"OK\">
	        	<td><input type=\"hidden\" id=\"IdCliente\" name=\"IdCliente\" disabled=\"true\" value=\"".$res['Id_cliente']."\"></td>
	        	<td><B>Nombre: </B> <span class=\"datosCliente\" id=\"Nombre\" name=\"Nombre\" disabled=\"true\">".$res['Nombre']."</span></td>
	        	<td><B>Direccion: </B><span class=\"datosCliente\" id=\"Dir\" name=\"Dir\" disabled=\"true\" >".$res['direccion']."</span></td>
				<td><B>Telefono: </B><span class=\"datosCliente\" id=\"Tel\" name=\"Tel\" disabled=\"true\">".$res['telefono']."</span></td>
	        	";
		    }else{
		    	echo "error";
		    }
?>
