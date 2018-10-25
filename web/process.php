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
			"Lugar_Evento"			=> $_POST['tipo_de_show'],
			"Fecha_Hora_Evento"		=> $_POST['fecha_del_evento'],
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

echo "<pre>";
print_r( $response );
echo "</pre>";


?>
