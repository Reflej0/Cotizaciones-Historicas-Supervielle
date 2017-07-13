<?php
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, "https://personas.supervielle.com.ar/Pages/QuotesPanel/QuotesCoins.aspx");

curl_setopt($ch,CURLOPT_HEADER,0); // Necesario para visualizar ñ y acentos.

curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true );

curl_setopt($ch, CURLOPT_ENCODING, "gzip,deflate"); // This is what solved the issue (Accepting gzip encoding)   

$response = curl_exec($ch); //La variable response almacena el response de la pagina.

$responsefiltrado = explode('</td>', $response); // Divido la pagina para tener los datos que necesito mas accesible.

curl_close($ch);

// Asignacion de Cotizaciones y adaptacion de variables, primero encontrar el numero, despues cambiarle la coma por punto y parsearla a float.
$libra_compra = floatval(str_replace(',', '.', substr($responsefiltrado[15], 114, 119)));
$libra_venta = floatval(str_replace(',', '.', substr($responsefiltrado[16], 96, 101)));
$dolar_compra = floatval(str_replace(',', '.', substr($responsefiltrado[18], 114, 119)));
$dolar_venta = floatval(str_replace(',', '.', substr($responsefiltrado[19], 96, 101)));
$real_compra = floatval(str_replace(',', '.', substr($responsefiltrado[30], 114, 119)));
$real_venta = floatval(str_replace(',', '.', substr($responsefiltrado[31], 96, 101)));
$euro_compra = floatval(str_replace(',', '.', substr($responsefiltrado[57], 114, 119)));
$euro_venta = floatval(str_replace(',', '.', substr($responsefiltrado[58], 96, 101)));

//Asignacion de Constantes.
const LIBRA = 'Libra';
const DOLAR = 'Dolar';
const REALB = 'Real';
const EURO = 'Euro';

//Conexion BD
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cotizacion_supervielle";
$conn = mysqli_connect($servername, $username, $password, $dbname);


//Definiendo los inserts de cotizaciones.
$sql = "REPLACE INTO cotizaciones (moneda, compra, venta)
VALUES ('".LIBRA."', '".$libra_compra."', '".$libra_venta."');";
$sql .= "REPLACE INTO cotizaciones (moneda, compra, venta)
VALUES ('".DOLAR."', '".$dolar_compra."', '".$dolar_venta."');";
$sql .= "REPLACE INTO cotizaciones (moneda, compra, venta)
VALUES ('".REALB."', '".$real_compra."', '".$real_venta."');";
$sql .= "REPLACE INTO cotizaciones (moneda, compra, venta)
VALUES ('".EURO."', '".$euro_compra."', '".$euro_venta."')";

//Ejecutando la consulta.
mysqli_multi_query($conn, $sql);
//Cerrando Conexion BD.
mysqli_close($conn);
?>
