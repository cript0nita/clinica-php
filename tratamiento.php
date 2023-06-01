<HTML LANG="es">
 <HEAD>
  <TITLE>Insercion de Tratamiento</TITLE>
  <meta charset="UTF-8">
 </HEAD>
 <BODY>
 
	<?php
	
	if (isset($_REQUEST['enviar']))
	{		
       	//1º grupo - capturar los input de html y pasarlos a variables de php*/
	   
		$nombre = $_REQUEST['nombre'];
		$duracion = $_REQUEST['duracion'];
	
        /*comprobar errores */
		
		$errores = "";
		/*	
		if (!is_numeric($id_tratamiento)) {
			$errores = $errores .="<li>Introduzca valor numerico</li>";
		}
		*/
		
		if (trim($nombre) == "")
			$errores = $errores .="<li>Se requiere identificacion</li>";
		if (trim ($duracion) == "")
			$errores = $errores .="<li>Introduzca duracion</li>";
		//mostrar errores encontrados
		
		if ($errores != "")
		{
			print("<p> No se ha pdodio realizar la insercion debido a los siguientes errores</p>");
			print($errores);
		} else {
			//mostrar en pantalla los datos que se van a grabar
			
			print("<li> nombre: $nombre</li>");
			print("<li> duracion: $duracion</li>");		
			//conexion base de datos
			
			$conexion = mysqli_connect("localhost", "root", "","clinica") or die ("problema de conexion");
			mysqli_set_charset ($conexion, 'utf8');
		
			$insercion = "INSERT INTO tratamiento (nombre, duracion) VALUES ('$nombre', '$duracion')";
			$consulta = mysqli_query ($conexion, $insercion) or die ("fallo al insertar");
			print ("<p> Insercion correcta</P>\n"); 
			print ("<p> [ <A HREF='tratamiento.php'> Insertar tratamiento </A> ] </p>\n");
			
		}
	} else {	
	?>
 
	<H1>Introduzca los datos del tratamiento</H1>
  
	<FORM class="borde" ACTION="tratamiento.php" METHOD="POST" ENCTYPE="multipart/form-data">
  
	
	Nombre <INPUT TYPE="text" NAME="nombre" VALUE="" SIZE="20"> </br></br>
	
	Duracion <INPUT TYPE="text" NAME="duracion" VALUE="" SIZE="20"> </br></br>

 <H3><INPUT TYPE="submit" NAME="enviar" VALUE="insertar tratamiento"> </H3>

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