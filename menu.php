<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Menu Principal</title>
  <link rel="stylesheet" type="text/css" href="../config/menu.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <link rel="stylesheet" type="text/css" href="../config/estilos.css">
  <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
  
  <script>
  $(function() {
    $( "#tabs" ).tabs({
      beforeLoad: function( event, ui ) {
        ui.jqXHR.error(function() {
          ui.panel.html(
            "Couldn't load this tab. We'll try to fix this as soon as possible. " +
            "If this wouldn't be a demo." );
        });
      }
    });
  });
  </script>
</head>
<body>
 
<div id="tabs">
<a id="Salir" href="../controlador/salir.php">Cerrar Sesion</a>
  <ul>
    <li><a href="../vista/CrearFact.php">Facturacion</a></li>
    <li><a href="../vista/MostrarFact.php">Consulta Facturas</a></li>
  </ul>
  <div id="tabs-1">
  </div>
</div>
 
 
</body>
</html>
