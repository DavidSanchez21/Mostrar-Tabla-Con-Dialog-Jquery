<?php
include('../modelo/conexion.php');
$id_factura = $_POST["Nofactura"];

$query = 
		"SELECT * FROM FAC_PRO AS A 
		INNER JOIN FACTURA AS B 
		ON A.id_factura = b.id_factura 
		inner join producto as c 
		on a.id_producto = c.id_producto 
		inner join cliente as d
		on b.id_cliente = d.id_cliente
		where a.id_factura = '$id_factura'
";
			$resultado = mysql_query($query);
			if (!$resultado || mysql_num_rows($resultado)!=0){
				$i=0; 
		        while($res = mysql_fetch_array($resultado)){
		        	if($i%2==0){
						$NumFila = 1;
					}else{
						$NumFila = 2;
					}
		        	if($i==0){

		        		echo "
		        		<table id=\"tablaDialog\">
		        		<tr>
		        		<td colspan=\"5\">Detalles de Factura Numero: <B>".$res['id_factura'] ."</B></td>
		        		</tr>
		        		<tr class=\"FilasMF1\">
		        			<td class=\"ColTMFac\"><B>Cliente</B></td>
		        			<td class=\"ColTMFac\"><B>Direccion</B></td>
		        			<td class=\"ColTMFac\"><B>Telefono</B></td>
		        			<td class=\"ColTMFac\"><B>Ciudad</B></td>
		        			<td class=\"ColTMFac\"><B>Cajero</B></td>
		        		</tr>
		        		<tr class=\"FilasMF2\">
			        		<td class=\"ColTMFac\"> ".$res['Nombre'] ." </td>
			        		<td class=\"ColTMFac\"> ".$res['direccion'] ." </td>
			        		<td class=\"ColTMFac\"> ".$res['telefono'] ." </td>
			        		<td class=\"ColTMFac\"> ".$res['ciudad'] ." </td>
			        		<td class=\"ColTMFac\"> ".$res['id_creador'] ." </td>
		        		</tr>
		        		<tr class=\"FilasMF1\">
		        			<td class=\"ColTMFac\"></td>
		        			<td class=\"ColTMFac\"></td>
		        			<td class=\"ColTMFac\"></td>
			        		<td class=\"ColTMFac\"><B>Valor Total</B></td>
			        		<td class=\"ColTMFac\"><B>".$res['precio_total']."</B></td>
			        	</tr>
		        		<tr class=\"FilasMF2\">
		        			<td class=\"ColTMFac\"><B>Cantida</B></td>
		        			<td class=\"ColTMFac\"><B>Descripcion Producto</B></td>
		        			<td class=\"ColTMFac\"><B>Condigo Producto</B></td>
		        			<td class=\"ColTMFac\"><B>Valor Unitario</B></td>
		        			<td class=\"ColTMFac\"><B>Total Producto</B></td>
		        		</tr>
		        		";
		        	}
		        	echo"
		        		<tr class=\"FilasMF$NumFila\">
		        			<td class=\"ColTMFac\">".$res['cantidad']."</td>
			        		<td class=\"ColTMFac\">".$res['nombre']."</td>
			        		<td class=\"ColTMFac\">".$res['id_producto']."</td>
			        		<td class=\"ColTMFac\">".$res['precio']."</td>
			        		<td class=\"ColTMFac\">".$res['precio'] * $res['cantidad']."</td>
			        	</tr>
			        	";	
			        	$i++;
		        }
		    }else{
		    	echo "<td class=\"ColTMFac\">El cliente no existe intente de nuevo!!!</td>";
		    }
?>
