<?php
include("conexion.php");
class Consultas {

public function consulta_usuario($id)
	{
		$query = "SELECT * FROM cliente WHERE id = '$id'";
			$resultado = mysql_query($query);
			if (!$resultado || mysql_num_rows($resultado)!=0){ 
		        //$res = mysql_fetch_array ($resultado);
				return $resultado;
			}else{
					return false;
			}
	}	


public function validaLogin($user, $pass)
	{
		$query = "SELECT * FROM usuarios where username = '$user' and pass = '$pass'";
			$resultado = mysql_query($query);
			if (!$resultado || mysql_num_rows($resultado)!=0){ 
		        $res = mysql_fetch_array ($resultado);
				return $res;
			}else{
					return false;
			}
	}

public function productos(){
		$query = "SELECT * FROM PRODUCTO";
		$resultado = mysql_query($query);
		if (!$resultado || mysql_num_rows($resultado)!=0){ 
	        //$res = mysql_fetch_array ($resultado);
			return $resultado;
		}else{
				return false;
		}	
	} 

public function RegistraFactura($id_usuario, $Cliente,$fecha,$Valorfact){
	$query1 = "SELECT * FROM factura ORDER BY id_factura DESC LIMIT 1";
	$id_facObt = mysql_query($query1);
	$res = mysql_fetch_array ($id_facObt);
	$idfac = $res['id_factura'];
	$idfac = $idfac + 1;
	$query = "INSERT INTO factura(id_factura, id_creador, id_cliente, fecha_creacion, precio_total) VALUES ('$idfac','$id_usuario','$Cliente','$fecha','$Valorfact')";
		mysql_query($query) or die(mysql_error());;
			echo "
				<script type='text/javascript'>
					window.location='../vista/menu.php';
				</script>
				";
		exit;
}

public function RegistraProductos($id_producto,$cantidad){
	$query1 = "SELECT * FROM factura ORDER BY id_factura DESC LIMIT 1";
	$id_facObt = mysql_query($query1);
	$res = mysql_fetch_array ($id_facObt);
	$idfac = $res['id_factura'];
	$idfac = $idfac + 1;
	$query = "INSERT INTO fac_pro(id_factura, id_producto, cantidad) VALUES ('$idfac','$id_producto','$cantidad')";
		mysql_query($query) or die(mysql_error());;
			//echo "Factura Creado Correctamente"; 
		//exit;	
		echo "
				<script type='text/javascript'>
					window.location='../vista/menu.php';
					alert('Factura Registrada Correctamente');
				</script>
				";
}

public function ConsultaFacturas(){
		$query = "SELECT DISTINCT a.id_factura, c.id_cliente, c.nombre, b.fecha_creacion, b.precio_total, b.id_creador FROM fac_pro as a 
				INNER JOIN factura as b on a.id_factura = b.id_factura 
				INNER JOIN cliente as c on b.id_cliente = c.id_cliente"; 
		$resultado = mysql_query($query);
		if (!$resultado || mysql_num_rows($resultado)!=0){ 
	        //$res = mysql_fetch_array ($resultado);
			return $resultado;
		}else{
				return false;
		}	
	}

/*SELECT DISTINCT a.id_factura, c.id_cliente, c.nombre, b.fecha_creacion, b.precio_total from fac_pro as a 
join factura as b on a.id_factura = b.id_factura 
join cliente as c on b.id_cliente = c.id_cliente
*/
//SELECT DISTINCT a.id_factura, b.fecha_creacion, b.precio_total from fac_pro as a join factura as b on a.id_factura = b.id_factura
}
?>
