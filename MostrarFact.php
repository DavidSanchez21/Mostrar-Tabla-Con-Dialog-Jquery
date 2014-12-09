<?php
session_start();
include ('../modelo/Consultas.php');
$obj = new Consultas();
$result = $obj->ConsultaFacturas();
$validacion = "PRUEBA MENSAJE";
if($_SESSION["usuario"])
{

?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
	<script src="../config/jquery-1.9.1.js"></script>
	<script src="../config/jquery-ui.js"></script>
	
	<link rel="stylesheet" type="text/css" href="../config/estilos.css">
  	<script type="text/javascript" src="../config/bootstrap.js"></script>
  	<link rel="stylesheet" type="text/css" href="../config/bootstrap.css">
	<script type="text/javascript" src="../config/bootbox.min.js"></script>
		
	<title>Facturas</title>

	<script type="text/javascript">
	
	function MuestraDetalles(campo){
		document.getElementById("Nofactura").value = campo;
		$.ajax ({
				url: '../controlador/MuestraFacturas.php',
				type: 'post',
				data: $('#Nofactura'),
				success:function(datos)
				{
					$("#dialog").html(datos);
					asignar();
				}				
			});
		return false;
	}

		$(function () {
			$("#dialog").dialog({
			autoOpen: false,
			modal: true,
			buttons: {
				"Cerrar": function () {
				$(this).dialog("close");
				}
			}
		});
		$(".abrir").button().click(function () {
			$("#dialog").dialog("option", "width", 700);
			$("#dialog").dialog("option", "height", 500);
			$("#dialog").dialog("option", "resizable", false);
			$("#dialog").dialog("open");
			});
		});
</script>
</head>
</head>
<body>

<table id="TablaMuestraFacturas">
	<tr class="FilasMFTitulo">
		<td class="ColTM">Factura No</td>
		<td class="ColTM">Identificacion</td>
		<td class="ColTM">Nombre</td>
		<td class="ColTM">Fecha</td>
		<td class="ColTM">Valor Total</td>
		<td class="ColTM">Generada Por</td>
	</tr>
	<tr class="FilasMF2">
		<td class="ColTM"><?php $result ?></td>
		<td class="ColTM"></td>
		<td class="ColTM"></td>
		<td class="ColTM"></td>
		<td class="ColTM"></td>
		<td class="ColTM"></td>
	</tr>
	<?php
	$i = 0;
	$NumFila = 0;
	while ($res=mysql_fetch_array($result)){
		if($i%2==0){
			$NumFila = 1;
		}else{
			$NumFila = 2;
		}
	?>
	<tr class="FilasMF<?php echo $NumFila; ?>">
		<td class="ColTM"><a class="abrir" href="#" onclick="MuestraDetalles(<?php echo $res['id_factura']; ?>);"><?php echo $res['id_factura']; ?></a></td>
		<td class="ColTM"><?php echo $res['id_cliente']; ?></td>
		<td class="ColTM"><?php echo $res['nombre']; ?></td>
		<td class="ColTM"><?php echo $res['fecha_creacion']; ?></td>
		<td class="ColTM"><?php echo $res['precio_total']; ?></td>
		<td class="ColTM"><?php echo $res['id_creador']; ?></td>
	</tr>
	<?php
	$i++;
	}
	?>
</table>
<form id="factura">
	<input type="hidden" id="Nofactura" name="Nofactura" >
</form>

<div id="dialog" title="Detalles Factura">
	
</table>
</div>
</body>
</html>


<?php
}else {
	echo "
	<script type='text/javascript'>
		window.location='../Index.php';
	</script>
	";
}
?>
