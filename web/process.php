<?php

header('Content-type: text/html; charset=utf-8');

// echo "<pre>";
// print_r( $_POST );
// echo "</pre>";



use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'libraries/phpmailer/src/Exception.php';
require 'libraries/phpmailer/src/PHPMailer.php';
require 'libraries/phpmailer/src/SMTP.php';




//##########################################


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

		case '6':
			return "Gira";
			break;
		
		default:
			return "Otro";
			break;
	}
}

function traductor( $str ) {
	switch ( $str ) {
		case 'Sunday':
			return "Domingo";
			break;

		case 'Monday':
			return "Lunes";
			break;

		case 'Tuesday':
			return "Martes";
			break;

		case 'Wednesday':
			return "Miércoles";
			break;

		case 'Thursday':
			return "Jueves";
			break;

		case 'Friday':
			return "Viernes";
			break;

		case 'Saturday':
			return "Sábado";
			break;

		case 'January':
			return "Enero";
			break;

		case 'February':
			return "Febrero";
			break;

		case 'March':
			return "Marzo";
			break;

		case 'April':
			return "Abril";
			break;

		case 'May':
			return "Mayo";
			break;

		case 'June':
			return "Junio";
			break;

		case 'July':
			return "Julio";
			break;

		case 'August':
			return "Agosto";
			break;

		case 'Septembre':
			return "Septiembre";
			break;

		case 'October':
			return "Octubre";
			break;

		case 'November':
			return "Noviembre";
			break;

		case 'December':
			return "Diciembre";
			break;
		
		default:
			return $str;
			break;
	}
}


