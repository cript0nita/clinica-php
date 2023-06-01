<HTML LANG="es">
 <HEAD>
  <TITLE>Insercion de Sanitario</TITLE>
  <meta charset="UTF-8">
 </HEAD>
 <BODY>
 
	<?php
	
	if (isset($_REQUEST['enviar']))
	{		
       	//1º grupo - capturar los input de html y pasarlos a variables de php*/
	   
		$colegiado = $_REQUEST['colegiado'];
		$nombre = $_REQUEST['nombre'];
		$apellidos = $_REQUEST['apellidos'];
		$telefono = $_REQUEST['telefono'];
			
        /*comprobar errores */
		
		$errores = "";
		/*	
		if (!is_numeric($id_medico)) {
			$errores = $errores .="<LI>Introduzca valor numerico";
		}
		*/
		if (trim($colegiado) == "")
			$errores = $errores .="<li>Se requiere numero de colegiado</li>";
		
		if (trim($nombre) == "")
			$errores = $errores .="<li>Se requiere identificacion</li>";
		
		if (trim($apellidos) == "")
			$errores = $errores .="<li>Se requiere apellidos</li>";
		
		if (!is_numeric($telefono))
			$errores = $errores .="<li>Introduzca valor numerico</li>";
		
		//mostrar errores encontrados
		
		if ($errores != "")
		{
			print("<p> No se ha pdodio realizar la insercion debido a los siguientes errores</p>");
			print($errores);
		} else {
			//mostrar en pantalla los datos que se van a grabar
			
			print("<li> colegiado: $colegiado");
			print("<li> nombre: $nombre");
			print("<li> apellidos: $apellidos");
			print("<li> telefono: $telefono");
			
			//conexion base de datos
			
			$conexion = mysqli_connect("localhost", "root", "","clinica") or die ("problema de conexion");
			mysqli_set_charset ($conexion, 'utf8');
		
			$insercion = "INSERT INTO medico (colegiado, nombre, apellidos, telefono) VALUES ('$colegiado','$nombre', '$apellidos', '$telefono')";
			$consulta = mysqli_query ($conexion, $insercion) or die ("fallo al insertar");
			print ("<p> Insercion correcta</P>\n"); 
			print ("<P> [ <A HREF='medico.php'> Insertar medico </A> ] </P>\n");
			
		}
	} else {	
	?>
 
	<H1>Introduzca los datos de medico</H1>
  
	<FORM class="borde" ACTION="medico.php" METHOD="POST" ENCTYPE="multipart/form-data">
  
	Colegiado<INPUT TYPE="text" NAME="colegiado" VALUE="" SIZE="20"> </br></br>
	
	Nombre <INPUT TYPE="text" NAME="nombre" VALUE="" SIZE="20"> </br></br>
	
	Apellidos <INPUT TYPE="text" NAME="apellidos" VALUE="" SIZE="20"> </br></br>
  
	Telefono <INPUT TYPE="text" NAME="telefono" VALUE="" SIZE="20"> </br></br>
  
	
 <H3><INPUT TYPE="submit" NAME="enviar" VALUE="insertar medico"> </H3>

</FORM>

<?php 
	}
?>

		<H4>
			<a href="medico.php"> Insertar Medico </a> &nbsp
			<a href="paciente.php"> Insertar Paciente </a> &nbsp
			<a href="tratamiento.php"> Insertar Tratamiento </a> &nbsp
			<a href="consulta.php"> Insertar Consulta </a> &nbsp
			<a href="index.html"> Menú principal </a> &nbsp
		</H4>



 </BODY>
 
</HTML>