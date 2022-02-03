<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
	<head>
		<title>Instituto Abastos</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<link rel="stylesheet" type="text/css" href="<?php echo 'css/'.Config::$mvc_vis_css ?>" />
	</head>
	<body>
		<div id="cabecera">
			<h1>Bienvenido al IES Abastos</h1>
		</div>
		<?php 
			/*  En caso de tener diferentes menus dependiendo de las vistas modificaremos el valor de $menu en el controlador */
			if (!isset($menu))
				$menu= 'menu.php' ;
			include $menu 
		?>

		<div id="contenido">
			<?php echo $contenido;?>			
		</div>

		<div id="pie">
			<hr />
			<div align="center">- Aquí deberíamos cargar el FOOTER -</div>
		</div>
	</body>
</html>
