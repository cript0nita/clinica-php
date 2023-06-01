<HTML LANG="es">
	<HEAD>
		<TITLE>Inserción de Consulta</TITLE>
		<meta charset="UTF-8">
	</HEAD>
	<BODY>
		<?php
	
		if (isset($_REQUEST['enviar']))
		{		
			//1º grupo - capturar los input de html y pasarlos a variables de php*/
		   
			$medico_id = $_REQUEST['medico_id'];
			$paciente_id = $_REQUEST['paciente_id'];
			$tratamiento_id = $_REQUEST['tratamiento_id'];
			$cita = $_REQUEST['cita'];
			$observaciones = $_REQUEST['observaciones'];
			$importe = $_REQUEST['importe'];
			
			/*comprobar errores */
			$errores = "";
			
			if (trim($medico_id) == "") 
				$errores = $errores .="<li>Identifique medico</li>";
			
			if (trim($paciente_id) == "")
				$errores = $errores .="<li>Identifique paciente</li>";
			
			if (trim($tratamiento_id) == "")
				$errores = $errores .="<li>Indentifique tratamiento</li>";
			
			if (trim($cita) == "")
				$errores = $errores .="<li>Indentifique hora y fecha</li>";
				
			if (trim($observaciones) == "")
				$errores = $errores .="<li>Rellene campo</li>";
			
			if (trim($importe) == "")
				$errores = $errores .="<li>Introduzca importe</li>";
			
			//mostrar errores encontrados
			
			if ($errores != "")
			{
				print("<p> No se ha pdodio realizar la insercion debido a los siguientes errores</p>");
				print($errores);
			} else {
				//mostrar en pantalla los datos que se van a grabar
			
				print("<li> medico_id: $medico_id</li>");
				print("<li> paciente_id: $paciente_id</li>");
				print("<li> tratamiento: $tratamiento_id</li>");
				print("<li> cita: $cita</li>");
				print("<li> observaciones: $observaciones</li>");
				print("<li> importe: $importe</li>");
				//conexion base de datos
				
				$conexion = mysqli_connect("localhost", "root", "","clinica") or die ("problema de conexion");
				mysqli_set_charset ($conexion, 'utf8');
			
				$insercion = "INSERT INTO consulta (medico_id, paciente_id, tratamiento_id, cita, observaciones, importe) VALUES ('$medico_id', '$paciente_id','$tratamiento_id', '$cita', '$observaciones', '$importe')";
				
				$consulta = mysqli_query ($conexion, $insercion) or die ("fallo al insertar");
				print ("<p> Insercion correcta</P>\n"); 
				print ("<p> [ <A HREF='consulta.php'> Insertar consulta </A> ] </p>\n");
				
			}
		} else {	
		?>
 
		<H1>Consulta</H1> 
		<FORM class="borde" ACTION="consulta.php" METHOD="POST" ENCTYPE="multipart/form-data">
			
			<H3>Medico</H3>
			<SELECT name="medico_id">  
				<?php
					$conexion=mysqli_connect("localhost","root","","clinica") or die ("Problema de conexión");
					$rows=mysqli_query($conexion, "SELECT id_medico, apellidos, nombre FROM medico") or die ("Problemas en el select: " . mysqli_error($conexion));
					
					while ($row=mysqli_fetch_array($rows))
					{
						echo "<option value=\"$row[id_medico]\">$row[nombre] $row[apellidos] </option>";
					}
				?>
			</SELECT> 
			
			<H3>Paciente</H3>
			<SELECT name="paciente_id">  
				<?php
					$conexion=mysqli_connect("localhost","root","","clinica") or die ("Problema de conexión");
					$rows=mysqli_query($conexion, "SELECT id_paciente, apellidos, nombre FROM paciente") or die ("Problemas en el select: " . mysqli_error($conexion));
					
					while ($row=mysqli_fetch_array($rows))
					{
						echo "<option value=\"$row[id_paciente]\">$row[nombre] $row[apellidos] </option>";
					}
				?>
			</SELECT> 
			
			<H3>Tratamiento</H3>
			<SELECT name="tratamiento_id">  
				<?php
					$conexion=mysqli_connect("localhost","root","","clinica") or die ("Problema de conexión");
					$rows=mysqli_query($conexion, "SELECT id_tratamiento, nombre FROM tratamiento") or die ("Problemas en el select: " . mysqli_error($conexion));
					
					while ($row=mysqli_fetch_array($rows))
					{
						echo "<option value=\"$row[id_tratamiento]\">$row[nombre]</option>";
					}
				?>
			</SELECT> 
			
			</br></br>
			<label class="form-label">Cita</label>
			<input type="date" name="cita" class="form-control">
			</div>
			</br></br>
			
			Observaciones <INPUT TYPE="text" NAME="observaciones" VALUE="" SIZE="20"> </br></br>
			
			Importe <INPUT TYPE="text" NAME="importe" VALUE="" SIZE="20"> </br></br>
			
		   <INPUT TYPE="submit" NAME="enviar" VALUE="insertar">
		   
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