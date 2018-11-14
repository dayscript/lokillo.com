<?php

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
											<td colspan='2'><img src='http://todounlokillo.com/sites/default/files/lokillo-logo_0_0.png'></td>
										<tr>
											<th align='left'>Nombre</th>
											<td>" . $_POST['name'] . "</td>
										</tr>
										<tr>
											<th align='left'>Apellido</th>
											<td>" . $_POST['apellidos'] . "</td>
										</tr>
										<tr>
											<th align='left'>Telefono</th>
											<td>" . $_POST['telefono'] . "</td>
										</tr>
										<tr>
											<th align='left'>Celular</th>
											<td>" . $_POST['celular'] . "</td>
										</tr>
										<tr>
											<th align='left'>Email</th>
											<td>" . $_POST['email'] . "</td>
										</tr>
										<tr>
											<th align='left'>Sitio_Web</th>
											<td>" . $_POST['sitio_web'] . "</td>
										</tr>
										<tr>
											<th align='left'>Compania</th>
											<td>" . $_POST['compania'] . "</td>
										</tr>
										<tr>
											<th align='left'>Tipo_Compania</th>
											<td>" . $_POST['tipo_de_compania'] . "</td>
										</tr>
										<tr>
											<th align='left'>Pais_Compania</th>
											<td>" . $_POST['pais'] . "</td>
										</tr>
										<tr>
											<th align='left'>Ciudad_Compania</th>
											<td>" . $_POST['ciudad_compania'] . "</td>
										</tr>
										<tr>
											<th align='left'>Sitio_Web_Compania</th>
											<td>" . $_POST['sitio_web_de_la_compania'] . "</td>
										</tr>
										<tr>
											<th align='left'>Direccion</th>
											<td>" . $_POST['direccion'] . "</td>
										</tr>
										<tr>
											<th align='left'>Tipo_Documento</th>
											<td>" . $_POST['tipo_de_documento'] . "</td>
										</tr>
										<tr>
											<th align='left'>Numero_De_Documento</th>
											<td>" . $_POST['numero_de_documento'] . "</td>
										</tr>
										<tr>
											<th align='left'>IdTipoEvento</th>
											<td>" . $_POST['tipo_de_evento'] . "</td>
										</tr>
										<tr>
											<th align='left'>Descripcion_Experiencia</th>
											<td>" . $_POST['descripcion_experiencia'] . "</td>
										</tr>
										<tr>
											<th align='left'>Tiquetera</th>
											<td>" . $_POST['tiquetera'] . "</td>
										</tr>
										<tr>
											<th align='left'>ResponsableBoleteria</th>
											<td>" . $_POST['responsable_de_la_boleteria'] . "</td>
										</tr>
										<tr>
											<th align='left'>Cliente_Final</th>
											<td>" . $_POST['cliente_final'] . "</td>
										</tr>
										<tr>
											<th align='left'>Objetivo_Evento</th>
											<td>" . $_POST['objetivo_del_evento'] . "</td>
										</tr>
										<tr>
											<th align='left'>Agencia</th>
											<td>" . $_POST['agencia'] . "</td>
										</tr>
										<tr>
											<th align='left'>Marca</th>
											<td>" . $_POST['marca'] . "</td>
										</tr>
										<tr>
											<th align='left'>Objetivo_Campana</th>
											<td>" . $_POST['objetivo_de_la_campana'] . "</td>
										</tr>
										<tr>
											<th align='left'>Pais_Evento</th>
											<td>" . $_POST['pais_del_evento'] . "</td>
										</tr>
										<tr>
											<th align='left'>Ciudad_Evento</th>
											<td>" . $_POST['ciudad'] . "</td>
										</tr>
										<tr>
											<th align='left'>Lugar_Evento</th>
											<td>" . $_POST['lugar_del_evento'] . "</td>
										</tr>
										<tr>
											<th align='left'>Fecha_Hora_Evento</th>
											<td>" . $_POST['fecha_del_evento'] . 'T' . $_POST['hora_del_evento'] . "</td>
										</tr>
										<tr>
											<th align='left'>Aforo_Evento</th>
											<td>" . $_POST['aforo_del_evento'] . "</td>
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
			echo 'Lo sentimos :( Algo sucedió en el proceso de envío. Por favor inténtalo de nuevo en unos momentos.';
		}
	}

	// if (isset( $_POST['nombres'] ) && $_POST['nombres'] != "" &&
	// 	isset( $_POST['email'] ) && $_POST['email'] != "") {
	// 	sendMail( "fcaffield2@gmail.com", "Nuevo mensaje de contacto" );
	// }

	sendMail( "fcaffield2@gmail.com", "Nuevo mensaje de contacto" );

	header("Location: /gracias-por-su-contacto");


?>
