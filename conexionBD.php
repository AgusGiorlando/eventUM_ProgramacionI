<html>
	<body>
		<?php
		
		$servidor="localhost";
		$usuario="root";
		$contrasena="";
		$nombrebd="eventum";
		
		try {
			$conexionPDO=new PDO("mysql:host=$servidor;dbname=$nombrebd",$usuario,$contrasena);
			$conexionPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			//echo "Conectado\n";
		} catch (Exception $e) {
			echo "No se pudo conectar: " . $e->getMessage();
		}
		?>
	</body>
</html>