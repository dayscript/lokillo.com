<?php

$url = "http://process.grupotesta.com.co/WSlokillo/API/SolicitudLokillo";


$data = array(

	"datosBasicos" => array(
			"Nombre"				=>	$_POST['name'],	
			"Apellido"				=>	$_POST['apellidos'],
			"Telefono"				=>	$_POST['telefono'],
			"Celular"				=>	$_POST['celular'],
			"Email"					=>	$_POST['email'],
			"Sitio_Web"				=>	$_POST['sitio_web'],
			"Compania"				=>	$_POST['compania'],
			"Tipo_Compania"			=>	$_POST['tipo_de_compania'],
			"Pais_Compania"			=>	$_POST['pais'],
			"Ciudad_Compania"		=>	$_POST['ciudad_compania'],
			"Sitio_Web_Compania"	=>	$_POST['sitio_web_de_la_compania'],
			"Direccion"				=>	$_POST['direccion'],
			"Tipo_Documento"		=>	$_POST['tipo_de_documento'],
			"Numero_De_Documento"	=>	$_POST['numero_de_documento']
		),
	"tipoEvento" => array(
			"IdTipoEvento"				=> $_POST['tipo_de_evento'],
			"Descripcion_Experiencia"	=> $_POST['descripcion_experiencia'],
			"Tiquetera"					=> $_POST['tiquetera'],
			"ResponsableBoleteria"		=> $_POST['responsable_de_la_boleteria'],
			"Cliente_Final"				=> $_POST['cliente_final'],
			"Objetivo_Evento"			=> $_POST['objetivo_del_evento'],
			"Agencia"					=> $_POST['agencia'],
			"Marca"						=> $_POST['marca'],
			"Objetivo_Campana"			=> $_POST['objetivo_de_la_campana']
	),
	"datosEvento" => array (
			"Pais_Evento"			=> $_POST['pais_del_evento'],
			"Ciudad_Evento"			=> $_POST['ciudad'],
			"Lugar_Evento"			=> $_POST['lugar_del_evento'],
			"Fecha_Hora_Evento"		=> ($_POST['fecha_del_evento'] . "T" . $_POST['hora_del_evento']),
			"Aforo_Evento"			=> $_POST['aforo_del_evento'],
	)

);



$json = json_encode($data);


$options = array(
  'http' => array(
    'method'  => 'POST',
    'content' => $json,
    'header'=>  "Content-Type: application/json\r\n" .
                "Accept: application/json\r\n"
    )
);

$context  = stream_context_create( $options );
$result = file_get_contents( $url, false, $context );
$response = json_decode( $result );


//header("Location: /gracias-por-su-contacto");

// echo "<pre>";
// print_r( $response );
// echo "</pre>";


///////////////////////////////////////////////////////////////////////

function getTipoDoc( $doc ) {
	switch ($doc) {
		case '1':
			return "Cédula de ciudadanía";
			break;

		case '2':
			return "Tarjeta de identidad";
			break;

		case '3':
			return "Cédula de extranjería";
			break;

		case '4':
			return "Pasaporte";
			break;

		case '5':
			return "NIT";
			break;
		
		default:
			return "Otro";
			break;
	}
}

function getTipoEvento( $evento ) {
	switch ($evento) {
		case '1':
			return "Venta de boletería";
			break;

		case '2':
			return "Corporativo";
			break;

		case '3':
			return "Gubernamental";
			break;

		case '4':
			return "Campaña publicitaria";
			break;
		
		default:
			return "Otro";
			break;
	}
}


