<?php 

setlocale(LC_ALL, 'es_es');

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

$date = "2019-06-06T07:00";
$date = explode('T',$date );

var_dump( $date );


echo "<br><br>";

$newDate = traductor(date("l", strtotime($date[0]))) . date(", j", strtotime($date[0])) . " de " .  traductor(date("F", strtotime($date[0]))) . " de " . date("Y", strtotime($date[0]));
// $newDate = traductor(date("l, d", strtotime($date))) .  " de " .  date("F", strtotime($date)) . " de " . date("Y", strtotime($date));

echo $newDate;




?>