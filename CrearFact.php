<?php
session_start();
include ('../modelo/Consultas.php');
$obj = new Consultas();
$result = $obj->productos();

if($_SESSION["usuario"])
{

?>
<html>
<head>
<title>Facturas Imagine</title>
<link rel="stylesheet" type="text/css" href="../config/estilos.css">
<script type="text/javascript" src="../config/jquery-1.9.1.js"></script>
<script type="text/javascript" src="../config/jquery-1.9.1.min.js"></script>

<script type="text/javascript">
	function calculaValores (campo,item){
		var valorUnitario = document.getElementById("precio_"+item).value;
		var cant = campo.value;
		var valorTotal = valorUnitario * cant;
		document.getElementById("valorTot_"+item).value = valorTotal;
		//total Articulos
		var total = 0;
		for (i=0;i<16;i++){
			var totalArticulo = parseInt(document.getElementById("valorTot_"+i).value,10);
			total = total + totalArticulo;
		}
		
		document.getElementById("ValorTotFact").value = total;
	}
	function TraeDatos(){
		
		$.ajax ({
				url: '../controlador/MuestraDatos.php',
				type: 'post',
				data: $('#FormDatos').serialize(),
				success:function(datos)
				{
					if(datos == "error"){
						datos = "<p>El Cliente No Existe!!</p>"
						$("#CargaProductos").css("display", "none");
						$("#CargaDatos").html(datos);
					}else{
						$("#CargaProductos").css("display", "block");
						$("#CargaDatos").html(datos);
						asignar();
					}
				}				
			});
		return false;
	}

	function asignar(){
		document.getElementById("valorCliente").value=document.getElementById("IdCliente").value;
		var total2 = document.getElementById("valorCliente").value;
		if(total2 == 0){
			document.getElementById("FilaBoton").disabled = true;
		}else{
			document.getElementById("FilaBoton").disabled = false;
		}
	}

	function soloNumeros(e){
		var key = window.Event ? e.which : e.keyCode
		return (key >= 48 && key <= 57)
	}
	function validaCampos(){

		var total2 = document.getElementById("ValorTotFact").value;
		if(total2 != 0){
			accion = "../controlador/Guardar_Fact.php";
			document.FormPrincipal.action = accion;			
		 	document.FormPrincipal.submit();
		}else{
			alert("Debe Agregar Productos a la compra");
		}	
	}
	
</script>
</head>

<body>
<div>
	<form method="post" id="FormDatos"> 
	<table id="datosCabecera">
	<tr>
		<td class="ColTM">Facturas Imagine</td>
	</tr>
	<tr>
		<td class="ColTM" id="FilaDoc" width="1"><label>Numero de documento</label><input onKeyPress="return soloNumeros(event)" type="text" id="numDoc" name="numDoc" onkeyup="TraeDatos(this);"></td>
	</tr>
	<tr id="CargaDatos" class="FilasMFTitulo" >
		
	</tr>
	</table>
	</form>
</div>

<div id="CargaProductos" style="display: none;">
	<form method="post" id="FormPrincipal" name="FormPrincipal">
	<table id="TablaCreaFacturas">
	<!--<tr id="CargaDatos" class="FilasMFTitulo" >
		
	</tr>-->
		<tr><input type="hidden" id="valorCliente" name="valorCliente"></tr>
		<tr><input type="hidden" value="<?php echo $_SESSION['usuario']; ?>" name="username"></tr>
	<tr></tr>
	<tr class="FilasMFTitulo">
		<td class="ColTM" width="1"></td>
		<td class="ColTM">Cantidad</td>
		<td class="ColTM">Producto</td>
		<td class="ColTM">Valor Unitario</td>
		<td class="ColTM">Valor Total</td>
	</tr>
	<?php
	$i = 0;
	while ($res=mysql_fetch_array($result)){
		if($i%2==0){
			$NumFila = 1;
		}else{
			$NumFila = 2;
		}
	?>
	<tr class="FilasMF<?php echo $NumFila; ?>">
		<td class="ColTM" width="1"><input type="hidden" value="<?php echo $res['id_producto']; ?>" name="<?php echo "idProd_$i"; ?>"></td>
		<td class="ColTM"><input onKeyPress="return soloNumeros(event)" type="text" value="0" name="<?php echo "cantidad_$i"; ?>" id="<?php echo "cantidad_$i"; ?>" class="Cantidad" onchange="calculaValores(this,<?php echo $i;?>)"></td>	
		<td class="ColTM"><?php echo $res['nombre']; ?> </td>
		<td class="ColTM"><input type="text" class="CamposPrecios" value="<?php echo $res['precio']; ?>" name="<?php echo "precio_$i"; ?>" id="<?php echo "precio_$i"; ?>" disabled="true"></td>
		<td class="ColTM"><input type="text" class="CamposPrecios" id="<?php echo "valorTot_$i"; ?>" disabled="true" value="0"></td>
	</tr>
	<?php
	$i++;
	}
	?>
	
	<tr class="FilasMF1">
		<td class="ColTM" width="1"></td>
		<td class="ColTM"></td>
		<td class="ColTM"></td>
		<td class="ColTM"></td>
		<td class="ColTM">Total </td>
	</tr>
	<tr class="FilasMF2">
		<td class="ColTM"></td>
		<td class="ColTM"></td>
		<td class="ColTM"></td>
		<td class="ColTM"></td>
		<td class="ColTM"><input type="text" id="ValorTotFact" name="ValorTotFact" value="0" onKeyPress="return soloNumeros(event)"></td>
	</tr>
	<tr>
		<td class="ColTM" ><input id="FilaBoton" type="button" value="Guardar" onclick="validaCampos();"></td>
	</tr>
	</table>
	</form>
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
