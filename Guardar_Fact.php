<?php
include('../modelo/Consultas.php');
$id_usuario = $_POST['username'];
$Cliente = $_POST["valorCliente"];
$fecha = date("m.d.y");
$Valorfact = $_POST['ValorTotFact'];

$objCons = new Consultas();

for($i=0;$i<16;$i++){
	$id_producto = $_POST["idProd_$i"];
	$cantidadProd = $_POST["cantidad_$i"];
	if($cantidadProd != 0){
		$objCons->RegistraProductos($id_producto,$cantidadProd);
	}
}

//if (($Valorfact !=0)&&($Cliente != 0)&&($id_usuario != 0)){900 
	$objCons->RegistraFactura($id_usuario, $Cliente,$fecha,$Valorfact);
//}

?>
