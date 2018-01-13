<?php

//POSTERIOR AL 12-01-2018

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, "https://personas.supervielle.com.ar/Pages/QuotesPanel/QuotesCoins.aspx");

curl_setopt($ch,CURLOPT_HEADER,0); // Necesario para visualizar ñ y acentos.

curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true );

curl_setopt($ch, CURLOPT_ENCODING, "gzip,deflate");  

$response = curl_exec($ch); //La variable response almacena el response de la pagina.

$responsefiltrado = explode('</td>', $response); // Divido la pagina para tener los datos que necesito mas accesibles.

curl_close($ch);

//--------------------------------------------------------------------------------------------------------

$ch_ = curl_init();

curl_setopt($ch_, CURLOPT_URL, "https://personas.supervielle.com.ar/Pages/QuotesPanel/Quotes.aspx");

curl_setopt($ch_,CURLOPT_HEADER,0); // Necesario para visualizar ñ y acentos.

curl_setopt($ch_, CURLOPT_SSL_VERIFYPEER, false);

curl_setopt($ch_, CURLOPT_RETURNTRANSFER, true);

curl_setopt($ch_, CURLOPT_FOLLOWLOCATION, true );

curl_setopt($ch_, CURLOPT_ENCODING, "gzip,deflate");  

$response_ = curl_exec($ch_); //La variable response almacena el response de la pagina.

$responsefiltrado_ = explode('</td>', $response_); // Divido la pagina para tener los datos que necesito mas accesibles.

curl_close($ch_);

//SISTEMA POSTERIOR AL 12-01-2018
//LIBRA
preg_match('/([0-9]+\.[0-9]+)/', str_replace(',', '.', $responsefiltrado[1]), $aux);
$libra_compra = floatval($aux[0]);
preg_match('/([0-9]+\.[0-9]+)/', str_replace(',', '.', $responsefiltrado[2]), $aux);
$libra_venta = floatval($aux[0]);
//DOLAR
preg_match('/([0-9]+\.[0-9]+)/', str_replace(',', '.', $responsefiltrado_[2]), $aux);
$dolar_compra = floatval($aux[0]);
preg_match('/([0-9]+\.[0-9]+)/', str_replace(',', '.', $responsefiltrado_[3]), $aux);
$dolar_venta = floatval($aux[0]);
//REAL
preg_match('/([0-9]+\.[0-9]+)/', str_replace(',', '.', $responsefiltrado[13]), $aux);
$real_compra = floatval($aux[0]);
preg_match('/([0-9]+\.[0-9]+)/', str_replace(',', '.', $responsefiltrado[14]), $aux);
$real_venta = floatval($aux[0]);
//EURO
preg_match('/([0-9]+\.[0-9]+)/', str_replace(',', '.', $responsefiltrado_[5]), $aux);
$euro_compra = floatval($aux[0]);
preg_match('/([0-9]+\.[0-9]+)/', str_replace(',', '.', $responsefiltrado_[6]), $aux);
$euro_venta = floatval($aux[0]);

//SISTEMA ANTERIOR AL 12-01-2018
// Asignacion de Cotizaciones y adaptacion de variables, primero encontrar el numero, despues cambiarle la coma por punto y parsearla a float.
/*$libra_compra = floatval(str_replace(',', '.', substr($responsefiltrado[15], 114, 119)));
$libra_venta = floatval(str_replace(',', '.', substr($responsefiltrado[16], 96, 101)));
$dolar_compra = floatval(str_replace(',', '.', substr($responsefiltrado[18], 114, 119)));
$dolar_venta = floatval(str_replace(',', '.', substr($responsefiltrado[19], 96, 101)));
$real_compra = floatval(str_replace(',', '.', substr($responsefiltrado[30], 114, 119)));
$real_venta = floatval(str_replace(',', '.', substr($responsefiltrado[31], 96, 101)));
$euro_compra = floatval(str_replace(',', '.', substr($responsefiltrado[57], 114, 119)));
$euro_venta = floatval(str_replace(',', '.', substr($responsefiltrado[58], 96, 101)));*/

//Asignacion de Constantes.
const LIBRA = 'Libra';
const DOLAR = 'Dolar';
const REALB = 'Real';
const EURO = 'Euro';

//Parámetros BD.
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cotizacion_supervielle";
$conn = mysqli_connect($servername, $username, $password, $dbname);


//Se utiliza el REPLACE INTO, debido a que en el día la cotización puede cambiar.
//NOTA: No se utiliza SQL Binding, debido a que el usuario no tiene acceso directamente a este archivo.
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
