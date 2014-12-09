<?php
session_start();
include('../modelo/Consultas.php');
$user = $_POST['user'];
$pass = $_POST['pass'];

$objCons = new Consultas();

$res = $objCons->validaLogin($user, $pass);

if ($res!=false)
{
	$_SESSION["usuario"] = $user;
	echo "
	<script type='text/javascript'>
		window.location='../vista/menu.php';
	</script>
	";
}else{
	echo "
	<script type='text/javascript'>
		window.location='../Index.php';
	</script>
	";
}

?>