function sendMail( $destEmail, $subject) {

	    $header = "Reply-To: Todo Un Lokillo <no-reply@todounlokillo.com>\r\n";
	    $header .= "Return-Path: Todo Un Lokillo <no-reply@todounlokillo.com>\r\n";
	    $header .= "From: Todo Un Lokillo <no-reply@todounlokillo.com>\r\n";
	    $header .= "Organization: Todo Un Lokillo\r\n";
	    $header .= "MIME-Version: 1.0\r\n";
	    $header .= "Content-type: text/html; charset=iso-8859-1\r\n";
      	$header .= "X-Mailer: PHP/" . phpversion();

      $message = "<table cellpadding='0' cellspacing='0' border='0' width='100%' border='1' style='background:#000'>
					<tbody>
						<tr>
							<td>
								<table cellpadding='0' cellspacing='0' border='0' width='650' border='1' style='margin:0 auto;font-family:Arial,sans-serif;color:#FFF'>
									<tbody>
										<tr>
											<td style='padding:5px;font-size:11px;' colspan='2'><img src='http://todounlokillo.com/sites/default/files/lokillo-logo_0_0.png'></td>
										<tr>
											<th style='padding:5px;font-size:11px;' align='left'>Nombre</th>
											<td style='padding:5px;font-size:11px;'>" . $_POST['name'] . "</td>
										</tr>
										<tr>
											<th style='padding:5px;font-size:11px;' align='left'>Apellido</th>
											<td style='padding:5px;font-size:11px;'>" . $_POST['apellidos'] . "</td>
										</tr>
										<tr>
											<th style='padding:5px;font-size:11px;' align='left'>Telefono</th>
											<td style='padding:5px;font-size:11px;'>" . $_POST['telefono'] . "</td>
										</tr>
										<tr>
											<th style='padding:5px;font-size:11px;' align='left'>Celular</th>
											<td style='padding:5px;font-size:11px;'>" . $_POST['celular'] . "</td>
										</tr>
										<tr>
											<th style='padding:5px;font-size:11px;' align='left'>Email</th>
											<td style='padding:5px;font-size:11px;'>" . $_POST['email'] . "</td>
										</tr>
										<tr>
											<th style='padding:5px;font-size:11px;' align='left'>Sitio Web</th>
											<td style='padding:5px;font-size:11px;'>" . $_POST['sitio_web'] . "</td>
										</tr>
										<tr>
											<th style='padding:5px;font-size:11px;' align='left'>Compañía</th>
											<td style='padding:5px;font-size:11px;'>" . $_POST['compania'] . "</td>
										</tr>
										<tr>
											<th style='padding:5px;font-size:11px;' align='left'>Tipo de Compañía</th>
											<td style='padding:5px;font-size:11px;'>" . $_POST['tipo_de_compania'] . "</td>
										</tr>
										<tr>
											<th style='padding:5px;font-size:11px;' align='left'>Pais Compañía</th>
											<td style='padding:5px;font-size:11px;'>" . $_POST['pais'] . "</td>
										</tr>
										<tr>
											<th style='padding:5px;font-size:11px;' align='left'>Ciudad Compañía</th>
											<td style='padding:5px;font-size:11px;'>" . $_POST['ciudad_compania'] . "</td>
										</tr>
										<tr>
											<th style='padding:5px;font-size:11px;' align='left'>Sitio Web Compañía</th>
											<td style='padding:5px;font-size:11px;'>" . $_POST['sitio_web_de_la_compania'] . "</td>
										</tr>
										<tr>
											<th style='padding:5px;font-size:11px;' align='left'>Dirección</th>
											<td style='padding:5px;font-size:11px;'>" . $_POST['direccion'] . "</td>
										</tr>
										<tr>
											<th style='padding:5px;font-size:11px;' align='left'>Tipo de Documento</th>
											<td style='padding:5px;font-size:11px;'>" . getTipoDoc($_POST['tipo_de_documento']) . "</td>
										</tr>
										<tr>
											<th style='padding:5px;font-size:11px;' align='left'>Número De Documento</th>
											<td style='padding:5px;font-size:11px;'>" . $_POST['numero_de_documento'] . "</td>
										</tr>
										<tr>
											<th style='padding:5px;font-size:11px;' align='left'>Tipo de evento</th>
											<td style='padding:5px;font-size:11px;'>" . getTipoEvento($_POST['tipo_de_evento']) . "</td>
										</tr>
										<tr>
											<th style='padding:5px;font-size:11px;' align='left'>Descripción Experiencia</th>
											<td style='padding:5px;font-size:11px;'>" . $_POST['descripcion_experiencia'] . "</td>
										</tr>
										<tr>
											<th style='padding:5px;font-size:11px;' align='left'>Tiquetera</th>
											<td style='padding:5px;font-size:11px;'>" . $_POST['tiquetera'] . "</td>
										</tr>
										<tr>
											<th style='padding:5px;font-size:11px;' align='left'>Responsable Boletería</th>
											<td style='padding:5px;font-size:11px;'>" . $_POST['responsable_de_la_boleteria'] . "</td>
										</tr>
										<tr>
											<th style='padding:5px;font-size:11px;' align='left'>Cliente Final</th>
											<td style='padding:5px;font-size:11px;'>" . $_POST['cliente_final'] . "</td>
										</tr>
										<tr>
											<th style='padding:5px;font-size:11px;' align='left'>Objetivo del Evento</th>
											<td style='padding:5px;font-size:11px;'>" . $_POST['objetivo_del_evento'] . "</td>
										</tr>
										<tr>
											<th style='padding:5px;font-size:11px;' align='left'>Agencia</th>
											<td style='padding:5px;font-size:11px;'>" . $_POST['agencia'] . "</td>
										</tr>
										<tr>
											<th style='padding:5px;font-size:11px;' align='left'>Marca</th>
											<td style='padding:5px;font-size:11px;'>" . $_POST['marca'] . "</td>
										</tr>
										<tr>
											<th style='padding:5px;font-size:11px;' align='left'>Objetivo de la Campaña</th>
											<td style='padding:5px;font-size:11px;'>" . $_POST['objetivo_de_la_campana'] . "</td>
										</tr>
										<tr>
											<th style='padding:5px;font-size:11px;' align='left'>País del Evento</th>
											<td style='padding:5px;font-size:11px;'>" . $_POST['pais_del_evento'] . "</td>
										</tr>
										<tr>
											<th style='padding:5px;font-size:11px;' align='left'>Ciudad del Evento</th>
											<td style='padding:5px;font-size:11px;'>" . $_POST['ciudad'] . "</td>
										</tr>
										<tr>
											<th style='padding:5px;font-size:11px;' align='left'>Luga del Evento</th>
											<td style='padding:5px;font-size:11px;'>" . $_POST['lugar_del_evento'] . "</td>
										</tr>
										<tr>
											<th style='padding:5px;font-size:11px;' align='left'>Fecha y Hora Evento</th>
											<td style='padding:5px;font-size:11px;'>" . $_POST['fecha_del_evento'] . 'T' . $_POST['hora_del_evento'] . "</td>
										</tr>
										<tr>
											<th style='padding:5px;font-size:11px;' align='left'>Aforo Evento</th>
											<td style='padding:5px;font-size:11px;'>" . $_POST['aforo_del_evento'] . "</td>
										</tr>
									</tbody>
								</table>
							</td>
						</tr>
					</tbody>
				</table>";

	    try {
	    	mail($destEmail, $subject, $message, $header);
	    	echo "<script>alert('¡Gracias por tu mensaje! Pronto nos pondremos en contacto.')</script>";
	    } catch (Exception $e) {
			echo 'Lo sentimos, algo sucedió en el proceso de envío del mensaje. Por favor inténtalo de nuevo en unos momentos.';
		}
	}

	// if (isset( $_POST['nombres'] ) && $_POST['nombres'] != "" &&
	// 	isset( $_POST['email'] ) && $_POST['email'] != "") {
	// 	sendMail( "fcaffield2@gmail.com", "Nuevo mensaje de contacto" );
	// }

	sendMail( "todounlokillo.general@gmail.com,asilva@pianoproducciones.com,jarman.corredor@linkdigital.co,fcafiel@dayscript.com", "Nueva solicitud de cotización" );

	header("Location: /gracias-por-su-contacto");




?>
