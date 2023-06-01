<HTML LANG="es">
 <HEAD>
  <TITLE>Insercion de Paciente</TITLE>
  <meta charset="UTF-8">
 </HEAD>
 <BODY>
 
	<?php
	
	if (isset($_REQUEST['enviar']))
	{		
       	//1º grupo - capturar los input de html y pasarlos a variables de php*/
	   
		$nombre = $_REQUEST['nombre'];
		$apellidos = $_REQUEST['apellidos'];
		$telefono = $_REQUEST['telefono'];
		if (isset($_REQUEST['alergia'])) {
			// Une elementos de un array en un string ["penicilina", "gluten"] => "penicilina,gluten"
			// https://www.php.net/manual/es/function.implode.php
			$alergia = implode(",", $_REQUEST['alergia']);
		} else {
			$alergia = "";
		}
		
			
        /*comprobar errores */
		
		$errores = "";
		/*	
		if (!is_numeric($id_paciente)) {
			$errores = $errores .="<LI>Introduzca valor numerico";
		}
		*/
		
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
			
			print("<li> nombre: $nombre");
			print("<li> apellidos: $apellidos");
			print("<li> telefono: $telefono");
			print("<li> alergia: $alergia");
			
			//conexion base de datos
			
			$conexion = mysqli_connect("localhost", "root", "","clinica") or die ("problema de conexion");
			mysqli_set_charset ($conexion, 'utf8');
		
			$insercion = "INSERT INTO paciente (nombre, apellidos, telefono, alergia) VALUES ('$nombre', '$apellidos', '$telefono', '$alergia')";
			$consulta = mysqli_query ($conexion, $insercion) or die ("fallo al insertar");
			print ("<p> Insercion correcta</p>\n"); 
			print ("<p> [ <A HREF='paciente.php'> Insertar paciente </A> ] </p>\n");
			
		}
	} else {	
	?>
 
	<H1>Introduzca los datos del paciente</H1>
  
	<FORM class="borde" ACTION="paciente.php" METHOD="POST" ENCTYPE="multipart/form-data">
  
	Nombre <INPUT TYPE="text" NAME="nombre" VALUE="" SIZE="20"> </br></br>
	
	Apellidos <INPUT TYPE="text" NAME="apellidos" VALUE="" SIZE="20"> </br></br>
  
	Telefono <INPUT TYPE="text" NAME="telefono" VALUE="" SIZE="20"> </br></br>
	
	<H3>Alergia</H3>
			
				<INPUT TYPE="checkbox" NAME="alergia[]" VALUE="penicilina" CHECKED> penicilina
				<INPUT TYPE="checkbox" NAME="alergia[]" VALUE="gluten"> gluten
				<INPUT TYPE="checkbox" NAME="alergia[]" VALUE="huevo"> huevo
  
	
 <H3><INPUT TYPE="submit" NAME="enviar" VALUE="insertar paciente"> </H3>

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