function sendMail( $destEmail, $subject) {

		$date = $_POST['fecha_del_evento'];

		$newDate = traductor(date("l", strtotime($date))) . date(", j", strtotime($date)) . " de " .  traductor(date("F", strtotime($date))) . " de " . date("Y", strtotime($date));

		if ( $newDate == "Jueves, 1 de Enero de 1970" ) {
			$newDate = "";
		}

	    // $header = "From: Lokillo <contacto@todounlokillo.com>\r\n";
	    // $header .= "Reply-To: Lokillo <contacto@todounlokillo.com>\r\n";
	    // $header .= "Return-Path: Lokillo <contacto@todounlokillo.com>\r\n";
	    // $header .= "Organization: Lokillo\r\n";
	    // $header .= "MIME-Version: 1.0\r\n";
	    // $header .= "Content-type: text/html; charset=utf-8\r\n";
	    // $header .= "X-Priority: 3\r\n";
     //  	$header .= "X-Mailer: PHP" . phpversion() . "\r\n";

		$message = "<table cellpadding='0' cellspacing='0' border='0' width='100%' border='1' style='background:#FFF'>
						<tbody>
							<tr>
								<td style='padding: 10px 0;'>
									<table cellpadding='0' cellspacing='0' border='0' width='650' border='1' style='margin:0 auto;font-family:Arial,sans-serif;color:#555;'>
										<tbody>
											<tr>
												<td style='padding:7px 10px;font-size:13px;border-bottom:solid 1px #555;text-align:left;background:#000' colspan='2'><img src='http://www.lokillo.com.co/sites/default/files/lokillo-logo_0_0.png' width='210'></td>
											</tr>
											<tr>
												<td colspan='2'>
													<table cellpadding='0' cellspacing='0' border='0' width='650' border='0' style='margin:0 auto;font-family:Arial,sans-serif;'>
														<tbody>
															<tr>
																<td style='background:#FFDE17;color:#000;padding:10px 50px;font-weight:bold;text-align:center;' width='40%'>COTIZACIÓN SHOW</td>
															</tr>
														</tbody>
													</table>
												</td>
											</tr>
											
											<tr>
												<td width='30%' style='padding:7px 10px;background:#949599;color:#FFF'>CONTACTO</td>
												<td></td>
											</tr>
											<tr>
												<th width='30%' style='border:solid 1px #D2D3D5;color:#000;padding:7px 10px;font-size:13px;' align='left'>Nombre</th>
												<td style='padding:7px 10px;font-size:13px;border:solid 1px #D2D3D5;'>" . $_POST['name'] . "</td>
											</tr>
											<tr>
												<th width='30%' style='border:solid 1px #D2D3D5;color:#000;padding:7px 10px;font-size:13px;' align='left'>Apellido</th>
												<td style='padding:7px 10px;font-size:13px;border:solid 1px #D2D3D5;'>" . $_POST['apellidos'] . "</td>
											</tr>
											<tr>
												<th width='30%' style='border:solid 1px #D2D3D5;color:#000;padding:7px 10px;font-size:13px;' align='left'>Telefono</th>
												<td style='padding:7px 10px;font-size:13px;border:solid 1px #D2D3D5;'>" . $_POST['telefono'] . "</td>
											</tr>
											<tr>
												<th width='30%' style='border:solid 1px #D2D3D5;color:#000;padding:7px 10px;font-size:13px;' align='left'>Celular</th>
												<td style='padding:7px 10px;font-size:13px;border:solid 1px #D2D3D5;'>" . $_POST['celular'] . "</td>
											</tr>
											<tr>
												<th width='30%' style='border:solid 1px #D2D3D5;color:#000;padding:7px 10px;font-size:13px;' align='left'>Email</th>
												<td style='padding:7px 10px;font-size:13px;border:solid 1px #D2D3D5;'>" . $_POST['email'] . "</td>
											</tr>

											<tr>
												<td width='30%' style='padding:7px 10px;background:#949599;color:#FFF'>COMPAÑÍA CONTRATANTE</td>
												<td></td>
											</tr>
											<tr>
												<th width='30%' style='border:solid 1px #D2D3D5;color:#000;padding:7px 10px;font-size:13px;' align='left'>Compañía</th>
												<td style='padding:7px 10px;font-size:13px;border:solid 1px #D2D3D5;'>" . $_POST['compania'] . "</td>
											</tr>
											<tr>
												<th width='30%' style='border:solid 1px #D2D3D5;color:#000;padding:7px 10px;font-size:13px;' align='left'>Tipo de Compañía</th>
												<td style='padding:7px 10px;font-size:13px;border:solid 1px #D2D3D5;'>" . $_POST['tipo_de_compania'] . "</td>
											</tr>
											<tr>
												<th width='30%' style='border:solid 1px #D2D3D5;color:#000;padding:7px 10px;font-size:13px;' align='left'>Pais Compañía</th>
												<td style='padding:7px 10px;font-size:13px;border:solid 1px #D2D3D5;'>" . $_POST['pais'] . "</td>
											</tr>
											<tr>
												<th width='30%' style='border:solid 1px #D2D3D5;color:#000;padding:7px 10px;font-size:13px;' align='left'>Ciudad Compañía</th>
												<td style='padding:7px 10px;font-size:13px;border:solid 1px #D2D3D5;'>" . $_POST['ciudad_compania'] . "</td>
											</tr>
											<tr>
												<th width='30%' style='border:solid 1px #D2D3D5;color:#000;padding:7px 10px;font-size:13px;' align='left'>Sitio Web Compañía</th>
												<td style='padding:7px 10px;font-size:13px;border:solid 1px #D2D3D5;'>" . $_POST['sitio_web_de_la_compania'] . "</td>
											</tr>
											<tr>
												<th width='30%' style='border:solid 1px #D2D3D5;color:#000;padding:7px 10px;font-size:13px;' align='left'>Dirección</th>
												<td style='padding:7px 10px;font-size:13px;border:solid 1px #D2D3D5;'>" . $_POST['direccion'] . "</td>
											</tr>
											<tr>
												<th width='30%' style='border:solid 1px #D2D3D5;color:#000;padding:7px 10px;font-size:13px;' align='left'>Tipo de Documento</th>
												<td style='padding:7px 10px;font-size:13px;border:solid 1px #D2D3D5;'>" . getTipoDoc($_POST['tipo_de_documento']) . "</td>
											</tr>
											<tr>
												<th width='30%' style='border:solid 1px #D2D3D5;color:#000;padding:7px 10px;font-size:13px;' align='left'>Número De Documento</th>
												<td style='padding:7px 10px;font-size:13px;border:solid 1px #D2D3D5;'>" . $_POST['numero_de_documento'] . "</td>
											</tr>

											<tr>
												<td width='30%' style='padding:7px 10px;background:#949599;color:#FFF'>EVENTO</td>
												<td></td>
											</tr>
											<tr>
												<th width='30%' style='border:solid 1px #D2D3D5;color:#000;padding:7px 10px;font-size:13px;' align='left'>Tipo de evento</th>
												<td style='padding:7px 10px;font-size:13px;border:solid 1px #D2D3D5;'>" . getTipoEvento($_POST['tipo_de_evento']) . "</td>
											</tr>
											<tr>
												<th width='30%' style='border:solid 1px #D2D3D5;color:#000;padding:7px 10px;font-size:13px;' align='left'>Descripción Experiencia</th>
												<td style='padding:7px 10px;font-size:13px;border:solid 1px #D2D3D5;'>" . $_POST['descripcion_experiencia'] . "</td>
											</tr>
											<tr>
												<th width='30%' style='border:solid 1px #D2D3D5;color:#000;padding:7px 10px;font-size:13px;' align='left'>Tiquetera</th>
												<td style='padding:7px 10px;font-size:13px;border:solid 1px #D2D3D5;'>" . $_POST['tiquetera'] . "</td>
											</tr>
											<tr>
												<th width='30%' style='border:solid 1px #D2D3D5;color:#000;padding:7px 10px;font-size:13px;' align='left'>Responsable Boletería</th>
												<td style='padding:7px 10px;font-size:13px;border:solid 1px #D2D3D5;'>" . $_POST['responsable_de_la_boleteria'] . "</td>
											</tr>
											<tr>
												<th width='30%' style='border:solid 1px #D2D3D5;color:#000;padding:7px 10px;font-size:13px;' align='left'>Cliente Final</th>
												<td style='padding:7px 10px;font-size:13px;border:solid 1px #D2D3D5;'>" . $_POST['cliente_final'] . "</td>
											</tr>
											<tr>
												<th width='30%' style='border:solid 1px #D2D3D5;color:#000;padding:7px 10px;font-size:13px;' align='left'>Objetivo del Evento</th>
												<td style='padding:7px 10px;font-size:13px;border:solid 1px #D2D3D5;'>" . $_POST['objetivo_del_evento'] . "</td>
											</tr>
											<tr>
												<th width='30%' style='border:solid 1px #D2D3D5;color:#000;padding:7px 10px;font-size:13px;' align='left'>Agencia</th>
												<td style='padding:7px 10px;font-size:13px;border:solid 1px #D2D3D5;'>" . $_POST['agencia'] . "</td>
											</tr>
											<tr>
												<th width='30%' style='border:solid 1px #D2D3D5;color:#000;padding:7px 10px;font-size:13px;' align='left'>Marca</th>
												<td style='padding:7px 10px;font-size:13px;border:solid 1px #D2D3D5;'>" . $_POST['marca'] . "</td>
											</tr>
											<tr>
												<th width='30%' style='border:solid 1px #D2D3D5;color:#000;padding:7px 10px;font-size:13px;' align='left'>Objetivo de la Campaña</th>
												<td style='padding:7px 10px;font-size:13px;border:solid 1px #D2D3D5;'>" . $_POST['objetivo_de_la_campana'] . "</td>
											</tr>
											<tr>
												<th width='30%' style='border:solid 1px #D2D3D5;color:#000;padding:7px 10px;font-size:13px;' align='left'>País del Evento</th>
												<td style='padding:7px 10px;font-size:13px;border:solid 1px #D2D3D5;'>" . $_POST['pais_del_evento'] . "</td>
											</tr>
											<tr>
												<th width='30%' style='border:solid 1px #D2D3D5;color:#000;padding:7px 10px;font-size:13px;' align='left'>Ciudad del Evento</th>
												<td style='padding:7px 10px;font-size:13px;border:solid 1px #D2D3D5;'>" . $_POST['ciudad'] . "</td>
											</tr>
											<tr>
												<th width='30%' style='border:solid 1px #D2D3D5;color:#000;padding:7px 10px;font-size:13px;' align='left'>Lugar del Evento</th>
												<td style='padding:7px 10px;font-size:13px;border:solid 1px #D2D3D5;'>" . $_POST['lugar_del_evento'] . "</td>
											</tr>
											<tr>
												<th width='30%' style='border:solid 1px #D2D3D5;color:#000;padding:7px 10px;font-size:13px;' align='left'>Fecha y Hora Evento</th>
												<td style='padding:7px 10px;font-size:13px;border:solid 1px #D2D3D5;'>" . $newDate . " - " . $_POST['hora_del_evento'] . "</td>
											</tr>
											<tr>
												<th width='30%' style='border:solid 1px #D2D3D5;color:#000;padding:7px 10px;font-size:13px;' align='left'>Aforo Evento</th>
												<td style='padding:7px 10px;font-size:13px;border:solid 1px #D2D3D5;'>" . $_POST['aforo_del_evento'] . "</td>
											</tr>";

 											$conta = 1;
											foreach ($_POST['evento_de_gira']['items'] as $dia) {


												if ( $dia['fecha_evento_gira'] != "" ) {
													
													$fecha_evento = $dia['fecha_evento_gira'];
													$fecha_evento = traductor(date("l", strtotime($fecha_evento))) . date(", j", strtotime($fecha_evento)) . " de " .  traductor(date("F", strtotime($fecha_evento))) . " de " . date("Y", strtotime($fecha_evento));
												
													$message .= "<tr>
																	<th width='30%' style='border:solid 1px #D2D3D5;color:#000;padding:7px 10px;font-size:13px;background:#FFDE17;' align='left'>GIRA - Día " . $conta . "</th>
																	<td></td>
																</tr>
																<tr>
																	<th width='30%' style='border:solid 1px #D2D3D5;color:#000;padding:7px 10px;font-size:13px;' align='left'>Fecha y Hora</th>
																	<td style='padding:7px 10px;font-size:13px;border:solid 1px #D2D3D5;'>" . $fecha_evento . " - " . $dia['hora_evento_gira'] . "</td>
																</tr>
																<tr>
																	<th width='30%' style='border:solid 1px #D2D3D5;color:#000;padding:7px 10px;font-size:13px;' align='left'>Aforo</th>
																	<td style='padding:7px 10px;font-size:13px;border:solid 1px #D2D3D5;'>" . $dia['aforo_evento_gira'] . "</td>
																</tr>
																<tr>
																	<th width='30%' style='border:solid 1px #D2D3D5;color:#000;padding:7px 10px;font-size:13px;' align='left'>Ciudad</th>
																	<td style='padding:7px 10px;font-size:13px;border:solid 1px #D2D3D5;'>" . $dia['ciudad_evento_gira'] . "</td>
																</tr>
																<tr>
																	<th width='30%' style='border:solid 1px #D2D3D5;color:#000;padding:7px 10px;font-size:13px;' align='left'>Lugar</th>
																	<td style='padding:7px 10px;font-size:13px;border:solid 1px #D2D3D5;'>" . $dia['lugar_evento_gira'] . "</td>
																</tr>";

												}
												$conta++;
											}

		$message .= "					</tbody>
					 				</table>
					 			</td>
					 		</tr>
					 	</tbody>
					</table>";


		$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
    	$mail->CharSet = "UTF-8";
		// $mail->Encoding = "16bit";

		try {
		    //Server settings
		    $mail->SMTPDebug = 0;                                 // Enable verbose debug output
		    $mail->isSMTP();                                      // Set mailer to use SMTP
		    $mail->Host = 'smtp.gmail.com';						  // Specify main and backup SMTP servers
		    $mail->SMTPAuth = true;                               // Enable SMTP authentication
		    $mail->Username = 'todounlokillo.general@gmail.com';                 // SMTP username
		    $mail->Password = 'lokillo12345';                           // SMTP password
		    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
		    $mail->Port = 587;                                    // TCP port to connect to

		    //Recipients
		    $mail->setFrom('todounlokillo.general@gmail.com', 'Lokillo');
		    
		    $mail->addAddress("karen.gutierrez@pianoproducciones.com");
		    $mail->addAddress("todounlokillo.general@gmail.com");
		    $mail->addAddress("asilva@grupolaestacion.com");
		    $mail->addAddress("jarman.corredor@linkdigital.co");
		    $mail->addAddress("fcafiel@dayscript.com");
		    
		    // $mail->addReplyTo('fcaffield2@gmail.com', 'Information');
		    // $mail->addCC('cc@example.com');
		    // $mail->addBCC('bcc@example.com');

		    

		    //Content
		    $mail->isHTML(true);                                  // Set email format to HTML
		    $mail->Subject = "Nueva solicitud de cotización";
		    $mail->Body    = $message;

		    $mail->send();
		    echo "<script>alert('¡Gracias por tu mensaje! Pronto nos pondremos en contacto.')</script>";
			header("Location: /gracias-por-escribirnos");
		} catch (Exception $e) {
		    echo '<script>alert("Lo sentimos, algo sucedió en el proceso de envío del mensaje. Por favor inténtalo de nuevo en unos momentos.");</script>';
		}






	 //    try {
	 //    	mail($destEmail, $subject, $message, $header);
	 //    	echo "<script>alert('¡Gracias por tu mensaje! Pronto nos pondremos en contacto.')</script>";
	 //    } catch (Exception $e) {
		// 	echo 'Lo sentimos, algo sucedió en el proceso de envío del mensaje. Por favor inténtalo de nuevo en unos momentos.';
		// }
	}


	sendMail( "karen.gutierrez@pianoproducciones.com,todounlokillo.general@gmail.com,asilva@grupolaestacion.com,jarman.corredor@linkdigital.co,fcafiel@dayscript.com", "Nueva solicitud de cotización" );
	// sendMail( "fcafiel@dayscript.com", "Nueva solicitud de cotización" );



?>
